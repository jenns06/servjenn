<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    // 📄 LISTAR CLIENTES
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $clientes = DB::table('clientes')
            ->leftJoin('dispositivos', 'clientes.id_cliente', '=', 'dispositivos.id_cliente')
            ->select(
                'clientes.*',
                'dispositivos.estado',
                'dispositivos.id_dispositivo',
                'dispositivos.tipo',
                'dispositivos.problema',
                'dispositivos.precio'
            )
            ->when($buscar, function ($query, $buscar) {
                $query->where('clientes.nombre', 'like', "%$buscar%")
                      ->orWhere('clientes.telefono', 'like', "%$buscar%");
            })
            ->get();

        return view('clientes.index', compact('clientes'));
    }

    // 📄 FORMULARIO
    public function create()
    {
        return view('clientes.create');
    }

    // 💾 GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3',
            'telefono' => 'required|digits:10',
            'dispositivo' => 'required',
            'descripcion' => 'required|min:5',
            'precio' => 'required|numeric|min:0',
            'tipo_pago' => 'required|in:efectivo,tarjeta,transferencia'
        ]);

        $idTecnico = DB::table('tecnicos')->value('id_tecnico');

        $clienteId = DB::table('clientes')->insertGetId([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono
        ]);

        $dispositivoId = DB::table('dispositivos')->insertGetId([
            'id_cliente' => $clienteId,
            'id_tecnico' => $idTecnico,
            'tipo' => $request->dispositivo,
            'problema' => $request->descripcion,
            'estado' => 'pendiente',
            'precio' => $request->precio,
            'creado_por' => $idTecnico,
            'fecha_registro' => now()
        ]);

        DB::table('pagos')->insert([
            'id_dispositivo' => $dispositivoId,
            'tipo_pago' => $request->tipo_pago,
            'monto' => $request->precio,
            'fecha' => now(),
            'registrado_por' => $idTecnico,
            'supervisado_por' => $idTecnico
        ]);

        return redirect('/clientes')->with('success', 'Servicio registrado correctamente ✔');
    }

    // 📄 DETALLE
    public function show($id)
    {
        $cliente = DB::table('clientes')
            ->join('dispositivos', 'clientes.id_cliente', '=', 'dispositivos.id_cliente')
            ->where('clientes.id_cliente', $id)
            ->select('clientes.*', 'dispositivos.*')
            ->first();

        if (!$cliente) {
            return redirect('/clientes')->with('error', 'Cliente no encontrado');
        }

        return view('clientes.show', compact('cliente'));
    }

    // ✏️ EDITAR
    public function edit($id)
    {
        $cliente = DB::table('clientes')
            ->join('dispositivos', 'clientes.id_cliente', '=', 'dispositivos.id_cliente')
            ->where('clientes.id_cliente', $id)
            ->select('clientes.*', 'dispositivos.*')
            ->first();

        return view('clientes.edit', compact('cliente'));
    }

    // 🔄 ACTUALIZAR
    public function update(Request $request, $id)
    {
        DB::table('clientes')
            ->where('id_cliente', $id)
            ->update([
                'nombre' => $request->nombre,
                'telefono' => $request->telefono
            ]);

        DB::table('dispositivos')
            ->where('id_cliente', $id)
            ->update([
                'tipo' => $request->dispositivo,
                'problema' => $request->descripcion,
                'precio' => $request->precio
            ]);

        return redirect('/clientes')->with('success', 'Actualizado correctamente ✔');
    }

    // 🔄 ESTADO
    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,proceso,listo'
        ]);

        DB::table('dispositivos')
            ->where('id_dispositivo', $id)
            ->update([
                'estado' => $request->estado
            ]);

        return back()->with('success', 'Estado actualizado correctamente ✔');
    }

    // 🗑 ELIMINAR (CORREGIDO)
    public function destroy($id)
    {
        $dispositivo = DB::table('dispositivos')
            ->where('id_cliente', $id)
            ->first();

        if ($dispositivo) {
            DB::table('pagos')->where('id_dispositivo', $dispositivo->id_dispositivo)->delete();
            DB::table('dispositivos')->where('id_cliente', $id)->delete();
        }

        DB::table('clientes')->where('id_cliente', $id)->delete();

        return redirect('/clientes')->with('success', 'Cliente eliminado con éxito 🗑');
    }
}
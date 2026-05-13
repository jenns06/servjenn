<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * 📄 LISTAR CLIENTES (Dinámico por Rol)
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $user = Auth::user();

        $query = DB::table('clientes')
            ->join('dispositivos', 'clientes.id_cliente', '=', 'dispositivos.id_cliente')
            ->leftJoin('users', 'dispositivos.id_tecnico', '=', 'users.id')
            ->select(
                'clientes.*',
                'dispositivos.estado',
                'dispositivos.id_dispositivo',
                'dispositivos.tipo',
                'dispositivos.problema',
                'dispositivos.precio',
                'users.name as nombre_tecnico'
            );

        // Seguridad: El técnico solo ve lo suyo, el Admin ve todo
        if ($user->role !== 'admin') {
            $query->where('dispositivos.id_tecnico', $user->id);
        }

        if ($buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('clientes.nombre', 'like', "%$buscar%")
                  ->orWhere('clientes.telefono', 'like', "%$buscar%")
                  ->orWhere('dispositivos.tipo', 'like', "%$buscar%");
            });
        }

        $clientes = $query->orderBy('dispositivos.id_dispositivo', 'desc')->get();

        return view('clientes.index', compact('clientes'));
    }

    /**
     * 📄 FORMULARIO DE REGISTRO
     */
    public function create()
    {
        $tecnicos = DB::table('users')->where('role', 'tecnico')->get();
        return view('clientes.create', compact('tecnicos'));
    }

    /**
     * 💾 GUARDAR NUEVO SERVICIO
     */
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

        // --- LÓGICA DE ASIGNACIÓN REAL ---
        // Obtenemos el ID del técnico que está logueado en este momento (David, Tecnico, etc.)
        $idTecnicoResponsable = Auth::id();

        // 1. Insertar Cliente
        $clienteId = DB::table('clientes')->insertGetId([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono
        ]);

        // 2. Insertar Dispositivo vinculado al técnico que lo crea
        $dispositivoId = DB::table('dispositivos')->insertGetId([
            'id_cliente' => $clienteId,
            'id_tecnico' => $idTecnicoResponsable, 
            'tipo' => $request->dispositivo,
            'problema' => $request->descripcion,
            'estado' => 'pendiente',
            'precio' => $request->precio,
            'fecha_registro' => now()
        ]);

        // 3. Registrar Pago inicial para contabilidad
        DB::table('pagos')->insert([
            'id_dispositivo' => $dispositivoId,
            'tipo_pago' => $request->tipo_pago,
            'monto' => $request->precio,
            'fecha' => now()
        ]);

        return redirect('/clientes')->with('success', 'Servicio registrado correctamente ✔');
    }

    /**
     * ✏️ FORMULARIO DE EDICIÓN
     */
    public function edit($id)
    {
        $user = Auth::user();
        $query = DB::table('clientes')
            ->join('dispositivos', 'clientes.id_cliente', '=', 'dispositivos.id_cliente')
            ->where('clientes.id_cliente', $id);

        if ($user->role !== 'admin') {
            $query->where('dispositivos.id_tecnico', $user->id);
        }

        $cliente = $query->select('clientes.*', 'dispositivos.*')->first();

        if (!$cliente) {
            return redirect('/clientes')->with('error', 'No tienes permiso o el registro no existe.');
        }

        return view('clientes.edit', compact('cliente'));
    }

    /**
     * 🔄 ACTUALIZAR DATOS
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $dispositivo = DB::table('dispositivos')->where('id_cliente', $id);
        if ($user->role !== 'admin') {
            $dispositivo->where('id_tecnico', $user->id);
        }
        
        if (!$dispositivo->exists()) {
            return redirect('/clientes')->with('error', 'Acción no autorizada.');
        }

        DB::table('clientes')->where('id_cliente', $id)->update([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono
        ]);

        DB::table('dispositivos')->where('id_cliente', $id)->update([
            'tipo' => $request->dispositivo,
            'problema' => $request->descripcion,
            'precio' => $request->precio,
            'estado' => $request->estado 
        ]);

        return redirect('/clientes')->with('success', 'Información actualizada ✔');
    }

    /**
     * 🗑 ELIMINAR CLIENTE
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $query = DB::table('dispositivos')->where('id_cliente', $id);

        if ($user->role !== 'admin') {
            $query->where('id_tecnico', $user->id);
        }

        $dispositivo = $query->first();

        if (!$dispositivo) {
            return redirect('/clientes')->with('error', 'No puedes eliminar este registro.');
        }

        DB::table('pagos')->where('id_dispositivo', $dispositivo->id_dispositivo)->delete();
        DB::table('dispositivos')->where('id_cliente', $id)->delete();
        DB::table('clientes')->where('id_cliente', $id)->delete();

        return redirect('/clientes')->with('success', 'Eliminado correctamente 🗑');
    }
}
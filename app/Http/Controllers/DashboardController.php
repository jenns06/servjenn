<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente; // <--- ASEGÚRATE DE AGREGAR ESTA LÍNEA

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'admin') {
            
            // CAMBIO AQUÍ: Usamos el Modelo para que ignore los archivados automáticamente
            $totalClientes = Cliente::count(); 
            
            $totalDispositivos = DB::table('dispositivos')->count();
            $totalPagos = DB::table('pagos_tecnicos')->count();
            $totalIngresos = DB::table('dispositivos')->sum('precio');

            $serviciosPendientes = DB::table('dispositivos')->where('estado', 'pendiente')->count();
            $serviciosProceso = DB::table('dispositivos')->where('estado', 'proceso')->count();
            $serviciosFinalizados = DB::table('dispositivos')->whereIn('estado', ['finalizado', 'listo'])->count();

            $tecnicos = DB::table('users')
                ->where('role', 'tecnico') 
                ->leftJoin('dispositivos', 'users.id', '=', 'dispositivos.id_tecnico')
                ->select(
                    'users.id as id_tecnico',
                    'users.name',
                    DB::raw('COUNT(dispositivos.id_dispositivo) as total_trabajos'),
                    DB::raw('COALESCE(SUM(dispositivos.precio), 0) as total_dinero')
                )
                ->groupBy('users.id', 'users.name')
                ->get();

            // CAMBIO AQUÍ: También filtramos los archivados en la lista de dispositivos recientes
            $dispositivos = DB::table('dispositivos')
                ->leftJoin('clientes', 'dispositivos.id_cliente', '=', 'clientes.id_cliente')
                ->leftJoin('users', 'dispositivos.id_tecnico', '=', 'users.id')
                ->whereNull('clientes.deleted_at') // <--- AGREGAMOS ESTO PARA FILTRAR
                ->select('dispositivos.*', 'clientes.nombre as cliente', 'users.name as tecnico')
                ->latest('dispositivos.id_dispositivo')
                ->limit(10)
                ->get();

            return view('dashboard.admin', compact(
                'totalClientes', 'totalDispositivos', 'totalPagos', 'totalIngresos',
                'serviciosPendientes', 'serviciosProceso', 'serviciosFinalizados',
                'tecnicos', 'dispositivos'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD TECNICO
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'tecnico') {
            $notificaciones = DB::table('notificaciones')
                ->where('id_usuario', $user->id)
                ->latest()
                ->get();

            $dispositivos = DB::table('dispositivos')
                ->leftJoin('clientes', 'dispositivos.id_cliente', '=', 'clientes.id_cliente')
                ->whereNull('clientes.deleted_at') // <--- FILTRAR AQUÍ TAMBIÉN
                ->select('dispositivos.*', 'clientes.nombre as cliente')
                ->where('dispositivos.id_tecnico', $user->id)
                ->latest('dispositivos.id_dispositivo')
                ->get();

            return view('dashboard.tecnico', compact('notificaciones', 'dispositivos'));
        }

        abort(403);
    }
}
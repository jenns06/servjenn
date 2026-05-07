<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'admin') {

            // TOTALES
            $totalClientes = DB::table('clientes')->count();

            $totalDispositivos = DB::table('dispositivos')->count();

            $totalPagos = DB::table('pagos_tecnicos')->count();

            $totalIngresos = DB::table('dispositivos')
                ->sum('precio');

            // ESTADOS
            $serviciosPendientes = DB::table('dispositivos')
                ->where('estado', 'pendiente')
                ->count();

            $serviciosProceso = DB::table('dispositivos')
                ->where('estado', 'proceso')
                ->count();

            $serviciosFinalizados = DB::table('dispositivos')
                ->whereIn('estado', ['finalizado', 'listo'])
                ->count();

            // TECNICOS
            $tecnicos = DB::table('tecnicos')
                ->leftJoin(
                    'dispositivos',
                    'tecnicos.id_tecnico',
                    '=',
                    'dispositivos.id_tecnico'
                )
                ->select(
                    'tecnicos.id_tecnico',
                    'tecnicos.nombre as name',

                    DB::raw('COUNT(dispositivos.id_dispositivo) as total_trabajos'),

                    DB::raw('COALESCE(SUM(dispositivos.precio),0) as total_dinero')
                )
                ->groupBy(
                    'tecnicos.id_tecnico',
                    'tecnicos.nombre'
                )
                ->get();

            // DISPOSITIVOS
            $dispositivos = DB::table('dispositivos')
                ->leftJoin(
                    'clientes',
                    'dispositivos.id_cliente',
                    '=',
                    'clientes.id_cliente'
                )
                ->leftJoin(
                    'tecnicos',
                    'dispositivos.id_tecnico',
                    '=',
                    'tecnicos.id_tecnico'
                )
                ->select(
                    'dispositivos.*',
                    'clientes.nombre as cliente',
                    'tecnicos.nombre as tecnico'
                )
                ->latest('dispositivos.id_dispositivo')
                ->get();

            return view('dashboard.admin', compact(
                'totalClientes',
                'totalDispositivos',
                'totalPagos',
                'totalIngresos',
                'serviciosPendientes',
                'serviciosProceso',
                'serviciosFinalizados',
                'tecnicos',
                'dispositivos'
            ));
        }

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD TECNICO
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'tecnico') {

            // NOTIFICACIONES
            $notificaciones = DB::table('notificaciones')
                ->where('id_usuario', $user->id)
                ->latest()
                ->get();

            // DISPOSITIVOS DEL TECNICO
            $dispositivos = DB::table('dispositivos')
                ->leftJoin(
                    'clientes',
                    'dispositivos.id_cliente',
                    '=',
                    'clientes.id_cliente'
                )
                ->select(
                    'dispositivos.*',
                    'clientes.nombre as cliente'
                )
                ->where('dispositivos.id_tecnico', $user->id)
                ->latest('dispositivos.id_dispositivo')
                ->get();

            return view('dashboard.tecnico', compact(
                'notificaciones',
                'dispositivos'
            ));
        }

        abort(403);
    }
}
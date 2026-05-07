<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| RUTA INICIO
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */
    Route::get('/clientes', [ClienteController::class, 'index']);

    Route::get('/clientes/create', [ClienteController::class, 'create']);

    Route::post('/clientes', [ClienteController::class, 'store']);

    Route::get('/clientes/{id}', [ClienteController::class, 'show']);

    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);

    Route::put('/clientes/{id}', [ClienteController::class, 'update']);

    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR ESTADO
    |--------------------------------------------------------------------------
    */
    Route::put('/dispositivos/{id}/estado', function (
        Illuminate\Http\Request $request,
        $id
    ) {

        DB::table('dispositivos')
            ->where('id_dispositivo', $id)
            ->update([
                'estado' => $request->estado
            ]);

        return back()->with(
            'success',
            'Estado actualizado correctamente'
        );

    });

    /*
    |--------------------------------------------------------------------------
    | PRUEBA BASE DE DATOS
    |--------------------------------------------------------------------------
    */
    Route::get('/prueba', function () {
        return DB::table('clientes')->get();
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN - TECNICOS
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/tecnicos', function () {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

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

        return view('tecnicos', compact('tecnicos'));
    });

    /*
    |--------------------------------------------------------------------------
    | DETALLE TECNICO
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/tecnico/{id}', function ($id) {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $tecnico = DB::table('tecnicos')
            ->where('id_tecnico', $id)
            ->first();

        $trabajos = DB::table('dispositivos')
            ->where('id_tecnico', $id)
            ->get();

        $total = DB::table('dispositivos')
            ->where('id_tecnico', $id)
            ->sum('precio');

        return view('detalle_tecnico', compact(
            'tecnico',
            'trabajos',
            'total'
        ));
    });

    /*
    |--------------------------------------------------------------------------
    | PAGAR TECNICO
    |--------------------------------------------------------------------------
    */
    Route::post('/admin/pagar/{id}', function ($id) {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $total = DB::table('dispositivos')
            ->where('id_tecnico', $id)
            ->sum('precio');

        DB::table('pagos_tecnicos')->insert([
            'id_tecnico' => $id,
            'monto' => $total,
            'fecha' => now(),
            'estado' => 'pagado'
        ]);

        DB::table('notificaciones')->insert([
            'id_usuario' => $id,
            'mensaje' => 'Tu pago mensual fue realizado correctamente.',
            'leida' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with(
            'success',
            'Pago registrado correctamente'
        );
    });

    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/usuarios', function () {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $usuarios = DB::table('users')->get();

        return view('usuarios.index', compact('usuarios'));

    });

    Route::get('/admin/usuarios/create', function () {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('usuarios.create');

    });

    Route::post('/admin/usuarios/create', function (
        Illuminate\Http\Request $request
    ) {

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        DB::table('users')->insert([

            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt($request->password),

            'role' => $request->role,

            'created_at' => now(),

            'updated_at' => now()

        ]);

        return redirect('/admin/usuarios')
            ->with(
                'success',
                'Usuario creado correctamente'
            );

    });

});
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas (requieren login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |-----------------------------
    | Profile
    |-----------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |-----------------------------
    | Prueba DB
    |-----------------------------
    */
    Route::get('/prueba', function () {
        return DB::table('clientes')->get();
    });

    /*
    |-----------------------------
    | Clientes (CRUD)
    |-----------------------------
    */

    // LISTAR + BUSCAR
    Route::get('/clientes', [ClienteController::class, 'index']);

    // FORMULARIO
    Route::get('/clientes/create', [ClienteController::class, 'create']);

    // GUARDAR
    Route::post('/clientes', [ClienteController::class, 'store']);

    // VER DETALLE
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);

    // EDITAR
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);

    // ACTUALIZAR
    Route::put('/clientes/{id}', [ClienteController::class, 'update']);

    // CAMBIAR ESTADO
    Route::put('/dispositivos/{id}/estado', [ClienteController::class, 'updateEstado']);

    // ELIMINAR
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
});

require __DIR__.'/auth.php';

/*
|-----------------------------
| ADMIN - TÉCNICOS
|-----------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/tecnicos', function () {

        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $tecnicos = DB::table('users')
            ->where('role', 'tecnico')
            ->leftJoin('dispositivos', 'users.id', '=', 'dispositivos.id_tecnico')
            ->select(
                'users.id',
                'users.name',
                DB::raw('COUNT(dispositivos.id_dispositivo) as total_trabajos'),
                DB::raw('SUM(dispositivos.precio) as total_dinero')
            )
            ->groupBy('users.id', 'users.name')
            ->get();

        return view('admin.tecnicos', compact('tecnicos'));
    });

});
Route::get('/admin/tecnico/{id}', function ($id) {

    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    $tecnico = DB::table('users')->where('id', $id)->first();

    $trabajos = DB::table('dispositivos')
        ->where('id_tecnico', $id)
        ->get();

    $total = DB::table('dispositivos')
        ->where('id_tecnico', $id)
        ->sum('precio');

    return view('admin.detalle_tecnico', compact('tecnico', 'trabajos', 'total'));
});
Route::post('/admin/pagar/{id}', function ($id) {

    if (auth()->user()->role != 'admin') {
        abort(403);
    }

    // calcular total del técnico
    $total = DB::table('dispositivos')
        ->where('id_tecnico', $id)
        ->sum('precio');

    // guardar pago en nueva tabla
    DB::table('pagos_tecnicos')->insert([
        'id_tecnico' => $id,
        'monto' => $total,
        'fecha' => now(),
        'estado' => 'pagado'
    ]);

    return back()->with('success', 'Pago registrado correctamente 💰');
});
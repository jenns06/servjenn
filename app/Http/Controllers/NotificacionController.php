<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    // Marca todas como leídas para que el número rojo no vuelva a salir al recargar
    public function marcarComoLeidas()
    {
        DB::table('notificaciones')
            ->where('id_usuario', Auth::id())
            ->where('leida', 0)
            ->update(['leida' => 1]);

        return response()->json(['status' => 'success']);
    }

    // Borra físicamente la notificación de la base de datos al dar clic en la X
    public function eliminar($id)
    {
        DB::table('notificaciones')
            ->where('id', $id)
            ->where('id_usuario', Auth::id()) // Seguridad: solo el dueño puede borrarla
            ->delete();

        return response()->json(['status' => 'deleted']);
    }
}
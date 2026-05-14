<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Técnico - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- ICONOS Y BOOTSTRAP --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- SWEETALERT2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-grad: linear-gradient(135deg, #6366f1, #8b5cf6);
            --bg-light: #f1f5f9;
            --glass: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--primary-grad);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 20px 15px; /* Ajustado para móviles */
            color: #1e293b;
        }

        @media (min-width: 768px) {
            body { padding: 40px 20px; }
        }

        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* TOPBAR RESPONSIVO */
        .topbar {
            display: flex;
            flex-direction: column; /* Por defecto apilado */
            gap: 20px;
            margin-bottom: 30px;
            background: var(--glass);
            padding: 20px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.3);
            position: relative;
            z-index: 1000;
            text-align: center;
        }

        @media (min-width: 768px) {
            .topbar {
                flex-direction: row; /* Horizontal en PC */
                justify-content: space-between;
                align-items: center;
                text-align: left;
                padding: 20px 30px;
                border-radius: 25px;
            }
        }

        .titulo h1 {
            font-size: 20px;
            font-weight: 700;
            color: #4338ca;
            margin: 0;
        }

        @media (min-width: 768px) {
            .titulo h1 { font-size: 24px; }
        }

        .titulo p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .acciones {
            display: flex;
            align-items: center;
            justify-content: center; /* Centrado en móvil */
            gap: 15px;
        }

        @media (min-width: 768px) {
            .acciones { gap: 20px; }
        }

        /* NOTIFICACIONES */
        .notif-wrapper {
            position: relative;
        }

        .campana {
            background: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            transition: .3s;
            color: #6366f1;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: none;
        }

        @media (min-width: 768px) {
            .campana { width: 50px; height: 50px; border-radius: 15px; font-size: 20px; }
        }

        .badge-custom {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f43f5e;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* DROPDOWN DE NOTIFICACIONES RESPONSIVO */
        .dropdown-notif {
            position: absolute;
            right: -70px; /* Ajuste para que no se corte en móvil */
            top: 55px;
            width: 280px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            display: none;
            z-index: 1100;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        @media (min-width: 768px) {
            .dropdown-notif { right: 0; width: 320px; border-radius: 20px; top: 60px; }
        }

        .dropdown-notif.active { display: block; animation: slideIn 0.3s ease; }

        .dropdown-header {
            padding: 12px 15px;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 600;
            font-size: 13px;
        }

        .dropdown-body { max-height: 250px; overflow-y: auto; }

        .noti-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f8fafc;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* CARDS RESPONSIVAS */
        .cards {
            display: grid;
            grid-template-columns: 1fr; /* 1 columna móvil */
            gap: 20px;
            margin-bottom: 35px;
            position: relative;
            z-index: 1;
        }

        @media (min-width: 768px) {
            .cards { grid-template-columns: repeat(2, 1fr); gap: 25px; } /* 2 columnas PC */
        }

        .card-custom {
            background: var(--glass);
            padding: 30px 20px;
            border-radius: 25px;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.4);
            transition: .4s;
        }

        .btn-action {
            background: var(--primary-grad);
            color: white !important;
            padding: 10px 25px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            transition: .3s;
            width: 100%; /* Botón ancho en móvil */
        }

        @media (min-width: 768px) {
            .btn-action { width: auto; padding: 12px 30px; border-radius: 15px; font-size: 14px; }
        }

        .btn-logout {
            background: #fda4af;
            color: #991b1b;
            border: none;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>

<div class="container-custom">

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="titulo">
            <h1>Dashboard Técnico</h1>
            <p>SISTEMA ADMINISTRATIVO - SERVJENN</p>
        </div>

        <div class="acciones">
            {{-- NOTIFICACIONES --}}
            <div class="notif-wrapper">
                <button class="campana" id="btnCampana" onclick="toggleNotificaciones()">
                    <i class="fa-solid fa-bell"></i>
                    @php
                        $unreadCount = $notificaciones->where('leida', 0)->count();
                    @endphp
                    @if($unreadCount > 0)
                        <div class="badge-custom" id="badgeNotif">{{ $unreadCount }}</div>
                    @endif
                </button>

                <div class="dropdown-notif" id="menuNotif">
                    <div class="dropdown-header">Notificaciones Recientes</div>
                    <div class="dropdown-body">
                        @forelse($notificaciones as $n)
                            <div class="noti-item" id="notif-{{ $n->id }}">
                                <div class="noti-text">
                                    <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                    {{ $n->mensaje }}
                                </div>
                                <button class="btn-delete-notif" onclick="eliminarNotificacion({{ $n->id }})">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        @empty
                            <div class="noti-item text-center text-muted p-3">No hay novedades</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="button" class="btn-logout" onclick="confirmarSalida()">
                    <i class="fa-solid fa-power-off"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- MENSAJE BIENVENIDA --}}
    <div class="mb-4 text-white text-center text-md-start">
        <h4 style="font-weight: 300;">Hola, <strong>{{ auth()->user()->name }}</strong> 👋</h4>
        <p style="opacity: 0.8; font-size: 13px;">¿Qué vamos a gestionar hoy?</p>
    </div>

    {{-- CARDS DE ACCIÓN --}}
    <div class="cards">
        <div class="card-custom">
            <div class="card-icon"><i class="fa-solid fa-user-group"></i></div>
            <h2>Ver Clientes</h2>
            <p>Accede a la base de datos completa de clientes y sus estados de reparación.</p>
            <a href="/clientes" class="btn-action">Ir a Clientes <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>

        <div class="card-custom">
            <div class="card-icon"><i class="fa-solid fa-laptop-medical"></i></div>
            <h2>Nuevo Registro</h2>
            <p>Agrega un nuevo cliente a la plataforma y asigna su equipo técnico de inmediato.</p>
            <a href="/clientes/create" class="btn-action">Registrar Ahora <i class="fa-solid fa-plus ms-2"></i></a>
        </div>
    </div>
</div>

<script>
    function toggleNotificaciones() {
        const menu = document.getElementById('menuNotif');
        const badge = document.getElementById('badgeNotif');
        menu.classList.toggle('active');
        if (menu.classList.contains('active') && badge) {
            badge.style.display = 'none';
            fetch("{{ route('notificaciones.leer') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).catch(err => console.error(err));
        }
    }

    function eliminarNotificacion(id) {
        const row = document.getElementById('notif-' + id);
        if (row) row.remove();
        fetch(`/notificaciones/eliminar/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).catch(err => console.error(err));
    }

    window.onclick = function(event) {
        if (!event.target.closest('.notif-wrapper')) {
            document.getElementById('menuNotif').classList.remove('active');
        }
    }

    function confirmarSalida() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#f43f5e',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>

</body>
</html>
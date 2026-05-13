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
            padding: 40px 20px;
            color: #1e293b;
        }

        .container-custom {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            background: var(--glass);
            padding: 20px 30px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .titulo h1 {
            font-size: 24px;
            font-weight: 700;
            color: #4338ca;
            margin: 0;
        }

        .titulo p {
            margin: 0;
            font-size: 14px;
            color: #64748b;
        }

        .acciones {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* CAMPANA Y DROPDOWN */
        .notif-wrapper {
            position: relative;
        }

        .campana {
            background: white;
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            transition: .3s;
            color: #6366f1;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: none;
        }

        .campana:hover { transform: translateY(-3px); background: #f8fafc; }

        .badge-custom {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #f43f5e;
            color: white;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        /* MENU DE NOTIFICACIONES */
        .dropdown-notif {
            position: absolute;
            right: 0;
            top: 60px;
            width: 300px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            display: none;
            z-index: 1000;
            overflow: hidden;
            border: 1px solid #f1f5f9;
        }

        .dropdown-notif.active { display: block; animation: slideIn 0.3s ease; }

        .dropdown-header {
            padding: 15px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 600;
            font-size: 14px;
        }

        .dropdown-body { max-height: 300px; overflow-y: auto; }

        .noti-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f8fafc;
            font-size: 13px;
            transition: .2s;
        }
        .noti-item:hover { background: #f1f5f9; }

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .card-custom {
            background: var(--glass);
            padding: 40px 30px;
            border-radius: 30px;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.4);
            transition: .4s;
        }

        .card-custom:hover { transform: translateY(-10px); background: rgba(255,255,255,0.95); }

        .card-icon {
            width: 70px;
            height: 70px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }

        .card-custom h2 { font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 15px; }
        .card-custom p { color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 25px; }

        .btn-action {
            background: var(--primary-grad);
            color: white !important;
            padding: 12px 30px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            transition: .3s;
        }

        .btn-action:hover { transform: scale(1.05); box-shadow: 0 12px 25px rgba(99, 102, 241, 0.4); }

        .btn-logout {
            background: #fda4af;
            color: #991b1b;
            border: none;
            padding: 12px 20px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: .3s;
        }

        .btn-logout:hover { background: #f43f5e; color: white; }

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
                    @if($notificaciones->count() > 0)
                        <div class="badge-custom">{{ $notificaciones->count() }}</div>
                    @endif
                </button>

                <div class="dropdown-notif" id="menuNotif">
                    <div class="dropdown-header">Notificaciones Recientes</div>
                    <div class="dropdown-body">
                        @forelse($notificaciones as $n)
                            <div class="noti-item">
                                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                                {{ $n->mensaje }}
                            </div>
                        @empty
                            <div class="noti-item text-center text-muted">No hay novedades</div>
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
    <div class="mb-4 text-white">
        <h4 style="font-weight: 300;">Hola, <strong>{{ auth()->user()->name }}</strong> 👋</h4>
        <p style="opacity: 0.8; font-size: 14px;">¿Qué vamos a gestionar hoy?</p>
    </div>

    {{-- CARDS DE ACCIÓN --}}
    <div class="cards">

        <div class="card-custom">
            <div class="card-icon"><i class="fa-solid fa-user-group"></i></div>
            <h2>Ver Clientes</h2>
            <p>Accede a la base de datos completa de clientes y sus estados de reparación.</p>
            <a href="/clientes" class="btn-action">
                Ir a Clientes <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>

        <div class="card-custom">
            <div class="card-icon"><i class="fa-solid fa-laptop-medical"></i></div>
            <h2>Nuevo Registro</h2>
            <p>Agrega un nuevo cliente a la plataforma y asigna su equipo técnico de inmediato.</p>
            <a href="/clientes/create" class="btn-action">
                Registrar Ahora <i class="fa-solid fa-plus ms-2"></i>
            </a>
        </div>

    </div>

</div>

<script>
    // Mostrar/Ocultar menú de notificaciones
    function toggleNotificaciones() {
        const menu = document.getElementById('menuNotif');
        menu.classList.toggle('active');
    }

    // Cerrar el menú si se hace clic fuera
    window.onclick = function(event) {
        if (!event.target.closest('.notif-wrapper')) {
            document.getElementById('menuNotif').classList.remove('active');
        }
    }

    // Confirmación de salida con SweetAlert2
    function confirmarSalida() {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "Se guardarán tus cambios actuales.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#f43f5e',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'Cancelar',
            background: '#ffffff',
            borderRadius: '25px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    }
</script>

</body>
</html>
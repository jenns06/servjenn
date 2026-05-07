<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Técnico - ServJenn</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            background: linear-gradient(135deg,#6c63ff,#b16cea);
            min-height:100vh;
            padding:30px;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .titulo{
            color:white;
        }

        .titulo h1{
            font-size:32px;
            margin-bottom:5px;
        }

        .acciones{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .campana{
            position:relative;
            background:white;
            width:55px;
            height:55px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:24px;
            cursor:pointer;
        }

        .badge{
            position:absolute;
            top:5px;
            right:5px;
            background:red;
            color:white;
            width:20px;
            height:20px;
            border-radius:50%;
            font-size:12px;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .logout button{
            background:white;
            color:#6c63ff;
            border:none;
            padding:12px 20px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
            text-align:center;
        }

        .card h2{
            margin-bottom:15px;
            color:#444;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            background:#6c63ff;
            color:white;
            padding:12px 20px;
            border-radius:12px;
            text-decoration:none;
            font-weight:bold;
        }

        .btn:hover{
            opacity:.9;
        }

        .notificaciones{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        .notificaciones h2{
            margin-bottom:20px;
            color:#444;
        }

        .noti{
            background:#f4f4f4;
            padding:15px;
            border-radius:12px;
            margin-bottom:10px;
        }

    </style>
</head>
<body>

    {{-- TOPBAR --}}
    <div class="topbar">

        <div class="titulo">
            <h1>Dashboard Técnico</h1>

            <p style="color:white;">
                Bienvenido {{ auth()->user()->name }}
            </p>
        </div>

        <div class="acciones">

            {{-- CAMPANA --}}
            <div class="campana">
                🔔

                <div class="badge">
                    {{ $notificaciones->count() }}
                </div>
            </div>

            {{-- CERRAR SESION --}}
            <div class="logout">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        Cerrar sesión
                    </button>

                </form>

            </div>

        </div>

    </div>

    {{-- BOTONES --}}
    <div class="cards">

        <div class="card">

            <h2>Ver Clientes</h2>

            <p>
                Consulta la lista de clientes registrados.
            </p>

            <a href="/clientes" class="btn">
                Ir a clientes
            </a>

        </div>

        <div class="card">

            <h2>Registrar Cliente</h2>

            <p>
                Agrega nuevos clientes y dispositivos.
            </p>

            <a href="/clientes/create" class="btn">
                Registrar
            </a>

        </div>

    </div>

    {{-- NOTIFICACIONES --}}
    <div class="notificaciones">

        <h2>Notificaciones</h2>

        @forelse($notificaciones as $n)

            <div class="noti">
                {{ $n->mensaje }}
            </div>

        @empty

            <div class="noti">
                No tienes notificaciones.
            </div>

        @endforelse

    </div>

</body>
</html>
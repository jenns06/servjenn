<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ServJenn</title>

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
            gap:20px;
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

        .btn-usuarios{
            background:white;
            color:#6c63ff;
            border:none;
            padding:12px 20px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            text-decoration:none;
            transition:.3s;
        }

        .btn-usuarios:hover{
            transform:scale(1.05);
        }

        .logout form button{
            background:white;
            color:#6c63ff;
            border:none;
            padding:12px 20px;
            border-radius:12px;
            cursor:pointer;
            font-weight:bold;
            transition:.3s;
        }

        .logout form button:hover{
            transform:scale(1.05);
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        .card h3{
            color:#777;
            margin-bottom:10px;
        }

        .card p{
            font-size:32px;
            font-weight:bold;
            color:#6c63ff;
        }

        .contenedor{
            display:grid;
            grid-template-columns:1fr;
            gap:30px;
        }

        .tabla-box{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
            overflow:auto;
        }

        .tabla-box h2{
            margin-bottom:20px;
            color:#444;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#6c63ff;
            color:white;
            padding:14px;
            text-align:left;
        }

        table td{
            padding:14px;
            border-bottom:1px solid #eee;
        }

        .estado{
            padding:6px 12px;
            border-radius:20px;
            color:white;
            font-size:13px;
            font-weight:bold;
        }

        .pendiente{
            background:#ff9800;
        }

        .proceso{
            background:#2196f3;
        }

        .finalizado{
            background:#4caf50;
        }

        .btn{
            background:#6c63ff;
            color:white;
            padding:10px 15px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            text-decoration:none;
            display:inline-block;
        }

        .btn:hover{
            opacity:.9;
        }

    </style>
</head>
<body>

    {{-- TOPBAR --}}
    <div class="topbar">

        <div class="titulo">
            <h1>Dashboard Admin</h1>

            <p style="color:white;">
                Bienvenido {{ auth()->user()->name }}
            </p>
        </div>

        <div class="acciones">

            {{-- BOTON USUARIOS --}}
            <a href="/admin/usuarios" class="btn-usuarios">
                👥 Usuarios
            </a>

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

    {{-- CARDS --}}
    <div class="cards">

        <div class="card">
            <h3>Total Clientes</h3>
            <p>{{ $totalClientes }}</p>
        </div>

        <div class="card">
            <h3>Dispositivos</h3>
            <p>{{ $totalDispositivos }}</p>
        </div>

        <div class="card">
            <h3>Ingresos</h3>
            <p>${{ $totalIngresos }}</p>
        </div>

        <div class="card">
            <h3>Pagos Técnicos</h3>
            <p>{{ $totalPagos }}</p>
        </div>

    </div>

    {{-- ESTADOS --}}
    <div class="cards">

        <div class="card">
            <h3>Pendientes</h3>
            <p>{{ $serviciosPendientes }}</p>
        </div>

        <div class="card">
            <h3>En Proceso</h3>
            <p>{{ $serviciosProceso }}</p>
        </div>

        <div class="card">
            <h3>Finalizados</h3>
            <p>{{ $serviciosFinalizados }}</p>
        </div>

    </div>

    <div class="contenedor">

        {{-- TABLA TECNICOS --}}
        <div class="tabla-box">

            <h2>Técnicos</h2>

            <table>

                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Trabajos</th>
                        <th>Total Generado</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tecnicos as $tec)

                    <tr>
                        <td>{{ $tec->name }}</td>
                        <td>{{ $tec->total_trabajos }}</td>
                        <td>${{ $tec->total_dinero }}</td>
                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- TABLA DISPOSITIVOS --}}
        <div class="tabla-box">

            <h2>Dispositivos</h2>

            <table>

                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Dispositivo</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($dispositivos as $d)

                    <tr>

                        <td>{{ $d->cliente }}</td>

                        <td>{{ $d->tipo }}</td>

                        <td>{{ $d->tecnico ?? 'Sin asignar' }}</td>

                        <td>

                            <span class="estado
                                {{ $d->estado == 'pendiente' ? 'pendiente' : '' }}
                                {{ $d->estado == 'proceso' ? 'proceso' : '' }}
                                {{ $d->estado == 'finalizado' || $d->estado == 'listo' ? 'finalizado' : '' }}
                            ">

                                {{ $d->estado }}

                            </span>

                        </td>

                        <td>${{ $d->precio }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>
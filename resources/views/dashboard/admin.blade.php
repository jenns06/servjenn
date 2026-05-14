<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- SWEETALERT2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>

        :root{
            --gradiente:linear-gradient(135deg,#818cf8,#a855f7);
            --rosa:linear-gradient(135deg,#fb7185,#e11d48);
            --verde:linear-gradient(135deg,#4ade80,#16a34a);
            --azul:linear-gradient(135deg,#60a5fa,#2563eb);
            --fondo:#f1f5f9;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:var(--fondo);
            min-height:100vh;
            color:#475569;
        }

        /* SIDEBAR */

        .sidebar{
            width:260px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:var(--gradiente);
            padding:30px 20px;
            color:white;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
            z-index:1000;
            border-top-right-radius:25px;
            border-bottom-right-radius:25px;
        }

        .logo{
            text-align:center;
            margin-bottom:40px;
        }

        .logo img{
            width:115px;
            padding:10px;
            border-radius:25px;
            background:rgba(255,255,255,.12);
            border:2px solid rgba(255,255,255,.15);
            box-shadow:0 8px 25px rgba(0,0,0,.15);
            transition:.3s;
            margin-bottom:15px;
        }

        .logo img:hover{
            transform:scale(1.05);
        }

        .logo p{
            font-size:13px;
            font-weight:500;
            letter-spacing:1px;
            opacity:.95;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .menu a{
            text-decoration:none;
            color:white;
            padding:14px 18px;
            border-radius:14px;
            transition:.3s;
            font-size:15px;
            display:flex;
            align-items:center;
            gap:12px;
            font-weight:500;
        }

        .menu a:hover{
            background:rgba(255,255,255,.15);
            transform:translateX(5px);
        }

        /* CONTENIDO */

        .contenido{
            margin-left:260px;
            padding:35px;
        }

        /* TOPBAR */

        .topbar{
            background:rgba(255,255,255,.8);
            padding:25px 30px;
            border-radius:25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:35px;
            box-shadow:0 8px 25px rgba(0,0,0,.04);
            backdrop-filter:blur(10px);
        }

        .topbar h1{
            font-size:30px;
            font-weight:700;
            background:var(--gradiente);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .topbar p{
            margin-top:4px;
            color:#64748b;
        }

        .acciones{
            display:flex;
            align-items:center;
            gap:15px;
        }

        /* BOTONES */

        .btn-custom{
            background:var(--gradiente);
            color:white !important;
            border:none;
            padding:13px 22px;
            border-radius:14px;
            text-decoration:none;
            font-weight:600;
            display:flex;
            align-items:center;
            gap:10px;
            transition:.3s;
            box-shadow:0 8px 20px rgba(139,92,246,.25);
        }

        .btn-custom:hover{
            transform:translateY(-2px);
        }

        .btn-salir{
            border:none;
            background:var(--rosa);
            color:white;
            padding:13px 22px;
            border-radius:14px;
            font-weight:600;
            display:flex;
            align-items:center;
            gap:10px;
            transition:.3s;
            box-shadow:0 8px 20px rgba(244,63,94,.25);
        }

        .btn-salir:hover{
            transform:translateY(-2px);
        }

        /* CARDS */

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
            gap:25px;
            margin-bottom:35px;
        }

        .card-box{
            background:white;
            padding:30px;
            border-radius:25px;
            box-shadow:0 10px 25px rgba(0,0,0,.04);
            transition:.3s;
            position:relative;
            overflow:hidden;
        }

        .card-box:hover{
            transform:translateY(-5px);
        }

        .card-box::before{
            content:'';
            position:absolute;
            width:120px;
            height:120px;
            background:rgba(168,85,247,.06);
            border-radius:50%;
            top:-40px;
            right:-40px;
        }

        .card-icon{
            width:58px;
            height:58px;
            border-radius:16px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:22px;
            margin-bottom:18px;
            color:white;
        }

        .purple{ background:var(--gradiente); }
        .blue{ background:var(--azul); }
        .green{ background:var(--verde); }
        .orange{ background:linear-gradient(135deg,#fbbf24,#f97316); }
        .red{ background:var(--rosa); }

        .card-box h3{
            color:#94a3b8;
            font-size:14px;
            margin-bottom:8px;
            text-transform:uppercase;
            font-weight:600;
        }

        .card-box p{
            font-size:34px;
            font-weight:700;
            color:#1e293b;
            margin:0;
        }

        /* TABLAS */

        .tabla-box{
            background:white;
            border-radius:25px;
            padding:30px;
            margin-bottom:30px;
            box-shadow:0 8px 25px rgba(0,0,0,.04);
            /* AÑADIDO PARA RESPONSIVE */
            overflow-x: auto;
        }

        .tabla-box h2{
            margin-bottom:25px;
            font-size:24px;
            font-weight:700;
            color:#334155;
        }

        table th{
            background:#f8fafc;
            color:#64748b;
            padding:16px;
            font-size:13px;
            font-weight:700;
            text-transform:uppercase;
            border-bottom:2px solid #e2e8f0;
        }

        table td{
            padding:18px 16px;
            border-bottom:1px solid #f1f5f9;
            vertical-align:middle;
            font-size:14px;
        }

        table tr:hover{
            background:#fafaff;
        }

        /* ESTADOS */

        .estado{
            padding:7px 14px;
            border-radius:30px;
            font-size:11px;
            font-weight:700;
            text-transform:uppercase;
        }

        .pendiente{
            background:#fee2e2;
            color:#dc2626;
        }

        .proceso{
            background:#fef3c7;
            color:#d97706;
        }

        .finalizado{
            background:#dcfce7;
            color:#16a34a;
        }

        /* BOTONES TABLA */

        .acciones-tabla{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
        }

        .btn-pagar{
            background:#dcfce7;
            color:#15803d;
            border:none;
            padding:9px 16px;
            border-radius:10px;
            font-size:12px;
            font-weight:700;
            transition:.3s;
        }

        .btn-pagar:hover{
            transform:translateY(-2px);
        }

        @media(max-width:900px){

            .sidebar{
                position: relative;
                width: 100%;
                height: auto;
                border-radius: 0 0 25px 25px;
            }

            .contenido{
                margin-left:0;
                padding:20px;
            }

            .topbar{
                flex-direction:column;
                align-items:flex-start;
                gap:20px;
            }

        }
        html {
            scroll-behavior: smooth;
        }

    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="logo">

            <img src="{{ asset('img/logo.png') }}" alt="Logo ServJenn">

            <p>Sistema Administrativo</p>

            <p>ServJenn</p>

        </div>

        <div class="menu">

            <a href="/dashboard">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>

            <a href="/clientes">
                <i class="fa-solid fa-users"></i>
                Clientes
            </a>

            <a href="#tabla-dispositivos"> 
                <i class="fa-solid fa-laptop"></i>
                 Dispositivos
            </a>

            <a href="/admin/usuarios">
                <i class="fa-solid fa-user-plus"></i>
                Usuarios
            </a>

        </div>

    </div>

    {{-- CONTENIDO --}}
    <div class="contenido">

        {{-- TOPBAR --}}
        <div class="topbar">

            <div>

                <h1>Bienvenido Admin</h1>

                

            </div>

            <div class="acciones">

                <a href="/admin/usuarios/create" class="btn-custom">

                    <i class="fa-solid fa-user-plus"></i>

                    Crear Usuario

                </a>

                <form method="POST"
                      action="{{ route('logout') }}"
                      id="logoutForm">

                    @csrf

                    <button type="button"
                            onclick="confirmarSalida()"
                            class="btn-salir">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        Cerrar Sesión

                    </button>

                </form>

            </div>

        </div>

        {{-- CARDS --}}
        <div class="cards">

            <div class="card-box">
                <div class="card-icon purple">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>Total Clientes</h3>

                <p>{{ $totalClientes }}</p>
            </div>

            <div class="card-box">
                <div class="card-icon blue">
                    <i class="fa-solid fa-laptop"></i>
                </div>

                <h3>Dispositivos</h3>

                <p>{{ $totalDispositivos }}</p>
            </div>

            <div class="card-box">
                <div class="card-icon green">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>

                <h3>Ingresos</h3>

                <p>${{ $totalIngresos }}</p>
            </div>

            <div class="card-box">
                <div class="card-icon orange">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <h3>Pagos Técnicos</h3>

                <p>{{ $totalPagos }}</p>
            </div>

        </div>

        {{-- ESTADOS --}}
        <div class="cards">

            <div class="card-box">
                <div class="card-icon red">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <h3>Pendientes</h3>

                <p>{{ $serviciosPendientes }}</p>
            </div>

            <div class="card-box">
                <div class="card-icon orange">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>

                <h3>En Proceso</h3>

                <p>{{ $serviciosProceso }}</p>
            </div>

            <div class="card-box">
                <div class="card-icon green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <h3>Finalizados</h3>

                <p>{{ $serviciosFinalizados }}</p>
            </div>

        </div>

        {{-- TABLA TECNICOS --}}
        <div class="tabla-box">

            <h2>Gestión de Técnicos</h2>

            <table class="table">

                <thead>

                    <tr>
                        <th>Nombre</th>
                        <th>Trabajos</th>
                        <th>Total Generado</th>
                        <th style="color: #16a34a;">Total Pago (35%)</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($tecnicos as $tec)
                    @php
                        // CÁLCULO DEL 35%
                        $comision = $tec->total_dinero * 0.35;
                    @endphp

                    <tr>

                        <td><strong>{{ $tec->name }}</strong></td>

                        <td>{{ $tec->total_trabajos }}</td>

                        <td>${{ $tec->total_dinero }}</td>

                        <td><strong style="color: #16a34a;">${{ number_format($comision, 2) }}</strong></td>

                        <td>

                            <div class="acciones-tabla">

                                @php
                                    $pagoRealizado = DB::table('pagos_tecnicos')
                                        ->where('id_tecnico', $tec->id_tecnico)
                                        ->whereDate('fecha', now()->toDateString())
                                        ->exists();
                                @endphp

                                @if($pagoRealizado)

                                    <button class="btn-pagar"
                                            style="background:#f1f5f9;color:#94a3b8;"
                                            onclick="mostrarInfoPago()">

                                        Pago Realizado

                                    </button>

                                @else

                                    <form method="POST"
                                          action="/admin/pagar/{{ $tec->id_tecnico }}"
                                          id="formPago{{ $tec->id_tecnico }}">

                                        @csrf

                                        <button type="button"
                                                class="btn-pagar"
                                                onclick="confirmarPago('formPago{{ $tec->id_tecnico }}', '{{ number_format($comision, 2) }}')">

                                            Avisar Pago

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- TABLA DISPOSITIVOS --}}
        <div class="tabla-box" id="tabla-dispositivos"> 
            <h2>Últimos Dispositivos</h2>

            <table class="table">

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

                            <span class="estado {{ strtolower($d->estado) }}">

                                {{ $d->estado }}

                            </span>

                        </td>

                        <td><strong>${{ $d->precio }}</strong></td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

<script>

function mostrarInfoPago(){

    Swal.fire({
        title:'¡Pago realizado!',
        text:'El pago ya fue registrado hoy.',
        icon:'info',
        confirmButtonColor:'#8b5cf6'
    });

}

function confirmarPago(formId, monto){

    Swal.fire({
        title:'¿Registrar pago?',
        text:'Se notificará al técnico que ganó $' + monto + ' y que ya se realizó su pago.',
        icon:'question',
        showCancelButton:true,
        confirmButtonColor:'#22c55e',
        cancelButtonColor:'#f43f5e',
        confirmButtonText:'Sí, avisar pago',
        cancelButtonText:'Cancelar'
    }).then((result)=>{

        if(result.isConfirmed){

            document.getElementById(formId).submit();

        }

    });

}

function confirmarSalida(){

    Swal.fire({
        title:'¿Cerrar sesión?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#f43f5e',
        cancelButtonColor:'#94a3b8',
        confirmButtonText:'Salir',
        cancelButtonText:'Cancelar'
    }).then((result)=>{

        if(result.isConfirmed){

            document.getElementById('logoutForm').submit();

        }

    });

}

</script>

</body>
</html>
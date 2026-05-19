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
        --naranja:linear-gradient(135deg,#fbbf24,#f97316);

        --fondo:#f1f5f9;
        --texto:#475569;
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        min-width:0;
        font-family:'Poppins',sans-serif;
    }

    html{
        scroll-behavior:smooth;
        overflow-x:hidden;
    }

    body{
        background:var(--fondo);
        min-height:100vh;
        color:var(--texto);
        overflow-x:hidden;
    }

    img,
    table,
    div{
        max-width:100%;
    }

    /* ====================================
        SIDEBAR
    ==================================== */

    .sidebar{
        width:260px;
        height:100vh;

        position:fixed;
        top:0;
        left:0;

        background:var(--gradiente);

        padding:28px 18px;

        color:white;

        z-index:1000;

        overflow-y:auto;

        border-top-right-radius:28px;
        border-bottom-right-radius:28px;

        box-shadow:0 10px 30px rgba(0,0,0,.08);
    }

    /* LOGO */

    .logo{
        text-align:center;
        margin-bottom:35px;
    }

    .logo img{
        width:110px;
        max-width:100%;
        height:auto;

        object-fit:contain;

        background:transparent;
        border:none;
        box-shadow:none;

        margin-bottom:10px;

        transition:.3s;
    }

    .logo img:hover{
        transform:scale(1.05);
    }

    .logo p{
        font-size:13px;
        font-weight:500;
        line-height:1.5;
        opacity:.95;
    }

    /* MENU */

    .menu{
        display:flex;
        flex-direction:column;
        gap:10px;
    }

    .menu a{
        text-decoration:none;
        color:white;

        padding:14px 16px;

        border-radius:14px;

        display:flex;
        align-items:center;
        gap:12px;

        font-size:15px;
        font-weight:500;

        transition:.3s;

        word-break:break-word;
    }

    .menu a:hover{
        background:rgba(255,255,255,.15);
        transform:translateX(5px);
    }

    /* ====================================
        CONTENIDO
    ==================================== */

    .contenido{
        margin-left:260px;

        width:calc(100% - 260px);

        min-height:100vh;

        padding:30px;

        overflow:hidden;
    }

    /* ====================================
        TOPBAR
    ==================================== */

    .topbar{
        background:rgba(255,255,255,.85);

        backdrop-filter:blur(10px);

        border-radius:25px;

        padding:25px 30px;

        display:flex;
        justify-content:space-between;
        align-items:center;

        gap:20px;

        flex-wrap:wrap;

        margin-bottom:30px;

        box-shadow:0 8px 25px rgba(0,0,0,.04);
    }

    .topbar h1{
        font-size:clamp(24px,4vw,32px);

        font-weight:700;

        background:var(--gradiente);

        -webkit-background-clip:text;
        -webkit-text-fill-color:transparent;

        line-height:1.2;
    }

    .topbar p{
        color:#64748b;
        margin-top:5px;
        line-height:1.5;
    }

    .acciones{
        display:flex;
        align-items:center;
        gap:15px;
        flex-wrap:wrap;
    }

    /* BOTONES */

    .btn-custom,
    .btn-salir{
        border:none;

        padding:13px 22px;

        border-radius:14px;

        font-size:14px;
        font-weight:600;

        display:flex;
        align-items:center;
        justify-content:center;

        gap:10px;

        cursor:pointer;

        transition:.3s;

        text-decoration:none;

        white-space:nowrap;
    }

    .btn-custom{
        background:var(--gradiente);
        color:white !important;

        box-shadow:0 8px 20px rgba(139,92,246,.25);
    }

    .btn-salir{
        background:var(--rosa);
        color:white;

        box-shadow:0 8px 20px rgba(244,63,94,.25);
    }

    .btn-custom:hover,
    .btn-salir:hover{
        transform:translateY(-2px);
    }

    /* ====================================
        CARDS
    ==================================== */

    .cards{
        display:grid;

        grid-template-columns:repeat(auto-fit,minmax(260px,1fr));

        gap:22px;

        margin-bottom:30px;

        width:100%;
    }

    .card-box{
        background:white;

        border-radius:24px;

        padding:26px;

        position:relative;

        overflow:hidden;

        transition:.3s;

        box-shadow:0 10px 25px rgba(0,0,0,.04);

        width:100%;
    }

    .card-box:hover{
        transform:translateY(-5px);
    }

    .card-box::before{
        content:'';

        position:absolute;

        width:120px;
        height:120px;

        border-radius:50%;

        background:rgba(168,85,247,.05);

        top:-40px;
        right:-40px;
    }

    .card-icon{
        width:58px;
        height:58px;

        border-radius:16px;

        display:flex;
        align-items:center;
        justify-content:center;

        color:white;

        font-size:22px;

        margin-bottom:18px;
    }

    .purple{ background:var(--gradiente); }
    .blue{ background:var(--azul); }
    .green{ background:var(--verde); }
    .orange{ background:var(--naranja); }
    .red{ background:var(--rosa); }

    .card-box h3{
        color:#94a3b8;

        font-size:13px;

        margin-bottom:8px;

        text-transform:uppercase;

        font-weight:700;
    }

    .card-box p{
        font-size:clamp(28px,5vw,34px);

        font-weight:700;

        color:#1e293b;
    }

    /* ====================================
        TABLAS
    ==================================== */

    .tabla-box{
        background:white;

        border-radius:24px;

        padding:28px;

        margin-bottom:30px;

        overflow-x:auto;

        box-shadow:0 8px 25px rgba(0,0,0,.04);

        width:100%;
    }

    .tabla-box h2{
        margin-bottom:25px;

        font-size:clamp(20px,4vw,25px);

        color:#334155;

        font-weight:700;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    table th{
        background:#f8fafc;

        color:#64748b;

        padding:16px;

        font-size:12px;

        text-transform:uppercase;

        font-weight:700;

        border-bottom:2px solid #e2e8f0;

        text-align:left;

        white-space:nowrap;
    }

    table td{
        padding:18px 16px;

        border-bottom:1px solid #f1f5f9;

        font-size:14px;

        vertical-align:middle;

        white-space:nowrap;
    }

    table tr:hover{
        background:#fafaff;
    }

    /* ESTADOS */

    .estado{
        display:inline-block;

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

        padding:9px 15px;

        border-radius:10px;

        font-size:12px;

        font-weight:700;

        cursor:pointer;

        transition:.3s;
    }

    .btn-pagar:hover{
        transform:translateY(-2px);
    }

    /* ====================================
        TABLETS
    ==================================== */

    @media(max-width:992px){

        .sidebar{
            width:220px;
        }

        .contenido{
            margin-left:220px;
            width:calc(100% - 220px);
            padding:22px;
        }

    }

    /* ====================================
        MOVILES
    ==================================== */

    @media(max-width:900px){

        body{
            overflow-x:hidden;
        }

        .sidebar{
            position:relative;

            width:100%;
            height:auto;

            border-radius:0 0 25px 25px;

            padding:22px 16px;
        }

        .contenido{
            margin-left:0 !important;

            width:100% !important;

            padding:16px;
        }

        .topbar{
            flex-direction:column;
            align-items:flex-start;

            padding:22px 18px;
        }

        .acciones{
            width:100%;
            flex-direction:column;
        }

        .btn-custom,
        .btn-salir{
            width:100%;
        }

        .cards{
            grid-template-columns:1fr;
            gap:18px;
        }

        .card-box{
            padding:22px;
        }

        .tabla-box{
            padding:18px;
        }

    }

    /* ====================================
        CELULARES
    ==================================== */

    @media(max-width:600px){

        .contenido{
            padding:12px;
        }

        .topbar{
            padding:18px 15px;

            border-radius:18px;
        }

        .topbar h1{
            font-size:22px;
        }

        .topbar p{
            font-size:13px;
        }

        .cards{
            grid-template-columns:1fr;
        }

        .card-box{
            padding:20px;

            border-radius:20px;
        }

        .card-box p{
            font-size:28px;
        }

        .tabla-box{
            padding:15px;

            border-radius:18px;
        }

        .menu a{
            font-size:14px;

            padding:12px 14px;
        }

        .logo img{
            width:80px;
        }

        table{
            min-width:550px;
        }

        table th,
        table td{
            padding:12px;
            font-size:12px;
        }

    }

    /* ====================================
        MINI CELULARES
    ==================================== */

    @media(max-width:400px){

        .contenido{
            padding:10px;
        }

        .topbar{
            padding:16px 14px;
        }

        .card-box{
            padding:18px;
        }

        .tabla-box{
            padding:14px;
        }

        table{
            min-width:500px;
        }

        .btn-custom,
        .btn-salir{
            font-size:13px;

            padding:11px;
        }

        .acciones-tabla{
            flex-direction:column;
        }

        .btn-pagar{
            width:100%;
        }

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
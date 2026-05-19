<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root{
            --gradiente: linear-gradient(135deg, #818cf8, #a855f7);
            --azul: linear-gradient(135deg, #60a5fa, #2563eb);
            --verde: linear-gradient(135deg, #4ade80, #16a34a);
            --fondo: #f1f5f9;
            --texto: #475569;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: var(--fondo);
            padding: 40px 20px;
            color: var(--texto);
            min-height: 100vh;
        }

        .container{
            max-width: 1100px;
            margin: auto;
        }

        /* ENLACE DE RETORNO */
        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            transition: .3s;
        }

        .btn-volver:hover {
            color: #a855f7;
            transform: translateX(-3px);
        }

        /* ENCABEZADO DE LA SECCIÓN */
        .top{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h1{
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h1 i {
            background: var(--gradiente);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* BOTÓN NUEVO */
        .btn-nuevo{
            background: var(--gradiente);
            color: white;
            padding: 12px 24px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.2);
            transition: .3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nuevo:hover{
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.35);
            color: white;
        }

        /* ALERTA DE MENSAJES */
        .alerta-exito {
            background: #dcfce7;
            color: #16a34a;
            padding: 15px 20px;
            border-radius: 14px;
            margin-bottom: 25px;
            font-weight: 500;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 5px solid #22c55e;
        }

        /* CAJA DE TABLA RESPONSIVA */
        .tabla-box{
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            min-width: 600px; /* Evita que la tabla colapse de forma ilegible */
        }

        th{
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            padding: 16px;
            text-align: left;
            border-bottom: 2px solid #f1f5f9;
        }

        td{
            padding: 18px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 15px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* ROLES / BADGES */
        .badge-rol {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
            text-align: center;
        }

        .admin{
            background: #dcfce7;
            color: #15803d;
        }

        .tecnico{
            background: #e0f2fe;
            color: #0369a1;
        }

        /* RESPONSIVO AJUSTES FINALES */
        @media (max-width: 576px) {
            body {
                padding: 20px 10px;
            }
            .top {
                flex-direction: column;
                align-items: flex-start;
            }
            .btn-nuevo {
                width: 100%;
                justify-content: center;
            }
            h1 {
                font-size: 24px;
            }
            .tabla-box {
                padding: 15px;
                border-radius: 16px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <a href="/dashboard" class="btn-volver">
        <i class="fa-solid fa-arrow-left"></i> Volver al Dashboard
    </a>

    <div class="top">
        <h1><i class="fa-solid fa-users-gear"></i> Usuarios del Sistema</h1>
        <a href="/admin/usuarios/create" class="btn-nuevo">
            <i class="fa-solid fa-plus"></i> Nuevo Usuario
        </a>
    </div>

    {{-- ALERTAS DE SESIÓN --}}
    @if(session('success'))
        <div class="alerta-exito">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    {{-- CONTENEDOR DE LA TABLA --}}
    <div class="tabla-box">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol asignado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $u)
                    <tr>
                        <td><strong>{{ $u->name }}</strong></td>
                        <td style="color: #64748b;">{{ $u->email }}</td>
                        <td>
                            <span class="badge-rol {{ strtolower($u->role) }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
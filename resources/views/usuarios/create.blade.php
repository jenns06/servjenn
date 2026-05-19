<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root{
            --gradiente: linear-gradient(135deg, #818cf8, #a855f7);
            --fondo: #f1f5f9;
            --texto: #475569;
            --input-border: #cbd5e1;
            --input-focus: #a855f7;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: var(--fondo);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: var(--texto);
        }

        .card{
            background: white;
            width: 100%;
            max-width: 500px;
            padding: 40px 35px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        /* BOTÓN VOLVER */
        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 25px;
            transition: .3s;
        }

        .btn-volver:hover {
            color: #a855f7;
            transform: translateX(-3px);
        }

        h1{
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 30px;
            background: var(--gradiente);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grupo{
            margin-bottom: 22px;
        }

        label{
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #334155;
        }

        .input-contenedor {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-contenedor i {
            position: absolute;
            left: 15px;
            color: #94a3b8;
            font-size: 16px;
        }

        input, select{
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 1px solid var(--input-border);
            border-radius: 14px;
            outline: none;
            font-size: 15px;
            color: #1e293b;
            background-color: #f8fafc;
            transition: all .3s ease;
        }

        /* Ajuste específico para select ya que la flecha nativa ocupa espacio */
        select {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 18px;
            padding-right: 40px;
        }

        input:focus, select:focus{
            border-color: var(--input-focus);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
        }

        button[type="submit"]{
            width: 100%;
            background: var(--gradiente);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 14px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.25);
            transition: .3s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
        }

        button[type="submit"]:hover{
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.35);
            opacity: 0.95;
        }

        button[type="submit"]:active{
            transform: translateY(0);
        }

        /* RESPONSIVO */
        @media(max-width: 576px){
            body {
                padding: 15px;
            }
            .card{
                padding: 30px 20px;
                border-radius: 20px;
            }
            h1 {
                font-size: 22px;
                margin-bottom: 25px;
            }
            input, select {
                padding: 12px 12px 12px 42px;
                font-size: 14px;
            }
            button[type="submit"] {
                padding: 13px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>

<div class="card">

    <a href="/dashboard" class="btn-volver">
        <i class="fa-solid fa-arrow-left"></i> Volver al Dashboard
    </a>

    <h1><i class="fa-solid fa-user-plus"></i> Crear Usuario</h1>

    <form method="POST" action="/admin/usuarios/create">

        @csrf

        <div class="grupo">
            <label>Nombre Completo</label>
            <div class="input-contenedor">
                <i class="fa-solid fa-user"></i>
                <input
                    type="text"
                    name="name"
                    placeholder="Ej. Juan Pérez"
                    required
                >
            </div>
        </div>

        <div class="grupo">
            <label>Correo Electrónico</label>
            <div class="input-contenedor">
                <i class="fa-solid fa-envelope"></i>
                <input
                    type="email"
                    name="email"
                    placeholder="ejemplo@servjenn.com"
                    required
                >
            </div>
        </div>

        <div class="grupo">
            <label>Contraseña</label>
            <div class="input-contenedor">
                <i class="fa-solid fa-lock"></i>
                <input
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    required
                >
            </div>
        </div>

        <div class="grupo">
            <label>Rol asignado</label>
            <div class="input-contenedor">
                <i class="fa-solid fa-user-shield"></i>
                <select name="role" required>
                    <option value="" disabled selected>Selecciona un rol...</option>
                    <option value="admin">Admin</option>
                    <option value="tecnico">Técnico</option>
                </select>
            </div>
        </div>

        <button type="submit">
            <i class="fa-solid fa-floppy-disk"></i> Registrar Usuario
        </button>

    </form>

</div>

</body>
</html>
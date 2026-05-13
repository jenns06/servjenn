<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Servicio - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- ICONOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-grad: linear-gradient(135deg, #6366f1, #8b5cf6);
            --glass: rgba(255, 255, 255, 0.9);
            --text-dark: #1e293b;
            --text-light: #64748b;
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: var(--glass);
            width: 100%;
            max-width: 700px;
            padding: 40px;
            border-radius: 30px;
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.4);
        }

        .header-edit {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-edit i {
            font-size: 40px;
            color: #6366f1;
            margin-bottom: 10px;
        }

        .titulo {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .formulario {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width {
            grid-column: span 2;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-light);
            margin-left: 5px;
        }

        input, textarea, select {
            padding: 12px 18px;
            border-radius: 15px;
            border: 1px solid #e2e8f0;
            background: white;
            font-size: 14px;
            color: var(--text-dark);
            transition: .3s;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        textarea {
            height: 100px;
            resize: none;
        }

        .btn-actualizar {
            grid-column: span 2;
            background: var(--primary-grad);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .btn-actualizar:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(99, 102, 241, 0.3);
        }

        .btn-cancelar {
            grid-column: span 2;
            text-align: center;
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            margin-top: 15px;
        }

        /* Notificación */
        .notificacion {
            grid-column: span 2;
            background: #dcfce7;
            color: #15803d;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            .formulario { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .btn-actualizar { grid-column: span 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-edit">
        <i class="fa-solid fa-pen-to-square"></i>
        <h1 class="titulo">Editar Servicio</h1>
        <p style="color: #64748b; font-size: 14px;">Actualiza la información técnica del cliente</p>
    </div>

    @if(session('success'))
        <div class="notificacion">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/clientes/{{ $cliente->id_cliente }}" class="formulario">
        @csrf
        @method('PUT')

        {{-- Nombre del Cliente --}}
        <div class="campo">
            <label><i class="fa-solid fa-user me-1"></i> Nombre del Cliente</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" placeholder="Ej. Juan Pérez" required>
        </div>

        {{-- Teléfono --}}
        <div class="campo">
            <label><i class="fa-solid fa-phone me-1"></i> Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" maxlength="10"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="0999999999" required>
        </div>

        {{-- Dispositivo --}}
        <div class="campo">
            <label><i class="fa-solid fa-laptop me-1"></i> Dispositivo</label>
            <input type="text" name="dispositivo" value="{{ $cliente->tipo }}" placeholder="Ej. Laptop Dell" required>
        </div>

        {{-- Estado / Proceso --}}
        <div class="campo">
            <label><i class="fa-solid fa-spinner me-1"></i> Estado del Proceso</label>
            <select name="estado" required>
                <option value="pendiente" {{ $cliente->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="proceso" {{ $cliente->estado == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="finalizado" {{ $cliente->estado == 'finalizado' ? 'selected' : '' }}>Finalizado / Listo</option>
            </select>
        </div>

        {{-- Descripción del problema --}}
        <div class="campo full-width">
            <label><i class="fa-solid fa-comment-dots me-1"></i> Descripción del Problema / Diagnóstico</label>
            <textarea name="descripcion" placeholder="Detalla el fallo del equipo..." required>{{ $cliente->problema }}</textarea>
        </div>

        {{-- Precio --}}
        <div class="campo full-width">
            <label><i class="fa-solid fa-hand-holding-dollar me-1"></i> Precio del Servicio ($)</label>
            <input type="number" name="precio" value="{{ $cliente->precio }}" step="0.01" placeholder="0.00" required>
        </div>

        <button type="submit" class="btn-actualizar">
            <i class="fa-solid fa-save me-2"></i> Guardar Cambios
        </button>

        <a href="/dashboard" class="btn-cancelar">Volver al panel principal</a>
    </form>
</div>

</body>
</html>
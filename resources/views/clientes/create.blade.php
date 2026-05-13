<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Servicio - ServJenn</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-grad: linear-gradient(135deg, #6366f1, #8b5cf6);
            --text-dark: #1e293b;
            --glass: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            background: var(--glass);
            width: 100%;
            max-width: 800px;
            padding: 40px;
            border-radius: 30px;
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.3);
            position: relative;
        }

        /* BOTÓN REGRESAR */
        .nav-top {
            position: absolute;
            top: 30px;
            left: 30px;
        }

        .btn-regresar {
            text-decoration: none;
            color: #6366f1;
            background: #f1f5f9;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            transition: .3s;
        }

        .btn-regresar:hover {
            background: #6366f1;
            color: white;
            transform: translateX(-3px);
        }

        .header-registro {
            text-align: center;
            margin-bottom: 35px;
        }

        .header-registro i {
            font-size: 45px;
            color: #6366f1;
            margin-bottom: 10px;
        }

        .titulo {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* ERRORES */
        .notificacion {
            background: #fee2e2;
            color: #b91c1c;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .notificacion ul {
            list-style: none;
            padding-left: 5px;
        }

        /* FORMULARIO GRID */
        .formulario {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .campo {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .full-width {
            grid-column: span 2;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-left: 5px;
        }

        input, textarea, select {
            padding: 12px 18px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
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

        small {
            font-size: 11px;
            color: #94a3b8;
            margin-top: -5px;
            margin-left: 5px;
        }

        .btn-guardar {
            grid-column: span 2;
            background: var(--primary-grad);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 15px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: .4s;
            margin-top: 15px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-guardar:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
            filter: brightness(1.1);
        }

        @media (max-width: 600px) {
            .formulario { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .btn-guardar { grid-column: span 1; }
            .nav-top { position: relative; top: 0; left: 0; margin-bottom: 20px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="nav-top">
        <a href="{{ url('/clientes') }}" class="btn-regresar" title="Volver a la lista">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <div class="header-registro">
        <i class="fa-solid fa-toolbox"></i>
        <h1 class="titulo">Registrar Servicio</h1>
        <p style="color: #64748b; font-size: 14px;">Ingrese los datos del nuevo ingreso técnico</p>
    </div>

    @if ($errors->any())
        <div class="notificacion">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/clientes') }}" class="formulario">
        @csrf

        <div class="campo">
            <label><i class="fa-solid fa-user me-1"></i> Nombre del Cliente</label>
            <input type="text" name="nombre" placeholder="Ej: Juan Pérez" value="{{ old('nombre') }}" required>
        </div>

        <div class="campo">
            <label><i class="fa-solid fa-phone me-1"></i> Teléfono</label>
            <input type="text" name="telefono" maxlength="10" 
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                   placeholder="0999999999" value="{{ old('telefono') }}" required>
            <small>Solo se permiten 10 dígitos numéricos</small>
        </div>

        <div class="campo">
            <label><i class="fa-solid fa-mobile-screen me-1"></i> Dispositivo / Equipo</label>
            <input type="text" name="dispositivo" placeholder="Ej: Samsung A12 o Laptop HP" value="{{ old('dispositivo') }}" required>
        </div>

        <div class="campo">
            <label><i class="fa-solid fa-credit-card me-1"></i> Método de Pago</label>
            <select name="tipo_pago" required>
                <option value="">Seleccione...</option>
                <option value="efectivo" {{ old('tipo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="tarjeta" {{ old('tipo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                <option value="transferencia" {{ old('tipo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
            </select>
        </div>

        <div class="campo full-width">
            <label><i class="fa-solid fa-clipboard-list me-1"></i> Descripción del Problema</label>
            <textarea name="descripcion" placeholder="Detalle la falla reportada por el cliente..." required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="campo full-width">
            <label><i class="fa-solid fa-dollar-sign me-1"></i> Precio Estimado</label>
            <input type="number" name="precio" step="0.01" placeholder="0.00" value="{{ old('precio') }}" required>
        </div>

        <button type="submit" class="btn-guardar">
            <i class="fa-solid fa-save me-2"></i> Guardar Servicio Técnico
        </button>
    </form>
</div>

</body>
</html>
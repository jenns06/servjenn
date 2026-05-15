<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - ServJenn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6c7cff 0%, #3f3f8c 100%);
            /* Permitir scroll en pantallas muy pequeñas o con teclado abierto */
            overflow-x: hidden;
            padding: 20px;
        }

        /* Burbujas decorativas */
        body::before, body::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }
        body::before { top: -100px; left: -100px; }
        body::after { bottom: -100px; right: -100px; }

        /* TARJETA GLASSMORPHISM RESPONSIVE */
        .card {
            width: 100%;
            max-width: 400px; /* Ancho máximo para escritorio */
            padding: 40px 30px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            text-align: center;
            color: white;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 15px;
            filter: drop-shadow(0 8px 12px rgba(0,0,0,0.3));
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05) rotate(2deg);
        }

        h2 {
            margin-bottom: 5px;
            font-size: clamp(1.5rem, 5vw, 1.8rem); /* Tamaño fluido */
            font-weight: 700;
            letter-spacing: 1px;
        }

        p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 25px;
        }

        /* INPUTS */
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            outline: none;
            color: white;
            font-size: 16px; /* 16px evita el zoom automático en iOS */
            transition: all 0.3s;
        }

        input::placeholder {
            color: rgba(255,255,255,0.7);
        }

        input:focus {
            background: rgba(255,255,255,0.2);
            border-color: white;
            box-shadow: 0 0 15px rgba(255,255,255,0.1);
        }

        /* ROLES */
        .roles {
            display: flex;
            gap: 12px;
            margin: 20px 0;
        }

        .role-card {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            cursor: pointer;
            font-size: 14px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .role-card input {
            display: none;
        }

        .role-card:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .role-card:has(input:checked) {
            background: white;
            color: #3f3f8c;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* BOTÓN */
        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: white;
            color: #3f3f8c;
            font-weight: 800;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.3);
            background: #f8f9ff;
        }

        /* ERRORES */
        .error-msg {
            background: rgba(255, 82, 82, 0.2);
            border: 1px solid #ff5252;
            padding: 10px;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 15px;
            color: #ffdbdb;
        }

        .footer {
            margin-top: 25px;
            font-size: 12px;
            opacity: 0.7;
        }

        /* MEDIA QUERIES PARA MÓVILES */
        @media (max-width: 480px) {
            .card {
                padding: 30px 20px;
                border-radius: 20px;
            }
            
            .logo {
                width: 80px;
            }

            .roles {
                gap: 8px;
            }

            .role-card {
                padding: 10px 5px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<div class="card">
    <img src="{{ asset('img/logo.png') }}" class="logo" alt="Logo ServJenn">

    <h2>ServJenn</h2>
    <p>Sistema de Reparaciones Técnicas</p>

    @if ($errors->any())
        <div class="error-msg">
            <i class="fas fa-exclamation-circle"></i> Usuario o contraseña incorrectos
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Contraseña" required>
        </div>

        <div class="roles">
            <label class="role-card">
                <input type="radio" name="rol_ui" value="tecnico" checked>
                <span>👨‍🔧</span>
                Técnico
            </label>

            <label class="role-card">
                <input type="radio" name="rol_ui" value="admin">
                <span>👨‍💼</span>
                Admin
            </label>
        </div>

        <button type="submit">Entrar al Sistema</button>
    </form>

    <div class="footer">
        &copy; 2026 ServJenn | Calidad y Rapidez
    </div>
</div>

</body>
</html>
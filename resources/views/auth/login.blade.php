<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - ServJenn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at top, #6c7cff, #3f3f8c);
        }

        /* TARJETA */
        .card {
            width: 360px;
            padding: 40px 30px;
            border-radius: 20px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            text-align: center;
            color: white;
        }

        /* LOGO GRANDE */
        .logo {
            width: 140px;
            margin-bottom: 10px;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.3));
        }

        h2 {
            margin-bottom: 5px;
            font-size: 22px;
        }

        p {
            font-size: 13px;
            opacity: 0.85;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 10px;
            outline: none;
        }

        input:focus {
            transform: scale(1.02);
        }

        /* 🔥 ROLES MEJORADOS */
        .roles {
            display: flex;
            gap: 10px;
            margin: 15px 0;
        }

        .role-card {
            flex: 1;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255,255,255,0.25);
            cursor: pointer;
            font-size: 13px;
            color: white;
            text-align: center;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .role-card input {
            display: none;
        }

        .role-card:hover {
            transform: scale(1.03);
            background: rgba(255,255,255,0.35);
        }

        .role-card:has(input:checked) {
            background: white;
            color: #3f3f8c;
            font-weight: bold;
        }

        /* BOTÓN */
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: white;
            color: #3f3f8c;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .footer {
            margin-top: 15px;
            font-size: 11px;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<div class="card">

    <!-- LOGO -->
    <img src="{{ asset('img/logo.png') }}" class="logo">

    <h2>ServJenn</h2>
    <p>Sistema de reparaciones</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <!-- ROLES EN CAJAS -->
        <div class="roles">

            <label class="role-card">
                <input type="radio" name="rol_ui">
                👨‍🔧 Técnico
            </label>

            <label class="role-card">
                <input type="radio" name="rol_ui">
                👨‍💼 Admin
            </label>

        </div>

        <button type="submit">Iniciar sesión</button>
    </form>

    <div class="footer">
        © ServJenn 2026
    </div>

</div>

</body>
</html>
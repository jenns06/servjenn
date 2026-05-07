<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - ServJenn</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#6c63ff,#b16cea);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .card{
            background:white;
            width:100%;
            max-width:500px;
            padding:35px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        h1{
            text-align:center;
            margin-bottom:25px;
            color:#444;
        }

        .grupo{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
            color:#555;
        }

        input,
        select{
            width:100%;
            padding:14px;
            border:1px solid #ddd;
            border-radius:10px;
            outline:none;
        }

        button{
            width:100%;
            background:#6c63ff;
            color:white;
            border:none;
            padding:15px;
            border-radius:12px;
            cursor:pointer;
            font-size:16px;
            font-weight:bold;
        }

        button:hover{
            opacity:.9;
        }

    </style>
</head>
<body>

<div class="card">

    <h1>Crear Usuario</h1>

    <form method="POST" action="/admin/usuarios/create">

        @csrf

        <div class="grupo">

            <label>Nombre</label>

            <input
                type="text"
                name="name"
                required
            >

        </div>

        <div class="grupo">

            <label>Email</label>

            <input
                type="email"
                name="email"
                required
            >

        </div>

        <div class="grupo">

            <label>Contraseña</label>

            <input
                type="password"
                name="password"
                required
            >

        </div>

        <div class="grupo">

            <label>Rol</label>

            <select name="role" required>

                <option value="admin">
                    Admin
                </option>

                <option value="tecnico">
                    Técnico
                </option>

            </select>

        </div>

        <button type="submit">
            Crear Usuario
        </button>

    </form>

</div>

</body>
</html>
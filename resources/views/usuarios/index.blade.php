<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - ServJenn</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f6fb;
            padding:30px;
        }

        .container{
            max-width:1100px;
            margin:auto;
        }

        .top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        h1{
            color:#333;
        }

        .btn{
            background:#6c63ff;
            color:white;
            padding:12px 20px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .btn:hover{
            opacity:.9;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 10px 20px rgba(0,0,0,0.08);
        }

        th{
            background:#6c63ff;
            color:white;
            padding:15px;
            text-align:left;
        }

        td{
            padding:15px;
            border-bottom:1px solid #eee;
        }

        .admin{
            background:#4caf50;
            color:white;
            padding:5px 10px;
            border-radius:20px;
            font-size:13px;
        }

        .tecnico{
            background:#2196f3;
            color:white;
            padding:5px 10px;
            border-radius:20px;
            font-size:13px;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="top">

        <h1>Usuarios del Sistema</h1>

        <a href="/admin/usuarios/create" class="btn">
            + Nuevo Usuario
        </a>

    </div>

    @if(session('success'))
        <p style="color:green; margin-bottom:15px;">
            {{ session('success') }}
        </p>
    @endif

    <table>

        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>

        <tbody>

            @foreach($usuarios as $u)

            <tr>

                <td>{{ $u->name }}</td>

                <td>{{ $u->email }}</td>

                <td>

                    <span class="{{ $u->role }}">
                        {{ ucfirst($u->role) }}
                    </span>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</body>
</html>
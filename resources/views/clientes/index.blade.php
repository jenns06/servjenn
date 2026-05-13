<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes - ServJenn</title>

    {{-- GOOGLE FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- ICONOS Y CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            color: var(--text-dark);
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--glass);
            padding: 40px;
            border-radius: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.3);
        }

        .nav-top {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .btn-regresar {
            text-decoration: none;
            color: #6366f1;
            background: white;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: .3s;
        }

        .btn-regresar:hover {
            background: #6366f1;
            color: white;
            transform: translateX(-3px);
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .titulo {
            font-size: 26px;
            font-weight: 700;
            color: #4338ca;
        }

        .search-box {
            display: flex;
            gap: 10px;
            background: #f1f5f9;
            padding: 8px 15px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #e2e8f0;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .search-box button {
            background: var(--primary-grad);
            border: none;
            color: white;
            padding: 8px 15px;
            border-radius: 10px;
            cursor: pointer;
        }

        .btn-nuevo {
            background: #22c55e;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .3s;
        }

        .btn-nuevo:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(34, 197, 94, 0.2); }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: #f8fafc;
            border-bottom: 2px solid #edf2f7;
        }

        th {
            padding: 15px;
            text-align: left;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .cliente-link {
            text-decoration: none;
            color: #4338ca;
            font-weight: 600;
        }

        .dispositivo-tag {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .estado {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .pendiente { background: #fee2e2; color: #ef4444; }
        .proceso   { background: #fef3c7; color: #d97706; }
        .finalizado { background: #dcfce7; color: #15803d; }

        .acciones { display: flex; gap: 8px; }

        .btn-edit {
            color: #6366f1; background: #eef2ff;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; text-decoration: none;
        }

        .btn-delete {
            color: #f43f5e; background: #fff1f2;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; border: none; cursor: pointer;
        }

        @media (max-width: 768px) {
            .header-flex { flex-direction: column; }
            .search-box { max-width: 100%; }
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="nav-top">
        <a href="/dashboard" class="btn-regresar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <span style="color: #64748b; font-size: 13px;">Panel Principal</span>
    </div>

    <div class="header-flex">
        <h1 class="titulo">Gestión de Clientes</h1>
        
        <form method="GET" action="{{ url('/clientes') }}" class="search-box">
            <input type="text" name="buscar" placeholder="Nombre, teléfono o equipo..." value="{{ request('buscar') }}">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <a href="/clientes/create" class="btn-nuevo">
            <i class="fa-solid fa-plus"></i> Nuevo Registro
        </a>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Actualizado!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Dispositivo</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td>
                            <a href="/clientes/{{ $cliente->id_cliente }}" class="cliente-link">
                                {{ $cliente->nombre }}
                            </a>
                        </td>
                        <td>
                            <span class="dispositivo-tag">
                                <i class="fa-solid fa-microchip" style="font-size: 11px; opacity: 0.7;"></i>
                                {{ $cliente->tipo ?? 'No especificado' }}
                            </span>
                        </td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>
                            @php $estadoClase = strtolower($cliente->estado ?? 'pendiente'); @endphp
                            <span class="estado {{ $estadoClase }}">
                                {{ ucfirst($cliente->estado ?? 'pendiente') }}
                            </span>
                        </td>
                        <td>
                            <div class="acciones">
                                <a href="/clientes/{{ $cliente->id_cliente }}/edit" class="btn-edit" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="/clientes/{{ $cliente->id_cliente }}" method="POST" id="delete-form-{{ $cliente->id_cliente }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete" onclick="confirmDelete({{ $cliente->id_cliente }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                            No hay clientes que coincidan con la búsqueda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar registro?',
            text: "Se borrarán los datos del cliente y su historial.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f43f5e',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

</body>
</html>
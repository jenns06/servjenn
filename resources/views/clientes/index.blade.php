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

        /* --- BUSCADOR REHECHO PARA RESPONSIVO --- */
        .search-box {
            display: flex;
            gap: 10px;
            background: #f1f5f9;
            padding: 8px 15px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #e2e8f0;
            align-items: center;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: var(--text-dark);
        }

        .search-box button {
            background: var(--primary-grad);
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-box button:hover { opacity: 0.9; }

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

        /* --- TABLA --- */
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
            width: 35px; height: 35px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; text-decoration: none;
        }

        .btn-delete {
            color: #f43f5e; background: #fff1f2;
            width: 35px; height: 35px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; border: none; cursor: pointer;
        }

        .archivo-card {
            margin-top: 40px;
            padding: 25px;
            background: #f8fafc;
            border-radius: 20px;
            border: 1px dashed #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s;
        }

        /* --- RESPONSIVO --- */
        @media (max-width: 768px) {
            body { padding: 15px 10px; }
            .container { padding: 25px 15px; border-radius: 20px; }
            
            .header-flex { 
                flex-direction: column; 
                align-items: stretch; 
                gap: 15px;
                text-align: center;
            }

            .search-box { 
                max-width: 100%; 
                margin: 0;
            }

            .btn-nuevo { 
                width: 100%; 
                justify-content: center; 
            }

            /* Tabla a tarjetas */
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            
            tr { 
                border: 1px solid #e2e8f0; 
                margin-bottom: 20px; 
                border-radius: 20px;
                padding: 10px;
                background: white;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            }

            td { 
                border: none;
                position: relative;
                padding-left: 45% !important;
                text-align: right;
                padding-top: 12px;
                padding-bottom: 12px;
                border-bottom: 1px solid #f8fafc;
            }

            td:last-child { border-bottom: none; }

            td::before { 
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 40%;
                font-weight: 700;
                text-align: left;
                color: #64748b;
                font-size: 11px;
                text-transform: uppercase;
                top: 50%;
                transform: translateY(-50%);
            }

            .acciones { justify-content: flex-end; }
            .archivo-card { flex-direction: column; text-align: center; gap: 20px; }
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

    {{-- ALERTAS SWEETALERT --}}
    @if(session('success'))
        <script>
            Swal.fire({ icon: 'success', title: 'Hecho', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({ icon: 'error', title: 'Atención', text: "{{ session('error') }}", confirmButtonColor: '#6366f1' });
        </script>
    @endif

    <div class="table-responsive">
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
                        <td data-label="Cliente">
                            <a href="/clientes/{{ $cliente->id_cliente }}" class="cliente-link">
                                {{ $cliente->nombre }}
                            </a>
                        </td>
                        <td data-label="Dispositivo">
                            <span class="dispositivo-tag">
                                <i class="fa-solid fa-microchip"></i> {{ $cliente->tipo ?? 'N/A' }}
                            </span>
                        </td>
                        <td data-label="Teléfono">{{ $cliente->telefono }}</td>
                        <td data-label="Estado">
                            @php $estadoClase = strtolower($cliente->estado ?? 'pendiente'); @endphp
                            <span class="estado {{ $estadoClase }}">
                                {{ ucfirst($cliente->estado ?? 'pendiente') }}
                            </span>
                        </td>
                        <td data-label="Acciones">
                            <div class="acciones">
                                <a href="/clientes/{{ $cliente->id_cliente }}/edit" class="btn-edit" title="Editar">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="/clientes/{{ $cliente->id_cliente }}" method="POST" id="delete-form-{{ $cliente->id_cliente }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete" onclick="confirmDelete({{ $cliente->id_cliente }}, '{{ $cliente->estado }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #94a3b8;">
                            No se encontraron resultados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="archivo-card">
        <div style="display: flex; align-items: center; gap: 15px; text-align: left;">
            <div style="width: 50px; height: 50px; background: #e0e7ff; color: #6366f1; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 20px;">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div>
                <h2 style="font-size: 18px; color: #1e293b;">Historial</h2>
                <p style="font-size: 13px; color: #64748b;">Equipos terminados.</p>
            </div>
        </div>
        <a href="{{ route('clientes.archivo') }}" style="background: white; color: #6366f1; text-decoration: none; padding: 10px 20px; border-radius: 12px; font-weight: 600; border: 1px solid #e0e7ff; display: flex; align-items: center; gap: 8px;">
            Ver Archivo <i class="fa-solid fa-clock-rotate-left"></i>
        </a>
    </div>
</div>

<script>
    function confirmDelete(id, estado) {
        const est = estado.toLowerCase();
        if (est === 'proceso' || est === 'pendiente') {
            Swal.fire({
                icon: 'error',
                title: 'No se puede archivar',
                text: 'El equipo todavía está en ' + est.toUpperCase() + '.',
                confirmButtonColor: '#6366f1'
            });
            return;
        }

        Swal.fire({
            title: '¿Archivar cliente?',
            text: "Se moverá al historial.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Sí, archivar'
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('delete-form-' + id).submit();
        });
    }
</script>

</body>
</html>
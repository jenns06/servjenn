<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Clientes - ServJenn</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-grad: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --glass: rgba(255, 255, 255, 0.95);
        }
        body {
            background: var(--primary-grad);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Poppins', sans-serif;
        }
        .card-custom {
            background: var(--glass);
            padding: 40px;
            border-radius: 30px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .btn-restore {
            background: #10b981;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-restore:hover { 
            background: #059669; 
            transform: translateY(-2px); 
            color: white;
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
    </style>
</head>
<body>

<div class="container">
    <div class="nav-top">
        <a href="/clientes" class="btn-regresar">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
        <span class="text-white-50">Volver a Gestión de Clientes</span>
    </div>

    <div class="card-custom">
        <h2 class="fw-bold mb-4" style="color: #4338ca;">
            <i class="fa-solid fa-clock-rotate-left me-2"></i>Historial de Clientes
        </h2>
        <p class="text-muted mb-4">Desde aquí puedes reincorporar clientes para registrarles un nuevo dispositivo sin tener que escribir sus datos otra vez.</p>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Teléfono</th>
                        <th class="text-end">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientesOcultos as $cliente)
                        <tr>
                            <td class="fw-bold text-dark">{{ $cliente->nombre }}</td>
                            <td class="text-muted">{{ $cliente->telefono }}</td>
                            <td class="text-end">
                                <form action="{{ route('clientes.restaurar', $cliente->id_cliente) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-restore">
                                        <i class="fa-solid fa-plus"></i> Nuevo Equipo
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox d-block mb-2" style="font-size: 2rem; opacity: 0.2;"></i>
                                No hay clientes archivados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
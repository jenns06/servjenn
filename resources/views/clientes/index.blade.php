<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>

    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
</head>
<body>

<div class="container">
    <h1 class="titulo">Lista de Clientes</h1>

    <!-- BUSCADOR -->
    <form method="GET" action="{{ url('/clientes') }}" class="formulario">
        <input type="text" name="buscar" placeholder="Buscar cliente..." value="{{ request('buscar') }}">
        <button type="submit">Buscar</button>
    </form>

    <br>

    <!-- BOTÓN NUEVO -->
    <a href="/clientes/create" class="btn btn-primary">+ Nuevo Cliente</a>

    <br><br>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>
                        <a href="/clientes/{{ $cliente->id_cliente }}">
                            {{ $cliente->nombre }}
                        </a>
                    </td>

                    <td>{{ $cliente->telefono }}</td>

                    <td>
                        <span class="estado {{ $cliente->estado }}">
                            {{ ucfirst($cliente->estado) }}
                        </span>
                    </td>

                    <td>
                        <!-- EDITAR -->
                        <a href="/clientes/{{ $cliente->id_cliente }}/edit">
                            ✏️ Editar
                        </a>

                        <!-- ELIMINAR (DELETE correcto) -->
                        <form action="/clientes/{{ $cliente->id_cliente }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('¿Seguro que deseas eliminar este cliente?')"
                                style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
                                🗑 Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
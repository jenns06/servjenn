<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Servicio</title>

    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
</head>
<body>

<div class="container">
    <h1 class="titulo">Editar Servicio</h1>

    @if(session('success'))
        <div class="notificacion">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/clientes/{{ $cliente->id_cliente }}" class="formulario">
        @csrf
        @method('PUT')

        <input type="text" name="nombre" value="{{ $cliente->nombre }}" required>

        <input type="text" name="telefono" value="{{ $cliente->telefono }}" maxlength="10"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>

        <input type="text" name="dispositivo" value="{{ $cliente->tipo }}" required>

        <textarea name="descripcion" required>{{ $cliente->problema }}</textarea>

        <input type="number" name="precio" value="{{ $cliente->precio }}" required>

        <button type="submit">Actualizar</button>
    </form>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Servicio</title>
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
</head>
<body>

<div class="container">
    <h1 class="titulo">Detalle del Servicio</h1>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>Cliente:</strong> {{ $cliente->nombre }}</p>
    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
    <p><strong>Dispositivo:</strong> {{ $cliente->tipo }}</p>
    <p><strong>Problema:</strong> {{ $cliente->problema }}</p>
    <p><strong>Precio:</strong> ${{ $cliente->precio }}</p>

    <p>
        <strong>Estado:</strong>
        <span class="estado {{ $cliente->estado }}">
            {{ ucfirst($cliente->estado) }}
        </span>
    </p>

    <form method="POST" action="/dispositivos/{{ $cliente->id_dispositivo }}/estado">
        @csrf
        @method('PUT')

        <select name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="proceso">En proceso</option>
            <option value="listo">Listo</option>
        </select>

        <button class="btn btn-primary">Actualizar Estado</button>
    </form>

</div>

</body>
</html>
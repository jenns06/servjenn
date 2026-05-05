<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Técnico</title>
</head>
<body>

<h1>Detalle del Técnico</h1>

<h2>{{ $tecnico->name }}</h2>

<h3>Total ganado: $ {{ $total }}</h3>

<br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Dispositivo</th>
            <th>Problema</th>
            <th>Estado</th>
            <th>Precio</th>
        </tr>
    </thead>

    <tbody>
        @foreach($trabajos as $t)
        <tr>
            <td>{{ $t->tipo }}</td>
            <td>{{ $t->problema }}</td>
            <td>{{ $t->estado }}</td>
            <td>$ {{ $t->precio }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<!-- BOTÓN AVISAR PAGO -->
<form method="POST" action="/admin/pagar/{{ $tecnico->id }}">
    @csrf
    <button style="background:green; color:white; padding:10px;">
        💰 Avisar pago
    </button>
</form>

</body>
</html>
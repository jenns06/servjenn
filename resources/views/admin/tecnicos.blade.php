<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Técnicos</title>
</head>
<body>

<h1>Lista de Técnicos</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Trabajos</th>
            <th>Total Ganado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tecnicos as $tec)
            <tr>
                <td>{{ $tec->name }}</td>
                <td>{{ $tec->total_trabajos }}</td>
                <td>$ {{ $tec->total_dinero ?? 0 }}</td>

                <td>
                    <a href="/admin/tecnico/{{ $tec->id }}">
                        Ver detalles
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
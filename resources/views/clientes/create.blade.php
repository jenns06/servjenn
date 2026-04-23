<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Servicio</title>

    <!-- ESTILO -->
   <link rel="stylesheet" href="/css/clientes.css">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="titulo">Registrar Servicio</h1>

    @if ($errors->any())
        <div class="notificacion">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/clientes') }}" class="formulario">
        @csrf

        <label>Nombre del cliente</label>
        <input type="text" name="nombre" placeholder="Ej: Juan Pérez" required>

        <label>Teléfono</label>
        <input type="text" name="telefono" maxlength="10"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            placeholder="Solo números" required>
        <small>Ingrese solo números</small>

        <label>Dispositivo</label>
        <input type="text" name="dispositivo" placeholder="Ej: Samsung A12" required>

        <label>Descripción del problema</label>
        <textarea name="descripcion" placeholder="Explique el problema..." required></textarea>

        <label>Precio</label>
        <input type="number" name="precio" step="0.01" placeholder="Ej: 50.00" required>

        <label>Tipo de pago</label>
        <select name="tipo_pago" required>
            <option value="">Seleccione tipo de pago</option>
            <option value="efectivo">Efectivo</option>
            <option value="tarjeta">Tarjeta</option>
            <option value="transferencia">Transferencia</option>
        </select>

        <button type="submit">Guardar Servicio</button>
    </form>
</div>

</body>
</html>  
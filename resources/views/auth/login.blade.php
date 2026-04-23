<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ServJenn - Login</title>

  <!-- Fuente bonita -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="login-container">

    <!-- LOGO -->
    <img src="logo2.png" alt="Logo ServJenn" class="logo">

    <h1>ServJenn</h1>
    <p class="subtitulo">Sistema de reparaciones</p>

    <form>
      <input type="text" placeholder="Usuario" required>
      <input type="password" placeholder="Contraseña" required>

      <div class="roles">
        <label class="rol">
          <input type="radio" name="rol" checked>
          👨‍🔧 Técnico
        </label>

        <label class="rol">
          <input type="radio" name="rol">
          👨‍💼 Administrador
        </label>
      </div>

      <button type="submit">Iniciar sesión</button>
    </form>
  </div>

</body>
</html>

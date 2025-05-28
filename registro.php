<?php
// registro.php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrarse | Airbnb</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="modal.css" />
</head>
<body>
  <main style="padding: 2rem;">
    <h2>Registrate en Airbnb</h2>
    <form method="POST" action="register.php" style="max-width: 400px; margin-top: 1rem;">
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>

      <label for="apellido">Apellido</label>
      <input type="text" id="apellido" name="apellido" required>

      <label for="email">Correo electrónico</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" class="continue-button" style="margin-top: 1rem;">Registrarse</button>
    </form>
  </main>
</body>
</html>

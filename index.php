<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Maqueta Airbnb</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="modal.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="logo">airbnb</div>
    <div class="search-bar">
      <form method="GET" action="">
        <input type="text" name="busqueda" placeholder="¿A dónde vas?" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>" />
          <button type="submit">Buscar</button>
      </form>
    </div>
    <nav class="menu">
      <a href="#">Hazte anfitrión</a>
      <a href="publicar.php">Publicar alojamiento</a>
      <a href="#">Ayuda</a>
      <button id="abrirModal" class="login-button">Iniciar sesión</button>
    </nav>
  </header>

  <main>
  <h2>Explorá alojamientos populares</h2>
  <section class="cards">
    <?php
      include 'conexion.php';
      $busqueda = isset($_GET['busqueda']) ? $conn->real_escape_string($_GET['busqueda']) : '';
      $sql = "SELECT * FROM alquileres";

      if (!empty($busqueda)) {
        $sql .= " WHERE direccion LIKE '%$busqueda%' 
                  OR titulo LIKE '%$busqueda%' 
                  OR tipoAlojamiento LIKE '%$busqueda%'";
      }

      $resultado = $conn->query($sql);

      if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
          echo '
            <div class="card">
              <img src="' . htmlspecialchars($row["urlimg"]) . '" alt="' . htmlspecialchars($row["titulo"]) . '" />
              <div class="info">
                <h3>' . htmlspecialchars($row["titulo"]) . '</h3>
                <p>' . htmlspecialchars($row["descripcion"]) . '</p>
                <p>' . ($row["disponible"]
                          ? "$" . number_format($row["precio_por_noche"], 2) . " / noche"
                          : "No disponible") . '</p>
              </div>
            </div>';
        }
      } else {
        echo "<p>No se encontraron alojamientos.</p>";
      }

      $conn->close();
    ?>
  </section>
  </main>


  <footer>
    <p>© 2025 Maqueta Airbnb — Creado con fines educativos</p>
  </footer>

  <!-- Modal -->
  <div class="modal-overlay" id="modal">
    <div class="modal">
      <button class="close-button" id="cerrarModal">×</button>
      <h2>Iniciá sesión o registrate</h2>
      <p class="welcome-text">Te damos la bienvenida a Airbnb</p>

      <form method="POST" action="login.php">
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required />

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required />

        <button type="submit" class="continue-button">Iniciar sesión</button>
      </form>

      <div class="divider"><span>o</span></div>

      <button class="social-button google">
        <img src="https://img.icons8.com/color/16/000000/google-logo.png" /> Registrate con Google
      </button>
      <button class="social-button apple">
        <img src="https://img.icons8.com/ios-filled/16/000000/mac-os.png" /> Continuar con Apple
      </button>
      <button class="social-button email">
        Registrate con un correo electrónico
      </button>
    </div>
  </div>

  <script src="modal.js"></script>
</body>
</html>

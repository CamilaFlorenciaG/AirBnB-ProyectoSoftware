<?php
session_start();
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "1234", "airbnb");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener ID del alojamiento
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar los datos
$sql = "SELECT a.*, p.nombre AS nombre_anfitrion FROM alquileres a 
        JOIN personas p ON a.persona_id = p.id 
        WHERE a.id = $id";
$resultado = $conexion->query($sql);

// Validar existencia
if ($resultado->num_rows === 0) {
    echo "Alojamiento no encontrado.";
    exit;
}

$alojamiento = $resultado->fetch_assoc();
$precio = number_format($alojamiento['precio_por_noche'], 0, ',', '.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($alojamiento['titulo']) ?></title>
  <link rel="stylesheet" href="stylesDetalle.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
      <?php if (isset($_SESSION['persona_id'])): ?>
        <span>Hola, <?php echo htmlspecialchars($_SESSION['persona_nombre']); ?></span>
        <a href="logout.php">Cerrar sesión</a>
        <a href="publicar.php">Publicar alojamiento</a>
        <a href="#">Ayuda</a>
      <?php else: ?>
        <a href="#">Hazte anfitrión</a>
        <a href="publicar.php">Publicar alojamiento</a>
        <a href="#">Ayuda</a>
        <button id="abrirModal" class="login-button">Iniciar sesión</button>
      <?php endif; ?>
    </nav>
  </header>

  <main class="property-detail">
    <h1><?= htmlspecialchars($alojamiento['titulo']) ?></h1>
    <div class="property-actions">
      <span><i class="fas fa-star"></i> 4.95 · <a href="#">210 evaluaciones</a> · <?= htmlspecialchars($alojamiento['direccion']) ?></span>
      <div class="buttons">
        <a href="#"><i class="fas fa-share-alt"></i> Compartir</a>
        <a href="#"><i class="far fa-heart"></i> Guardar</a>
      </div>
    </div>

 <!--   <div class="property-images">
      <div class="main-image">
        <img src="<?= htmlspecialchars($alojamiento['urlimg']) ?>" alt="Imagen principal del alojamiento">
      </div>
    </div> -->

    <div class="galeria-imagenes">
  <a href="<?= htmlspecialchars($alojamiento['urlimg']) ?>" target="_blank">
    <img src="<?= htmlspecialchars($alojamiento['urlimg']) ?>" class="img-principal" alt="Imagen principal">
  </a>
  <div class="imagenes-secundarias">
    <?php if (!empty($alojamiento['urlimg2'])): ?>
      <a href="<?= htmlspecialchars($alojamiento['urlimg2']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($alojamiento['urlimg2']) ?>" alt="Imagen 2">
      </a>
    <?php endif; ?>
    <?php if (!empty($alojamiento['urlimg3'])): ?>
      <a href="<?= htmlspecialchars($alojamiento['urlimg3']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($alojamiento['urlimg3']) ?>" alt="Imagen 3">
      </a>
    <?php endif; ?>
    <?php if (!empty($alojamiento['urlimg4'])): ?>
      <a href="<?= htmlspecialchars($alojamiento['urlimg4']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($alojamiento['urlimg4']) ?>" alt="Imagen 4">
      </a>
    <?php endif; ?>
  </div>
</div>


    <div class="property-overview">
      <div class="overview-left">
        <h2><?= htmlspecialchars($alojamiento['tipoAlojamiento']) ?> en <?= htmlspecialchars($alojamiento['direccion']) ?></h2>
        <p><?= intval($alojamiento['habitaciones']) ?> habitaciones · <?= intval($alojamiento['banos']) ?> baños</p>
        <div class="host-info">
          <img src="img/foto perfil 1 mujer.jpg" alt="Foto del anfitrión" class="host-avatar">
          <div>
            <p>Anfitrión: <?= htmlspecialchars($alojamiento['nombre_anfitrion']) ?></p>
            <p>Superanfitrión</p>
          </div>
        </div>
        <hr>
        <p class="description"><?= nl2br(htmlspecialchars($alojamiento['descripcion'])) ?></p>
        <hr>
        <h2>¿Qué ofrece este alojamiento?</h2>
        <ul class="amenities-list">
            <?php if ($alojamiento['tieneWifi']): ?>
                <li><i class="fas fa-wifi"></i> Wifi</li>
            <?php endif; ?>
            <?php if ($alojamiento['tieneCocina']): ?>
                <li><i class="fas fa-utensils"></i> Cocina</li>
            <?php endif; ?>
            <?php if ($alojamiento['tieneAire']): ?>
                <li><i class="fas fa-snowflake"></i> Aire acondicionado</li>
            <?php endif; ?>
            <?php if ($alojamiento['tieneTelevision']): ?>
                <li><i class="fas fa-tv"></i> Televisión</li>
            <?php endif; ?>
            <?php if (
                !$alojamiento['tieneWifi'] &&
                !$alojamiento['tieneCocina'] &&
                !$alojamiento['tieneAire'] &&
                !$alojamiento['tieneTelevision']
            ): ?>
                <li>No se especificaron servicios.</li>
            <?php endif; ?>
        </ul>

      </div>

      <div class="overview-right">
        <div class="booking-box">
          <div class="price">
            <p><strong>$<?= $precio ?></strong> / noche</p>
            <span class="rating"><i class="fas fa-star"></i> 4.95 · <a href="#">210 evaluaciones</a></span>
          </div>
          <div class="booking-inputs">
            <div class="dates">
              <div class="date-input-group">
                <label for="check-in">Llegada</label>
                <input type="date" id="check-in">
              </div>
              <div class="date-input-group">
                <label for="check-out">Salida</label>
                <input type="date" id="check-out">
              </div>
            </div>
            <div class="guests">
              <label for="adultos">Adultos</label>
              <select id="adultos">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                  <option value="<?= $i ?>" <?= $i == 2 ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <div class="guests">
              <label for="menores">Menores</label>
              <select id="menores">
                <?php for ($i = 0; $i <= 4; $i++): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
              </select>
            </div>
          </div>

          <button class="reserve-button">Reservar</button>
          <p class="small-text">No se te cobrará nada aún</p>

          <span id="precio-noche" style="display: none;"><?= intval($alojamiento['precio_por_noche']) ?></span>

          <div class="price-breakdown">
            <p><span>Tarifa de limpieza</span> <span>$2.000</span></p>
            <p><span>Tarifa de servicio Airbnb</span> <span>$6.000</span></p>
            <p><strong>Total hospedaje: <span id="total-hospedaje">$0</span></strong></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Airbnb. Todos los derechos reservados.</p>
  </footer>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const adultos = document.getElementById("adultos");
      const menores = document.getElementById("menores");
      const checkIn = document.getElementById("check-in");
      const checkOut = document.getElementById("check-out");
      const totalHospedaje = document.getElementById("total-hospedaje");
      const precioNoche = parseInt(document.getElementById("precio-noche").textContent);
      const priceBreakdown = document.querySelector(".price-breakdown");

      const tarifaLimpieza = 2000;
      const tarifaServicio = 6000;

      function validarHuespedes() {
        const total = parseInt(adultos.value) + parseInt(menores.value);
        if (total > 4) {
          alert("No se permiten más de 4 huéspedes.");
          if (parseInt(adultos.value) === 4) {
            menores.value = 0;
          } else {
            menores.value = 4 - parseInt(adultos.value);
          }
        }
      }

      function calcularTotal() {
        const fechaIn = new Date(checkIn.value);
        const fechaOut = new Date(checkOut.value);
        if (checkIn.value && checkOut.value && fechaOut > fechaIn) {
          const noches = Math.ceil((fechaOut - fechaIn) / (1000 * 60 * 60 * 24));
          const subtotal = noches * precioNoche;
          const total = subtotal + tarifaLimpieza + tarifaServicio;

          totalHospedaje.textContent = `$${total.toLocaleString("es-AR")}`;
          priceBreakdown.innerHTML = `
            <p><span>$${precioNoche.toLocaleString("es-AR")} x ${noches} noche${noches > 1 ? 's' : ''}</span> <span>$${subtotal.toLocaleString("es-AR")}</span></p>
            <p><span>Tarifa de limpieza</span> <span>$${tarifaLimpieza.toLocaleString("es-AR")}</span></p>
            <p><span>Tarifa de servicio Airbnb</span> <span>$${tarifaServicio.toLocaleString("es-AR")}</span></p>
            <p class="total-price"><strong>Total</strong> <strong>$${total.toLocaleString("es-AR")}</strong></p>`;
        } else {
          totalHospedaje.textContent = "$0";
        }
      }

      adultos.addEventListener("change", validarHuespedes);
      menores.addEventListener("change", validarHuespedes);
      checkIn.addEventListener("change", calcularTotal);
      checkOut.addEventListener("change", calcularTotal);
    });
  </script>
  <style>
  .galeria-imagenes {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
  }

  .img-principal {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  .imagenes-secundarias {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .imagenes-secundarias img {
    width: 200px;
    height: 130px;
    object-fit: cover;
    border-radius: 6px;
    cursor: pointer;
    transition: transform 0.2s;
  }

  .imagenes-secundarias img:hover {
    transform: scale(1.03);
  }
</style>

</body>
</html>

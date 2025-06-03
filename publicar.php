<?php
session_start();
if (!isset($_SESSION['persona_id']) || !$_SESSION['es_anfitrion']) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Publicar propiedad | Simulación Airbnb</title>
  <link rel="stylesheet" href="stylesPublicar.css"/>
</head>
<body>
  <div class="container">
    <h1>Publicar una propiedad</h1>
    <p class="subtitle">Completá los detalles de tu alojamiento</p>

    <form class="property-form" action="guardar_propiedad.php" method="POST" enctype="multipart/form-data">
      <label for="title">Título del anuncio</label>
      <input type="text" id="title" name="title" placeholder="Ej: Hermoso depto frente al mar" required />

      <label for="description">Descripción</label>
      <textarea id="description" name="description" placeholder="Contá los detalles importantes del alojamiento..." required></textarea>

      <label for="address">Dirección</label>
      <input type="text" id="address" name="address" placeholder="Ej: Av. Siempreviva 742, Springfield" required />

      <label for="type">Tipo de alojamiento</label>
      <select id="type" name="type" required>
        <option value="">Seleccionar</option>
        <option value="departamento">Departamento</option>
        <option value="casa">Casa</option>
        <option value="habitacion">Habitación privada</option>
      </select>

      <div class="inline-fields">
        <div>
          <label for="rooms">Habitaciones</label>
          <input type="number" id="rooms" name="rooms" min="1" value="1" required />
        </div>
        <div>
          <label for="bathrooms">Baños</label>
          <input type="number" id="bathrooms" name="bathrooms" min="1" value="1" required />
        </div>
      </div>

      <label for="price">Precio por noche (USD)</label>
      <input type="number" id="price" name="price" min="0" step="1" placeholder="Ej: 120" required />

      <fieldset>
        <legend>Servicios disponibles</legend>
        <label><input type="checkbox" name="tieneWifi" value="1"> Wifi</label><br>
        <label><input type="checkbox" name="tieneCocina" value="1"> Cocina</label><br>
        <label><input type="checkbox" name="tieneAire" value="1"> Aire acondicionado</label><br>
        <label><input type="checkbox" name="tieneTelevision" value="1"> Televisión</label>
      </fieldset>


      <label for="image1">Imagen principal del alojamiento</label>
      <input type="file" id="image1" name="image1" accept="image/*" required />

      <label for="image2">Imagen adicional 2</label>
      <input type="file" id="image2" name="image2" accept="image/*" />

      <label for="image3">Imagen adicional 3</label>
      <input type="file" id="image3" name="image3" accept="image/*" />

      <label for="image4">Imagen adicional 4</label>
      <input type="file" id="image4" name="image4" accept="image/*" />


      <button type="submit" class="submit-button">Publicar propiedad</button>
    </form>
  </div>
</body>
</html>

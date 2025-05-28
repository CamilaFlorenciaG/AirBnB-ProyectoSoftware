<?php
$host = "localhost";
$db = "airbnb";
$user = "root";
$pass = "1234";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$titulo = $_POST['title'];
$descripcion = $_POST['description'];
$direccion = $_POST['address'];
$tipo = $_POST['type'];
$habitaciones = $_POST['rooms'];
$banos = $_POST['bathrooms'];
$precio = $_POST['price'];
$persona_id = 1;
$disponible = 1;

// Servicios (checkbox: si no están marcados, no llegan)
$wifi = isset($_POST['tieneWifi']) ? 1 : 0;
$cocina = isset($_POST['tieneCocina']) ? 1 : 0;
$aire = isset($_POST['tieneAire']) ? 1 : 0;
$tv = isset($_POST['tieneTelevision']) ? 1 : 0;

// Procesar imágenes
function subirImagen($inputName) {
  if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
    return null;
  }

  $carpetaDestino = "img/";
  $nombreImagen = basename($_FILES[$inputName]["name"]);
  $rutaImagen = $carpetaDestino . uniqid() . "_" . $nombreImagen;

  $check = getimagesize($_FILES[$inputName]["tmp_name"]);
  if ($check === false) {
    return null;
  }

  if (!move_uploaded_file($_FILES[$inputName]["tmp_name"], $rutaImagen)) {
    return null;
  }

  return $rutaImagen;
}

$urlImg1 = subirImagen('image1');
$urlImg2 = subirImagen('image2');
$urlImg3 = subirImagen('image3');
$urlImg4 = subirImagen('image4');

if (!$urlImg1) {
  die("La imagen principal es obligatoria y debe ser válida.");
}

// Insertar en base de datos
$stmt = $conn->prepare("
  INSERT INTO alquileres 
    (titulo, descripcion, direccion, tipoAlojamiento, habitaciones, banos, precio_por_noche, disponible, persona_id, urlImg, urlImg2, urlImg3, urlImg4, tieneWifi, tieneCocina, tieneAire, tieneTelevision) 
  VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
  "ssssiidisssssiiii",
  $titulo, $descripcion, $direccion, $tipo,
  $habitaciones, $banos, $precio, $disponible,
  $persona_id, $urlImg1, $urlImg2, $urlImg3, $urlImg4,
  $wifi, $cocina, $aire, $tv
);

if ($stmt->execute()) {
  echo "Propiedad publicada exitosamente.";
} else {
  echo "Error al guardar la propiedad: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

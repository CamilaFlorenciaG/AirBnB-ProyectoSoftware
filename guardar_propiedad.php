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
$persona_id = 1; // O asignarlo dinámicamente si tienes sistema de login
$disponible = 1;

// Procesar la imagen
$carpetaDestino = "img/";
$nombreImagen = basename($_FILES["image"]["name"]);
$rutaImagen = $carpetaDestino . $nombreImagen;
$uploadOk = 1;
$tipoArchivo = strtolower(pathinfo($rutaImagen, PATHINFO_EXTENSION));

// Validar imagen
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
  die("El archivo no es una imagen válida.");
}

// Mover imagen
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $rutaImagen)) {
  die("Error al subir la imagen.");
}

// Insertar en base de datos
$stmt = $conn->prepare("INSERT INTO alquileres (titulo, descripcion, direccion, tipoAlojamiento, habitaciones, banos, precio_por_noche, disponible, persona_id, urlImg) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiidiss", $titulo, $descripcion, $direccion, $tipo, $habitaciones, $banos, $precio, $disponible, $persona_id, $rutaImagen);

if ($stmt->execute()) {
  echo "Propiedad publicada exitosamente.";
} else {
  echo "Error al guardar la propiedad: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

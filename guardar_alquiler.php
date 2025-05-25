<?php
include 'db.php';

$titulo = $_POST['titulo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$id_persona = $_POST['id_persona'] ?? 0;
$disponible = isset($_POST['disponible']) ? 1 : 0;

if ($titulo && $id_persona) {
  $stmt = $conn->prepare("INSERT INTO alquiler (titulo, descripcion, disponible, id_persona) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssii", $titulo, $descripcion, $disponible, $id_persona);
  $stmt->execute();
  $stmt->close();
}

header("Location: index.php");
exit;
?>
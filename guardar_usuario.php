<?php
include 'db.php';

$pais = $_POST['pais'] ?? '';
$telefono = $_POST['telefono'] ?? '';

if ($pais && $telefono) {
  $stmt = $conn->prepare("INSERT INTO persona (pais, telefono) VALUES (?, ?)");
  $stmt->bind_param("ss", $pais, $telefono);
  $stmt->execute();
  $stmt->close();
}

header("Location: index.php");
exit;
?>

<?php
$host = "localhost";
$user = "root";
$dbname = "airbnb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>

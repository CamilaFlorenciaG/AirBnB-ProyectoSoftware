<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$dbname = "airbnb";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
?>

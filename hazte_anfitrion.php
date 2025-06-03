<?php
session_start();
include 'conexion.php';

if (isset($_SESSION['persona_id'])) {
    $persona_id = $_SESSION['persona_id'];

    $sql = "UPDATE personas SET esAnfitrion = 1 WHERE id = $persona_id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['es_anfitrion'] = 1;
    }
}

$conn->close();
header('Location: index.php');
exit();

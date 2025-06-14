<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validar si el email ya está registrado
    $stmt = $conn->prepare("SELECT id FROM personas WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.location.href='index.php';</script>";
        exit();
    }
    $stmt->close();

    // Encriptar la contraseña
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario
    $esAnfitrion = 0;
    $stmt = $conn->prepare("INSERT INTO personas (nombre, apellido, email, password, esAnfitrion) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error en prepare: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $passwordHashed, $esAnfitrion);


    if ($stmt->execute()) {
        // Guardar sesión e ir al inicio
        $_SESSION['usuario_id'] = $stmt->insert_id;
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_apellido'] = $apellido;
        $_SESSION['es_anfitrion'] = $esAnfitrion;

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Ocurrió un error.'); window.location.href='index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

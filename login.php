<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Buscar el persona por email
    $stmt = $conn->prepare("SELECT id, nombre, apellido, password FROM personas WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $persona = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $persona['password'])) {
            // Guardar datos en la sesión
            $_SESSION['persona_id'] = $persona['id'];
            $_SESSION['persona_nombre'] = $persona['nombre'];
            $_SESSION['persona_apellido'] = $persona['apellido'];

            // Redireccionar a la página principal
            header("Location: index.php");
            exit();
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "persona no encontrado";
    }

    $stmt->close();
    $conn->close();
}

// Si hay error, puedes mostrarlo
if (isset($error)) {
    echo "<script>alert('$error'); window.location.href='index.php';</script>";
}
?>

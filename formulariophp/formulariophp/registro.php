<?php  
require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {

    // Verificar si el email ya existe
    $check = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $check->bindParam(':email', $_POST['email']);
    $check->execute();

    if ($check->rowCount() > 0) {
        $message = '❌ El correo ya está registrado. Intenta con otro.';
    } elseif ($_POST['password'] !== $_POST['confirm_password']) {
        $message = '❌ Las contraseñas no coinciden.';
    } else {
        // Insertar nuevo usuario
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            $message = '✅ Usuario creado correctamente';
        } else {
            $message = '❌ Ocurrió un error al crear el usuario';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css"> <!-- corregido -->
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="registro.php" method="post">
        <input type="text" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="password" name="confirm_password" placeholder="Confirm your password" required>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>


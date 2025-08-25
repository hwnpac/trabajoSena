<?php  
session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: /formulariophp/index.php'); // <--- Cambiado
  exit;
}

require 'database.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  if ($results && password_verify($_POST['password'], $results['password'])) {
    $_SESSION['user_id'] = $results['id'];
    header('Location: /formulariophp/index.php'); // <--- Cambiado
    exit;
  } else {
    
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css"> <!-- corregido si aplica -->
</head>
<body>

    <?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="registro.php">Register</a></span>

    <!-- Mostrar mensaje de error si existe -->
  <?php if (!empty($message)): ?>
    <p class="error-message" style="color: red;"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

    <!-- FORMULARIO -->
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" value="Login">
    </form>
</body>



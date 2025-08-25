<?php  
  session_start();
  require 'database.php';

  $user = null; // Inicializamos siempre

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    if ($results && is_array($results)) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to your App</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

   <?php require 'partials/header.php' ?>

   <?php if (!empty($user) && is_array($user)): ?>
       <br>Welcome, <?= htmlspecialchars($user['email']) ?>
       <br>You are successfully logged in.
       <a href="deslogin.php">Logout</a>
   <?php else: ?>
       <h1>Please login or register</h1>
       <a href="login.php">Login</a> or
       <a href="registro.php">Register</a>
   <?php endif; ?>
</body>
</html>
</a> </span>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>
</body>
<?php   
session_start();
require 'database.php';

$user = null;

if (isset($_SESSION['user_id'])) {
  $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  if ($results && is_array($results)) {
    $user = $results;
  }
}
?>
<?php if (!empty($user) && is_array($user)): ?>
  <!-- Usuario autenticado: mostramos la página completa -->
  <?php include 'barberia.php'; ?>
<?php else: ?>
  <!-- Usuario no autenticado: mostramos el login o registro -->
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="UTF-8">
      <title>Please login</title>
      <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>
      <h1>Please login or register</h1>
      <a href="login.php">Login</a> or
      <a href="registro.php">Register</a>
  </body>
  </html>
<?php endif; ?>


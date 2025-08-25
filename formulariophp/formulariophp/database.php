<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'php_login_database';
$user = 'root';
$pass = '';

// Opciones de PDO para mejor manejo de errores y seguridad
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en errores
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve arrays asociativos por defecto
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa consultas preparadas nativas (más seguro)
];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, $options);
} catch (PDOException $e) {
    // Nunca muestres errores de conexión directamente en producción
    die('Connection failed: ' . $e->getMessage());
}
?>

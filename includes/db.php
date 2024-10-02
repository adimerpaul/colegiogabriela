<?php
$host = 'localhost';
$db = 'universidad';
$user = 'root';  // Cambia según tu configuración
$pass = '';      // Cambia la contraseña si es necesario

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
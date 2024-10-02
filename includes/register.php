<?php include('../includes/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Registro de Estudiantes</h2>
    <form action="register.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono"><br>

        <label for="carrera">Carrera:</label>
        <input type="text" name="carrera" required><br>

        <input type="submit" name="submit" value="Registrar">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $carrera = $_POST['carrera'];
        $fecha_inscripcion = date('Y-m-d');

        $sql = "INSERT INTO estudiantes (nombre, apellido, email, telefono, carrera, fecha_inscripcion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$nombre, $apellido, $email, $telefono, $carrera, $fecha_inscripcion])) {
            echo "Estudiante registrado correctamente.";
        } else {
            echo "Error al registrar estudiante.";
        }
    }
    ?>
</body>
</html>
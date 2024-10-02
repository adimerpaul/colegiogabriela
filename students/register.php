<?php include('../includes/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes - Universidad Siglo XX</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="../">Universidad Siglo XX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="register.php">Registro de Estudiantes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list.php">Lista de Estudiantes</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container form-container">
        <h2>Formulario de Registro</h2>
        <form action="register.php" method="POST" id="registerForm">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" pattern="[A-Za-z\s]+" required title="Solo se permiten letras">
            </div>
            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" name="apellido" class="form-control" pattern="[A-Za-z\s]+" required title="Solo se permiten letras">
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <!-- Teléfono -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" pattern="[0-9]{7,10}" required title="Solo se permiten números, entre 7 y 10 dígitos">
            </div>
            <!-- Carrera -->
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera:</label>
                <input type="text" name="carrera" class="form-control" required>
            </div>
            <!-- Botón de Enviar -->
            <div class="d-grid">
                <input type="submit" name="submit" value="Registrar" class="btn btn-primary">
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $carrera = $_POST['carrera'];
            $fecha_inscripcion = date('Y-m-d');

            // Verificar si el correo ya existe en la base de datos
            $checkEmailQuery = "SELECT * FROM estudiantes WHERE email = ?";
            $checkEmailStmt = $conn->prepare($checkEmailQuery);
            $checkEmailStmt->execute([$email]);
            if ($checkEmailStmt->rowCount() > 0) {
                echo "<div class='alert alert-danger mt-3'>Error: El correo electrónico ya está registrado.</div>";
            } else {
                // Si el correo no existe, proceder con la inserción
                $sql = "INSERT INTO estudiantes (nombre, apellido, email, telefono, carrera, fecha_inscripcion) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute([$nombre, $apellido, $email, $telefono, $carrera, $fecha_inscripcion])) {
                    echo "<div class='alert alert-success mt-3'>Estudiante registrado correctamente.</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Error al registrar estudiante.</div>";
                }
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include('../includes/db.php'); // Asegúrate de tener una conexión válida a la base de datos

// Verificar si se recibió el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta para obtener los datos del estudiante
    $sql = "SELECT * FROM estudiantes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $estudiante = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el estudiante existe
    if (!$estudiante) {
        echo "<div class='alert alert-danger mt-3'>Error: Estudiante no encontrado.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger mt-3'>Error: No se ha proporcionado un ID válido.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Estudiante</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="container mt-5">
    <h2>Detalles del Estudiante</h2>
    <div class="card">
        <div class="card-header">
            Información del Estudiante
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($estudiante['nombre']); ?></p>
            <p><strong>Apellido:</strong> <?php echo htmlspecialchars($estudiante['apellido']); ?></p>
            <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($estudiante['email']); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($estudiante['telefono']); ?></p>
            <p><strong>Carrera:</strong> <?php echo htmlspecialchars($estudiante['carrera']); ?></p>
            <p><strong>Fecha de Inscripción:</strong> <?php echo htmlspecialchars($estudiante['fecha_inscripcion']); ?></p>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

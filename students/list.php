<?php include('../includes/db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes - Universidad Siglo XX</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Universidad Siglo XX</a>
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

    <div class="container">
        <!-- Formulario de búsqueda -->
        <form method="GET" action="list.php" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="search_name" class="form-label">Buscar por Nombre:</label>
                    <input type="text" name="search_name" id="search_name" class="form-control" placeholder="Nombre del estudiante">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="search_email" class="form-label">Buscar por Correo:</label>
                    <input type="email" name="search_email" id="search_email" class="form-control" placeholder="Correo electrónico">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="search_carrera" class="form-label">Buscar por Carrera:</label>
                    <input type="text" name="search_carrera" id="search_carrera" class="form-control" placeholder="Carrera">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Botón para Imprimir -->
        <button onclick="window.print()" class="btn btn-secondary mb-3">Imprimir Lista</button>

        <!-- Tabla de estudiantes -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Carrera</th>
                    <th>Fecha de Inscripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Búsqueda de estudiantes
                $query = "SELECT * FROM estudiantes WHERE 1";

                // Filtros de búsqueda
                if (isset($_GET['search_name']) && !empty($_GET['search_name'])) {
                    $search_name = $_GET['search_name'];
                    $query .= " AND nombre LIKE '%$search_name%'";
                }
                if (isset($_GET['search_email']) && !empty($_GET['search_email'])) {
                    $search_email = $_GET['search_email'];
                    $query .= " AND email LIKE '%$search_email%'";
                }
                if (isset($_GET['search_carrera']) && !empty($_GET['search_carrera'])) {
                    $search_carrera = $_GET['search_carrera'];
                    $query .= " AND carrera LIKE '%$search_carrera%'";
                }

                $stmt = $conn->query($query);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['carrera']}</td>
                            <td>{$row['fecha_inscripcion']}</td>
                            <td><a href='view.php?id={$row['id']}' class='btn btn-info'>Ver</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
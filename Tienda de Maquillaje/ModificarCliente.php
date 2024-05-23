<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Modificar Cliente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
      background-color: #f8f9fa; /* Color de fondo gris claro */
    }
    .container {
      max-width: 600px; /* Ancho máximo del contenido para dispositivos móviles */
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Modificar Cliente</h1>
    <?php
    // Incluir el archivo de conexión
    include 'conexion.php';

    // Verificar si se ha proporcionado el ID del cliente a modificar
    if (isset($_GET['id'])) {
        $idCliente = $_GET['id'];

        // Obtener los datos del cliente de la base de datos
        $sql = "SELECT * FROM clientes WHERE idCliente = $idCliente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="ModificarClientePHP.php" method="post">
              <input type="hidden" name="idCliente" value="<?php echo $row['idCliente']; ?>">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $row['apellido']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>">
              </div>
              <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccion" rows="3"><?php echo $row['direccion']; ?></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo "<p>No se encontró el cliente.</p>";
        }
    } else {
        echo "<p>No se proporcionó un ID de cliente válido.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Modificar Orden</title>
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
    <h1 class="text-center">Modificar Orden</h1>
    <?php
    // Incluir el archivo de conexión
    include 'conexion.php';

    // Verificar si se ha proporcionado el ID del Orden a modificar
    if (isset($_GET['id'])) {
        $idOrden = $_GET['id'];

        // Obtener los datos del Orden de la base de datos
        $sql = "SELECT * FROM ordenes WHERE idOrden = $idOrden";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="ModificarOrdenPHP.php" method="post">
              <input type="hidden" name="idOrden" value="<?php echo $row['idOrden']; ?>">
              <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="Pendiente" <?php if ($row['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                  <option value="Procesado" <?php if ($row['estado'] == 'Procesado') echo 'selected'; ?>>Procesado</option>
                  <option value="Enviado" <?php if ($row['estado'] == 'Enviado') echo 'selected'; ?>>Enviado</option>
                  <option value="Completado" <?php if ($row['estado'] == 'Completado') echo 'selected'; ?>>Completado</option>
                  <option value="Cancelado" <?php if ($row['estado'] == 'Cancelado') echo 'selected'; ?>>Cancelado</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo "<p>No se encontró la orden.</p>";
        }
    } else {
        echo "<p>No se proporcionó un ID de orden válido.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
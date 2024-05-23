<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Detalles de Orden</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body {
      padding: 20px;
      background-color: #f8f9fa; /* Color de fondo gris claro */
    }
    .detalles-container {
      margin-top: 20px;
    }
    .detalles-card {
      background-color: #ffffff; /* Fondo blanco para la tarjeta de detalles */
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }
    @media (max-width: 576px) { /* Estilos específicos para dispositivos móviles pequeños */
      .detalles-card {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="detalles-container">
      <div class="detalles-card">
        <?php
        // Verificar si se proporcionó un ID de orden en la URL
        if (isset($_GET['id'])) {
          // Obtener el ID de la orden de la URL y asegurarse de que sea un número entero
          $idOrden = intval($_GET['id']);

          // Incluir el archivo de conexión
          include 'conexion.php';

          // Consulta SQL para obtener los detalles de la orden con el ID proporcionado
          $sql = "SELECT do.idDetalle, p.nombre AS producto, do.cantidad, do.precio 
                  FROM detallesorden do 
                  INNER JOIN productos p ON do.idProducto = p.idProducto 
                  WHERE do.idOrden = $idOrden AND do.estatus = 1";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Mostrar los detalles de la orden
            echo "<h2 class='text-center'>Detalles de la Orden #$idOrden</h2>";
            echo "<div class='d-flex justify-content-end mb-3'>";
            echo "<a href='AgregarDetallesOrden.php?idOrden=$idOrden' class='btn btn-primary'>Agregar</a>";
            echo "</div>";
            echo "<div class='table-responsive'>"; // Envolver la tabla en un div responsive
            echo "<table class='table table-striped'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>ID Detalle</th>";
            echo "<th>Producto</th>";
            echo "<th>Cantidad</th>";
            echo "<th>Precio</th>";
            echo "<th>Acciones</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['idDetalle'] . "</td>";
              echo "<td>" . $row['producto'] . "</td>";
              echo "<td>" . $row['cantidad'] . "</td>";
              echo "<td>$" . $row['precio'] . "</td>";
              echo "<td>";
              echo "<a href='ModificarDetallesOrden.php?idDetalle=" . $row['idDetalle'] . "&idOrden=$idOrden' class='btn btn-warning btn-sm'><i class='bi bi-pencil'></i></a> ";
              echo "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmModal' data-id='" . $row['idDetalle'] . "'><i class='bi bi-trash'></i></button>";
              echo "</td>";
              echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>"; // Cerrar el div responsive
          } else {
            echo "<p class='text-center'>No se encontraron detalles para esta orden.</p>";
          }

          // Cerrar la conexión a la base de datos
          $conn->close();
        } else {
          echo "<p class='text-center'>No se proporcionó un ID de orden.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <div class="modal" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que quieres eliminar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a id="deleteProductLink" href="#" class="btn btn-danger">Eliminar</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    var confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var idDetalle = button.getAttribute('data-id');
      var deleteProductLink = document.getElementById('deleteProductLink');
      deleteProductLink.href = 'EliminarDetallesOrdenPHP.php?idDetalle=' + idDetalle + '&idOrden=' + <?php echo $idOrden; ?>;
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


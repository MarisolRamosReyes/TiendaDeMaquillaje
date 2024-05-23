<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Ordenes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <style>
    body {
      padding: 20px;
      background-color: #f8f9fa; /* Color de fondo gris claro */
    }
    .table-container {
      margin-top: 20px;
    }
    .table-custom thead th {
      background-color: #ff69b4; /* Fondo rosa fuerte para encabezados de tabla */
      color: white; /* Texto blanco */
    }
    .table-custom tbody td {
      background-color: #fce4ec; /* Fondo rosa claro para celdas de tabla */
    }
    .barra-tabla {
      background-color: #ff69b4; /* Fondo rosa fuerte para la barra de tabla */
      color: white; /* Texto blanco */
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="barra-tabla">
      <h1 class="text-center">Lista de Ordenes</h1>
      <a href="AgregarOrden.php" class="btn btn-primary">Agregar Orden</a>
    </div>
    <div class="table-container">
      <div class="table-responsive">
        <table class="table table-striped table-custom">
          <thead>
            <tr>
              <th>Cliente</th>
              <th>Fecha</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'conexion.php';

            // Consulta SQL para obtener las órdenes y calcular el total
            $sql = "SELECT o.idOrden, c.nombre AS cliente, o.fecha, SUM(d.cantidad * d.precio) AS total, o.estado 
                    FROM ordenes o 
                    INNER JOIN clientes c ON o.idCliente = c.idCliente 
                    INNER JOIN detallesorden d ON o.idOrden = d.idOrden 
                    WHERE o.estatus = 1 
                    GROUP BY o.idOrden";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // Mostrar los datos en la tabla HTML
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['cliente'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['estado'] . "</td>";
                echo "<td>";
                echo "<a href='detalles_orden.php?id=" . $row['idOrden'] . "' class='btn btn-info btn-sm'><i class='fas fa-eye'></i></a> ";
                echo "<a href='ModificarOrden.php?id=" . $row['idOrden'] . "' class='btn btn-warning btn-sm'><i class='fas fa-pencil-alt'></i></a> ";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='openConfirmModal(" . $row['idOrden'] . ")'><i class='fas fa-trash'></i></button>";
                echo "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='7'>No se encontraron órdenes</td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>  
  </div>

  <!-- Modal de confirmación -->
  <div class="modal" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmar Eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que quieres eliminar esta orden?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a id="deleteOrdenLink" href="#" class="btn btn-danger">Eliminar</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function openConfirmModal(idCliente) {
      var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
      var url = 'EliminarOrdenPHP.php?id=' + idCliente;
      document.getElementById('deleteOrdenLink').setAttribute('href', url);
      confirmModal.show();
    }
  </script>
</body>
</html>

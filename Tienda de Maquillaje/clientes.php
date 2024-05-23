<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Clientes</title>
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
      <h1 class="text-center">Lista de Clientes</h1>
      <a href="AgregarCliente.php" class="btn btn-primary">Agregar Cliente</a>
    </div>
    <div class="table-container">
      <div class="table-responsive">
        <table class="table table-striped table-custom">
          <thead>
            <tr>
              <th>ID Cliente</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'conexion.php';

            // Consulta SQL para obtener los clientes
            $sql = "SELECT idCliente, nombre, apellido, email, telefono, direccion FROM clientes WHERE estatus = 1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // Mostrar los datos en la tabla HTML
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idCliente'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['direccion'] . "</td>";
                echo "<td>";
                echo "<a href='ModificarCliente.php?id=" . $row['idCliente'] . "' class='btn btn-warning btn-sm'><i class='fas fa-pencil-alt'></i></a> ";
                echo "<button type='button' class='btn btn-danger btn-sm' onclick='openConfirmModal(" . $row['idCliente'] . ")'><i class='fas fa-trash'></i></button>";
                echo "</td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='7'>No se encontraron clientes</td></tr>";
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
          ¿Estás seguro de que quieres eliminar este cliente?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a id="deleteClientLink" href="#" class="btn btn-danger">Eliminar</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function openConfirmModal(idCliente) {
      var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
      var url = 'EliminarClientePHP.php?id=' + idCliente;
      document.getElementById('deleteClientLink').setAttribute('href', url);
      confirmModal.show();
    }
  </script>
</body>
</html>
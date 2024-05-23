<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta SQL para obtener la lista de clientes
$sql = "SELECT idCliente, nombre FROM clientes";
$result = $conn->query($sql);

// Crear un arreglo para almacenar los clientes
$clientes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Agregar cada cliente al arreglo
        $clientes[$row['idCliente']] = $row['nombre'];
    }
}

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idCliente = $_POST['idCliente'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];
    
    // Aquí puedes continuar con el procesamiento de los datos y agregar la orden a la base de datos
    // ...
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agregar Orden</title>
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
        <h1 class="text-center">Agregar Orden</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="idCliente" class="form-label">Cliente</label>
                <select class="form-control" id="idCliente" name="idCliente" required>
                    <?php foreach ($clientes as $id => $nombre) : ?>
                        <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" id="total" name="total" step="0.01" min="0" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Procesado">Procesado</option>
                    <option value="Enviado">Enviado</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Orden</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
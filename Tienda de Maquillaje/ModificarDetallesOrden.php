<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó un ID de detalle en la URL
if (isset($_GET['idDetalle'])) {
    // Obtener el ID del detalle de la orden de la URL y asegurarse de que sea un número entero
    $idDetalle = intval($_GET['idDetalle']);

    // Consulta SQL para obtener los datos del detalle de la orden
    $sqlDetalle = "SELECT * FROM detallesorden WHERE idDetalle = ?";
    $stmtDetalle = $conn->prepare($sqlDetalle);
    $stmtDetalle->bind_param("i", $idDetalle);
    $stmtDetalle->execute();
    $resultDetalle = $stmtDetalle->get_result();

    if ($resultDetalle->num_rows > 0) {
        $detalle = $resultDetalle->fetch_assoc();
    } else {
        echo "<p class='text-center'>No se encontró el detalle de la orden.</p>";
        exit();
    }

    $stmtDetalle->close();
} else {
    echo "<p class='text-center'>No se proporcionó un ID de detalle de orden.</p>";
    exit();
}

// Consulta SQL para obtener la lista de productos
$sqlProductos = "SELECT idProducto, nombre FROM productos";
$resultProductos = $conn->query($sqlProductos);

// Crear un arreglo para almacenar los productos
$productos = array();
if ($resultProductos->num_rows > 0) {
    while ($row = $resultProductos->fetch_assoc()) {
        $productos[$row['idProducto']] = $row['nombre'];
    }
}

// Consulta SQL para obtener la lista de órdenes
$sqlOrdenes = "SELECT idOrden FROM ordenes";
$resultOrdenes = $conn->query($sqlOrdenes);

// Crear un arreglo para almacenar los números de órdenes
$ordenes = array();
if ($resultOrdenes->num_rows > 0) {
    while ($row = $resultOrdenes->fetch_assoc()) {
        $ordenes[] = $row['idOrden'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modificar Detalle de Orden</title>
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
        <h1 class="text-center">Modificar Detalle de Orden</h1>
        <form action="ModificarDetallesOrdenPHP.php" method="post">
            <input type="hidden" name="idDetalle" value="<?php echo $detalle['idDetalle']; ?>">
            <div class="mb-3">
                <label for="idOrden" class="form-label">ID de la Orden</label>
                <select class="form-control" id="idOrden" name="idOrden" required>
                    <?php foreach ($ordenes as $idOrden) : ?>
                        <option value="<?php echo $idOrden; ?>" <?php echo $idOrden == $detalle['idOrden'] ? 'selected' : ''; ?>>
                            <?php echo $idOrden; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idProducto" class="form-label">Producto</label>
                <select class="form-control" id="idProducto" name="idProducto" required>
                    <?php foreach ($productos as $id => $nombre) : ?>
                        <option value="<?php echo $id; ?>" <?php echo $id == $detalle['idProducto'] ? 'selected' : ''; ?>>
                            <?php echo $nombre; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $detalle['cantidad']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $detalle['precio']; ?>" step="0.01" min="0" required>
            </div>

            <button type="submit" class="btn btn-primary">Modificar Detalle</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

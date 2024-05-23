<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agregar Detalle de Orden</title>
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
        <h1 class="text-center">Agregar Detalle de Orden</h1>
        <form action="AgregarDetallesOrdenPHP.php" method="post">
            <div class="mb-3">
                <label for="idOrden" class="form-label">ID de la Orden</label>
                <select class="form-control" id="idOrden" name="idOrden" required>
                    <!-- Aquí se llenarán las opciones de órdenes mediante PHP -->
                    <?php
                    // Incluir el archivo de conexión
                    include 'conexion.php';
                    
                    // Consulta SQL para obtener la lista de órdenes
                    $sqlOrdenes = "SELECT idOrden FROM ordenes";
                    $resultOrdenes = $conn->query($sqlOrdenes);
                    
                    if ($resultOrdenes->num_rows > 0) {
                        while ($row = $resultOrdenes->fetch_assoc()) {
                            echo "<option value='{$row['idOrden']}'>{$row['idOrden']}</option>";
                        }
                    }
                    
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idProducto" class="form-label">Producto</label>
                <select class="form-control" id="idProducto" name="idProducto" required>
                    <!-- Aquí se llenarán las opciones de productos mediante PHP -->
                    <?php
                    // Incluir el archivo de conexión
                    include 'conexion.php';
                    
                    // Consulta SQL para obtener la lista de productos
                    $sqlProductos = "SELECT idProducto, nombre FROM productos";
                    $resultProductos = $conn->query($sqlProductos);
                    
                    if ($resultProductos->num_rows > 0) {
                        while ($row = $resultProductos->fetch_assoc()) {
                            echo "<option value='{$row['idProducto']}'>{$row['nombre']}</option>";
                        }
                    }
                    
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Detalle</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

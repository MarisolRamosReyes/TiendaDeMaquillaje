<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó un ID de producto en la URL
if(isset($_GET['id'])) {
    // Obtener el ID del producto de la URL y asegurarse de que sea un número entero
    $idProducto = intval($_GET['id']);

    // Consulta SQL para obtener los detalles del producto con el ID proporcionado
    $sql = "SELECT nombre, descripcion, precio, stock, categoria FROM productos WHERE idProducto = $idProducto";
    $result = $conn->query($sql);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener los datos del producto
        $producto = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Modificar Producto</title>
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
    <h1 class="text-center">Modificar Producto</h1>
    <form action="actualizar_producto.php" method="post">
      <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Producto</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción del Producto</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
      </div>
      <div class="mb-3">
        <label for="precio" class="form-label">Precio del Producto</label>
        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="stock" class="form-label">Cantidad en Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="categoria" class="form-label">Categoría del Producto</label>
        <select class="form-select" id="categoria" name="categoria" required>
          <option value="Maquillaje" <?php if($producto['categoria'] == 'Maquillaje') echo 'selected'; ?>>Maquillaje</option>
          <option value="Cuidado de la Piel" <?php if($producto['categoria'] == 'Cuidado de la Piel') echo 'selected'; ?>>Cuidado de la Piel</option>
          <option value="Accesorios" <?php if($producto['categoria'] == 'Accesorios') echo 'selected'; ?>>Accesorios</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idDetalle = $_POST['idDetalle'];
    $idOrden = $_POST['idOrden'];
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    
    // Consulta SQL para actualizar el detalle de la orden
    $sql = "UPDATE detallesorden SET idOrden = ?, idProducto = ?, cantidad = ?, precio = ? WHERE idDetalle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiidi", $idOrden, $idProducto, $cantidad, $precio, $idDetalle);
    
    if ($stmt->execute()) {
        // Redirigir a la pantalla de detalles de la orden
        header("Location: detalles_orden.php?id=$idOrden");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
    
    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>

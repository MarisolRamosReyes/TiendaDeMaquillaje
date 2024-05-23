<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Procesar el formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idOrden = $_POST['idOrden'];
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    
    // Consulta SQL para insertar el nuevo detalle de la orden
    $sql = "INSERT INTO detallesorden (idOrden, idProducto, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $idOrden, $idProducto, $cantidad, $precio);
    
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
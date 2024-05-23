<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó el ID del producto a eliminar
if(isset($_GET['id'])) {
    // Obtener el ID del producto de la URL
    $idProducto = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para cambiar el estado del producto a inactivo
    $sql = "UPDATE productos SET estatus = 0 WHERE idProducto = $idProducto";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta a la página de productos
        header("Location: productos.php");
        exit();
    } else {
        echo "Error al intentar eliminar el producto: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de producto no proporcionado.";
}
?>
<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idProducto = intval($_POST['idProducto']);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    // Preparar y ejecutar la consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET 
            nombre='$nombre', 
            descripcion='$descripcion', 
            precio=$precio, 
            stock=$stock, 
            categoria='$categoria' 
            WHERE idProducto=$idProducto";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de productos después de la actualización exitosa
        header("Location: productos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
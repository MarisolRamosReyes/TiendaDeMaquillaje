<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];

    // Preparar y ejecutar la consulta SQL para insertar el producto
    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria) 
            VALUES ('$nombre', '$descripcion', $precio, $stock, '$categoria')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de productos después de la inserción exitosa
        header("Location: productos.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
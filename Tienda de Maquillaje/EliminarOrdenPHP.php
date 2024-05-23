<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó el ID del Orden a eliminar
if(isset($_GET['id'])) {
    // Obtener el ID del Orden de la URL
    $idOrden = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para cambiar el estado del Orden a inactivo
    $sql = "UPDATE ordenes SET estatus = 0 WHERE idOrden = $idOrden";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta a la página de Ordens
        header("Location: ordenes.php");
        exit();
    } else {
        echo "Error al intentar eliminar el Orden: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de Orden no proporcionado.";
}
?>
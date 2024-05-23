<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó el ID del Cliente a eliminar
if(isset($_GET['id'])) {
    // Obtener el ID del Cliente de la URL
    $idCliente = $_GET['id'];

    // Preparar y ejecutar la consulta SQL para cambiar el estado del Cliente a inactivo
    $sql = "UPDATE clientes SET estatus = 0 WHERE idCliente = $idCliente";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta a la página de clientes
        header("Location: clientes.php");
        exit();
    } else {
        echo "Error al intentar eliminar el Cliente: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de Cliente no proporcionado.";
}
?>
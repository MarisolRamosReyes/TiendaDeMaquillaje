<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idCliente = $_POST['idCliente'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];
    
    // Obtener la fecha del sistema
    $fecha = date("Y-m-d");

    // Preparar y ejecutar la consulta SQL para insertar la nueva orden
    $sql = "INSERT INTO ordenes (idCliente, fecha, total, estado) VALUES ('$idCliente', '$fecha', '$total', '$estado')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de órdenes después de la inserción exitosa
        header("Location: ordenes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
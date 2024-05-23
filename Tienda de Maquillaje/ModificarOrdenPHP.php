<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idOrden = intval($_POST['idOrden']);
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    // Preparar y ejecutar la consulta SQL para actualizar la orden
    $sql = "UPDATE ordenes SET 
            total='$total', 
            estado='$estado' 
            WHERE idOrden=$idOrden";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de órdenes después de la actualización exitosa
        header("Location: ordenes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
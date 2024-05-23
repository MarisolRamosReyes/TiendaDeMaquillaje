<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idCliente = intval($_POST['idCliente']);
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Preparar y ejecutar la consulta SQL para actualizar el cliente
    $sql = "UPDATE clientes SET 
            nombre='$nombre', 
            apellido='$apellido', 
            email='$email', 
            telefono='$telefono', 
            direccion='$direccion' 
            WHERE idCliente=$idCliente";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de clientes después de la actualización exitosa
        header("Location: clientes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
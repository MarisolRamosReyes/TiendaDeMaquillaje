<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    // Preparar y ejecutar la consulta SQL para insertar el cliente
    $sql = "INSERT INTO clientes (nombre, apellido, email, telefono, direccion) 
            VALUES ('$nombre', '$apellido', '$email', '$telefono', '$direccion')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de clientes después de la inserción exitosa
        header("Location: clientes.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>  
<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se proporcionó un ID de detalle en la URL
if (isset($_GET['idDetalle'])) {
    // Obtener el ID del detalle de la orden de la URL y asegurarse de que sea un número entero
    $idDetalle = intval($_GET['idDetalle']);
    $idOrden = intval($_GET['idOrden']);

    // Consulta SQL para actualizar el estatus del detalle de la orden a 0
    $sql = "UPDATE detallesorden SET estatus = 0 WHERE idDetalle = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idDetalle);

    if ($stmt->execute()) {
        // Redirigir a la pantalla de detalles de la orden
        $stmt->close();
        $conn->close();
        header("Location: detalles_orden.php?id=" . $idOrden);
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
} else {
    echo "<p class='text-center'>No se proporcionó un ID de detalle de orden.</p>";
}
?>

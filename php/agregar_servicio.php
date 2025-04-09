<?php
include '../Database/conexion.php'; // Asegúrate de que la ruta esté correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre_servicio'];
    $descripcion = $_POST['descripcion_servicio'];
    $icono = '<i class="fas fa-cogs"></i>';

    try {
        $stmt = $pdo->prepare("INSERT INTO servicios (nombre, descripcion, icono) VALUES (:nombre, :descripcion, :icono)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':icono', $icono);
        $stmt->execute();

        echo "Servicio agregado correctamente.";
        echo "<br><a href='../Templates/landing_page.php'>Volver al dashboard</a>";
    } catch (PDOException $e) {
        echo "Error al agregar servicio: " . $e->getMessage();
    }
}
?>

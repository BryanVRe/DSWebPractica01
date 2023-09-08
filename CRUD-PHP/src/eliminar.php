<?php
include_once "Conexion.php"; // Asegúrate de incluir el archivo de conexión

if (!isset($_GET["id"])) {
    exit();
}

$id = $_GET["id"];

// Llama al método estático para obtener la conexión PDO
$pdo = Conexion::ConexionBD();

$sentencia = $pdo->prepare("DELETE FROM alumnos WHERE id = ?;");
$resultado = $sentencia->execute([$id]);

if ($resultado === true) {
    header("Location: index.php");
} else {
    echo "Algo salió mal";
}
?>

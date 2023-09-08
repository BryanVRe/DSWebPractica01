<?php
include_once "Conexion.php";

try {
    $pdo = Conexion::ConexionBD(); // Conecta a la base de datos

    // Consulta SQL para seleccionar datos de la tabla "alumnos"
    $sentencia = $pdo->query("SELECT id, nombre, direccion, correo, telefono FROM alumnos");

    // Obtener los datos en forma de objetos
    $alumnos = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error en la conexión o consulta a la base de datos: " . $e->getMessage();
}

?>
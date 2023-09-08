<?php
include_once "Conexion.php"; // Incluye el archivo de conexión

try {
    $pdo = Conexion::ConexionBD(); // Conecta a la base de datos

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Consulta SQL para insertar los datos en la tabla "alumnos" usando sentencias preparadas
    $query = "INSERT INTO alumnos (nombre, direccion, telefono, correo) VALUES (:nombre, :direccion, :telefono, :correo)";
    $statement = $pdo->prepare($query);

    // Asociar los valores del formulario a los parámetros de la consulta
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':direccion', $direccion);
    $statement->bindParam(':telefono', $telefono);
    $statement->bindParam(':correo', $correo);

    // Ejecutar la consulta
    if ($statement->execute()) {
            header("Location: index.php");
    } else {
        echo "Error al insertar datos en la base de datos.";
    }
} catch (PDOException $e) {
    die("Error en la conexión o consulta a la base de datos: " . $e->getMessage());
}
?>



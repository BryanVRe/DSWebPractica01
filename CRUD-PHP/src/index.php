<?php
$host = "172.17.0.2";
$port = "5432";
$dbname = "alumnos";
$user = "postgres"; 
$password = "postgres"; 

$edit_mode = false; // Variable para controlar el modo de edición

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión a la base de datos: " . $e->getMessage());
}

// Verifica si se ha enviado el formulario de alta de alumnos
if (isset($_POST["insert"])) {
    // Obtener los valores del formulario
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    try {
        // Consulta SQL para insertar un nuevo registro en la tabla "alumnos"
        $sentencia = $pdo->prepare("INSERT INTO alumnos (nombre, direccion, telefono, correo) VALUES (?, ?, ?, ?)");
        $resultado = $sentencia->execute([$nombre, $direccion, $telefono, $correo]);

        if ($resultado === true) {
            // Redirigir a la página principal después de insertar
            header("Location: index.php");
            exit(); // Importante: terminar el script después de redirigir
        } else {
            echo "Error al insertar el alumno en la base de datos.";
        }
    } catch (PDOException $e) {
        echo "Error en la consulta a la base de datos: " . $e->getMessage();
    }
}

// Código para obtener la lista de alumnos
try {
    // Consulta SQL para seleccionar datos de la tabla "alumnos"
    $sentencia = $pdo->query("SELECT id, nombre, direccion, correo, telefono FROM alumnos");

    // Obtener los datos en forma de objetos
    $alumnos = $sentencia->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo "Error en la consulta a la base de datos: " . $e->getMessage();
}

// Código para eliminar un alumno
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {

        $sentencia = $pdo->prepare("DELETE FROM alumnos WHERE id = ?;");
        $resultado = $sentencia->execute([$id]);

        if ($resultado === true) {
            header("Location: index.php");
            exit();
        } else {
            echo "Algo salió mal";
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta a la base de datos: " . $e->getMessage();
    }
}


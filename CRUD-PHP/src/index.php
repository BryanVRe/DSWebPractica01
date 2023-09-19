<?php
session_start();

// Configuración de la conexión a la base de datos usando PDO
$host = "172.17.0.2";
$port = "5432";
$dbname = "alumnos";
$user = "postgres";
$password = "postgres";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if (isset($_POST["textcorreo"]) && isset($_POST["texttelefono"])) {
    $correo = $_POST["textcorreo"];
    $telefono = $_POST["texttelefono"];
    
    // Consulta preparada para evitar la inyección SQL
    $query = $conn->prepare("SELECT * FROM alumnos WHERE correo = :correo AND telefono = :telefono");
    $query->bindParam(':correo', $correo);
    $query->bindParam(':telefono', $telefono);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $_SESSION["usuario"] = $correo;
        header("Location: crud.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}

if (isset($_SESSION["usuario"])) {
    header("Location: crud.php");
    exit();
}
?>


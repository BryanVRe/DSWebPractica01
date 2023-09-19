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

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center">
                        <h1 class="display-4">INICIAR SESIÓN</h1>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php">
                            <div class="form-group">
                                <label for="textcorreo">Correo</label>
                                <input type="text" class="form-control" id="textcorreo" name="textcorreo" required>
                            </div>
                            <div class="form-group">
                                <label for="texttelefono">Telefono</label>
                                <input type="password" class="form-control" id="texttelefono" name="texttelefono" required>
                            </div>
                            <div class="text-center">
                                <br>
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

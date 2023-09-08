<?php

#Salir si alguno de los datos no está presente
if (
    !isset($_POST["nombre"]) ||
    !isset($_POST["direccion"]) ||
    !isset($_POST["id"]) ||
    !isset($_POST["telefono"]) ||
    !isset($_POST["correo"])
) {
    exit();
}

#Si todo va bien, se ejecuta esta parte del código...

include_once "Conexion.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];

try {
    $pdo = Conexion::ConexionBD();
    
    $sentencia = $pdo->prepare("UPDATE alumnos SET nombre = ?, direccion = ?, correo = ?, telefono = ? WHERE id = ?;");
    $resultado = $sentencia->execute([$nombre, $direccion, $correo, $telefono, $id]);
    
    if ($resultado === true) {
        header("Location: index.php");
    } else {
        echo "Algo salió mal. Por favor verifica que la tabla exista, así como el ID del usuario";
    }
} catch (PDOException $e) {
    echo "Error en la consulta a la base de datos: " . $e->getMessage();
    exit();
}
<?php
// Datos de conexión a la base de datos PostgreSQL
$host = "localhost"; 
$port = "8000"; 
$dbname = "ejemplo"; // Nombre de la base de datos
$user = "postgres"; // Cambia esto por tu nombre de usuario de PostgreSQL
$password = "postgres"; // Cambia esto por tu contraseña de PostgreSQL

// Conexión a la base de datos
$conexion = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión a la base de datos: " . pg_last_error());
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

// Consulta SQL para insertar los datos en la tabla "alumnos"
$query = "INSERT INTO usuarios (nombre, direccion, telefono, correo) VALUES ('$nombre', '$direccion', '$telefono', '$correo')";

// Ejecutar la consulta
$resultado = pg_query($conexion, $query);

// Verificar si la inserción fue exitosa
if ($resultado) {
    include("regresar.php");
    echo "Los datos se han insertado correctamente en la base de datos.";
   
} else {
    echo "Error al insertar datos en la base de datos: " . pg_last_error();
}

// Cerrar la conexión a la base de datos
pg_close($conexion);
?>

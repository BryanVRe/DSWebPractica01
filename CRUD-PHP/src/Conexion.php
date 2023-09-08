<?php
class Conexion {
    public static function ConexionBD(){
        $host = "172.17.0.2";
        $port = "5432";
        $dbname = "alumnos"; // Nombre de la base de datos
        $user = "postgres"; // Cambia esto por tu nombre de usuario de PostgreSQL
        $password = "postgres"; // Cambia esto por tu contraseña de PostgreSQL

        try {
            $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }
}
?>

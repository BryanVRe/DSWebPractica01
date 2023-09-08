<?php
if (!isset($_GET["id"])) {
    echo "No se proporcionó un ID válido.";
    exit();
}

$id = $_GET["id"];
include_once "Conexion.php";

try {
    $pdo = Conexion::ConexionBD();
    
    $sentencia = $pdo->prepare("SELECT id, nombre, direccion, correo, telefono FROM alumnos WHERE id = ?;");
    $sentencia->execute([$id]);
    
    $alumno = $sentencia->fetchObject();
    
    if (!$alumno) {
        echo "No existe ningún alumno con ese ID.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error en la consulta a la base de datos: " . $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
</head>

<body>
	<div class="container">
		<div class="row justify-content-center p-5">
			<div class="col-sm-6">
				<h1>CONSULTA DE ALUMNO</h1>
				<form action="actualizar.php" method="POST">
					<div class="form-group">
						<label for="nombre">Clave</label>
						<input class="form-control" type="text" name="id" value="<?php echo $alumno->id; ?>" disabled="true">
					</div>
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input value="<?php echo $alumno->nombre; ?>" required name="nombre" type="text" id="nombre"
							placeholder="Nombre de mascota" class="form-control" disabled="true">
					</div>
					<div class="form-group">
						<label for="edad">Direccion</label>
						<input value="<?php echo $alumno->direccion; ?>" required name="direccion" type="text"
							id="direccion" placeholder="Edad de mascota" class="form-control" disabled="true">
					</div>
					<div class="form-group">
						<label for="edad">Correo</label>
						<input value="<?php echo $alumno->correo; ?>" required name="correo" type="text" id="correo"
							placeholder="Edad de mascota" class="form-control" disabled="true">
					</div>
					<div class="form-group">
						<label for="edad">Telefono</label>
						<input value="<?php echo $alumno->telefono; ?>" required name="telefono" type="text"
							id="telefono" placeholder="Edad de mascota" class="form-control" disabled="true">
					</div>
					<br>
					<a href="./index.php" class="btn btn-warning">Volver</a>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
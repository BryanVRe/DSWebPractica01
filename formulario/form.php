
<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="estilo-alumno.css">
    </head>
    	<body  background="black"> 
        <h1>Alta Alumnos</h1>
        <div class="center-div">
			<form action="alta.php" method="POST">
            <label>Nombre del alumno</label><br>
            <input type="text" name="nombre" class="field" placeholder="Ingrese el nombre del alumno" required><br>
            <label>Dirección</label><br>
            <input type="text" name="direccion" class="field" placeholder="Ingrese direccion del alumno" required><br>
            <label>Telefono</label><br>
            <input type="text" name="telefono" class="field" step="any" placeholder="Ingrese numero de telefono" required><br>
            <label>Correo electronico</label><br>
            <input type="text" name="correo" class="field" placeholder="Ingrese correo electronico" required><br><br>
            <input type="submit" class="btn btn-green" name="insert"  value="Guardar"/>     
			</form>
</div>
<img src="logo.png" alt="uv" class="side-image">

   	</body>
</html>

<?php
include_once "findAll.php"; // Incluye el archivo que obtiene los datos
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
                <h1>Alta Alumnos</h1>
                <form action="alta.php" method="POST">
                    <label>Nombre del alumno</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del alumno"
                        required>
                    <label>Direccion</label>
                    <input type="text" name="direccion" class="form-control" placeholder="Ingrese direccion del alumno"
                        required>
                    <label>Telefono</label>
                    <input type="text" name="telefono" class="form-control" step="any"
                        placeholder="Ingrese numero de telefono" required>
                    <label>Correo electronico</label>
                    <input type="text" name="correo" class="form-control" placeholder="Ingrese correo electronico"
                        required><br>
                    <input type="submit" class="btn btn-primary" name="insert" value="Guardar" />
                </form>
                <br>
                <hr />
                <table class="table">
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Dirreccion</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td>
                                <a href="<?php echo "consultar.php?id=" . $alumno->id?>"><?php echo $alumno->id; ?></a>
                            </td>
                            <td>
                                <?php echo $alumno->nombre; ?>
                            </td>
                            <td>
                                <?php echo $alumno->direccion; ?>
                            </td>
                            <td>
                                <?php echo $alumno->correo; ?>
                            </td>
                            <td>
                                <?php echo $alumno->telefono; ?>
                            </td>
                            <td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $alumno->id?>">📝</a></td>
							<td><a class="btn btn-danger" href="<?php echo "eliminar.php?id=" . $alumno->id?>">🗑️</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
require '../conf/_con.php';

    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        $existencia = $_POST["existencia"];
        $precio = $_POST["precio"];
        $fecha = $_POST["fecharegistro"];
    
        if (isset($_POST['code_editar'])) {
           
            $code_editar = $_POST['code_editar'];
    
        } else {
            
            // Agregar código para insertar un nuevo producto en la base de datos
            try {
                $query = "INSERT INTO medicamentos (nombre, existencia, fecharegistro, imagen, precio) VALUES (:nombre, :existencia, :fecharegistro, :imagen, :precio)";
                $ejecutar = $pdo->prepare($query);
                $ejecutar->bindParam(":nombre", $nombre);
                $ejecutar->bindParam(":existencia", $existencia);
                $ejecutar->bindParam(":fecharegistro", $fecha);
                $ejecutar->bindParam(":imagen", $nombreImagen); // Debes definir $nombreImagen si se sube una imagen
                $ejecutar->bindParam(":precio", $precio);
                $ejecutar->execute();
    
                header("Location: ../index.php/");
                exit;
            } catch (PDOException $e) {
                echo 'Error de conexión: ' . $e->getMessage();
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Actualizar Medicamentos</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Medicamentos</h2>
        <br>
        <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_editar" value="<?php echo $id_editar; ?>">
            <div class="form-group">
                <label for="nombre">Nombre Medicamento:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="existencia">Existencia:</label>
                <input type="number" class="form-control" id="existencia" name="existencia" required>
            </div>
            <div class="form-group">
                <label for="fecharegistro">Fecha de Registro:</label>
                <input type="date" class="form-control" id="fecharegistro" name="fecharegistro" required>
            </div>
            <div class="form-group">
                <label for="imagen">Imagen:</label>
                <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Guardar" id="guardar">
            <a type="button" class="btn btn-danger" href="./../index.php">Salir</a>
            <p id="result"></p>
        </form> 
    </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let button = document.getElementById("guardar");
        button.addEventListener("click", function() {
            document.getElementById("result").innerHTML = "¡Medicamento actualizado con éxito!";
        });
    </script>
</body>
</html>
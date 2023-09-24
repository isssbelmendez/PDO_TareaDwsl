<?php
require '../conf/_con.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        // Obtén el nombre de la imagen antes de eliminar el registro
        $queryImagen = "SELECT imagen FROM medicamentos WHERE id = :id";
        $stmtImagen = $pdo->prepare($queryImagen);
        $stmtImagen->bindParam(":id", $id);
        $stmtImagen->execute();
        $nombreImagen = $stmtImagen->fetchColumn();

        // Elimina el registro de la base de datos
        $query = "DELETE FROM medicamentos WHERE id = :id";
        $ejecutar = $pdo->prepare($query);
        $ejecutar->bindParam(":id", $id);
        $ejecutar->execute();

        // Elimina la imagen del servidor
        if (!empty($nombreImagen)) {
            $ruta_imagen = "../imgServer/" . $nombreImagen;
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen);
            }
        }

        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Encabezado de la página -->
</head>

<body>
    <div class="container mt-5">
        <h2>Eliminar</h2>
        <br>
        <form action="actualizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <!-- Resto de tu formulario para editar medicamentos aquí -->
        </form>

        <!-- Botón para eliminar medicamento -->
        <form action="eliminar.php?id=<?php echo $id; ?>" method="POST">
        <input type="submit" class="btn btn-danger" value="Eliminar Medicamento" id="eliminar">
        <a class="btn btn-primary" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
         <a class="btn btn-danger" href="eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
            
        </form>
        
        <p id="result"></p>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Obtén una referencia al botón por su ID
        let button = document.getElementById("guardar");
        // Agrega un evento de clic al botón
        button.addEventListener("click", function() {
            document.getElementById("result").innerHTML = "¡Medicamento actualizado con éxito!";
        });

        // Obtén una referencia al botón de eliminación por su ID
        let deleteButton = document.getElementById("eliminar");
        // Agrega un evento de clic al botón de eliminación
        deleteButton.addEventListener("click", function() {
            if (confirm("¿Estás seguro de que deseas eliminar este medicamento?")) {
                document.getElementById("result").innerHTML = "¡Medicamento eliminado con éxito!";
            }
        });
    </script>
</body>

</html>

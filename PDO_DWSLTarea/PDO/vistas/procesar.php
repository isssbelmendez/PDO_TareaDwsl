<?php

require '../conf/_con.php';

$query = "SELECT * from medicamentos";
$smt = $pdo->prepare($query);
$smt->execute();
$data = $smt->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Lista de Medicamentos</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <a href="agregar.php" class=" btn btn-success text-center">Agregar &nbsp;</a>

            <a type="submit" class="btn btn-danger" href="./../index.php">Salir</a>

        </div>
    </nav>

    <div class="row p-4">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <center>
                    <h3 class="text-white">Lista de Medicamentos</h3>
                    </center>
                
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-stripped">
                        <thead class="thead-dark">
                            <th>Nombre: </th>
                            <th>Existencia: </th>
                            <th>Fecha de registro: </th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $medicamento) {
                            ?>
                                <tr>
                                    <td><?= $medicamento->nombre ?></td>
                                    <td><?= $medicamento->existencia ?></td>
                                    <td><?= $medicamento->fecharegistro ?></td>
                                    <th><img src="../imgServer/<?= $medicamento->imagen ?>" class="img-fluid img-thumbnail" width="50px" height="50px"></th>
                                    <td><?= $medicamento->precio ?></td>
                                    <!---<td><i class="fas fa-trash"></i><i class="fas fa-pencil"></i></td>
                            -->
                            <td>
                        <a href="editar.php" class="btn btn-warning btn-sm">Editar</a>
                        <button href="eliminar.php?id=1" class="btn btn-danger btn-sm">Eliminar</button>

                        </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>
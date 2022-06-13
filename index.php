<?php

require __DIR__ . "/app/configs/form-settings.php";
require __DIR__ . "/app/configs/connectionClass.php";
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Upload System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Basic Upload System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-s" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="#"><b class="text-end">By: Sílvio Silva</b></a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <form action="./app/process.php" method="<?= $form->method; ?>" class="py-5" enctype="multipart/form-data" novalidate>
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input type="file" class="form-control" name="file" id="file" aria-describedby="fileHelpId">
                <br>
                <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="Photo Description"></textarea>
                <hr>
                <input type="submit" value="Send File" class="form-control btn btn-primary" name="submit_btn">
            </div>
        </form>


        <div class="alerts-div alert-danger text-center pd-2">
            <?php
            if (isset($_SESSION['error404'])) {
                echo "{$_SESSION['error404']}";
                unset($_SESSION['error404']);
            }
            ?>
        </div>

        <div class="alerts-div alert-success text-center pd-2">
            <?php
            if (isset($_SESSION['success'])) {
                echo "{$_SESSION['success']}";
                unset($_SESSION['success']);
            }
            ?>
        </div>
    </div>

    <div class="container row justify-content-ce">
        <p class="display-5 text-center">Gallery</p>


        <?php
        if (isset($_SESSION['fileName']) && isset($_SESSION['description'])) {
            $file = $_SESSION['fileName'];
            $description = $_SESSION['description'];
        } else {

            $file = "";
            $description = "";
        }
        $conn = new ConnectionClass($file, $description);
        $result = $conn->getAll();
        $count = $conn->getAll()->num_rows;

        if ($count != 0) {


            while ($row = $result->fetch_assoc()) {
                echo "
            <div class='content'>
            <div class='card' style='width: 18rem; margin-left: 20px'>
            <img src='app/uploads/{$row['your_colum_photo_name']}' class='card-img-top' alt='...'>
            <div class='card-body'>
            <p class='card-text'>{$row['your_colum_description_photo']}</p>
            </div>
            </div>
            </div>
            ";
            }
        } else {
            echo "<p class='display-5 text-center py-4 alert-warning d-flex flex-row justify-content-center'>No photos yet</p>";
        }
        ?>

    </div>
    </div>


</body>

</html>
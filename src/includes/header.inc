<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./assets/style.css">
    <title>Цветарница Златните Божури</title>
</head>
<body>
    <!-- Image and text -->
    <div class="container-fluid">
    <nav class="navbar navbar-light navbar-expand-lg nav">
        <a class="navbar-brand" href="/">
            Цветарница Златните Божури
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="/">Начало <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="bouquets.php">Букети</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="art-bouquets.php"> Арт букети</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="room-plants.php">Стайни растения</a>
            </li>
            <?php
                if(!empty($_SESSION)):
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Поръчки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Изход</a>
                </li>
            <?php
                endif;
            ?>
            </ul>
        </div>
    </nav></div>
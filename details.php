<?php
require "./Database.php";

$slug = $_GET["slug"];
$db = new Database();
$book = $db->getBySlug($slug);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php require "./navbar.php" ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Title : <?= $book["title"]; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Writer : <?= $book["writer"]; ?></h6>
                        <p class="card-text">Year : <?= $book["year"]; ?></p>
                        <p class="card-text">Publisher : <?= $book["publisher"]; ?></p>
                        <p class="card-text">Price : <?= $book["price"]; ?>$</p>
                        <a href="http://localhost/php-books-crud/" class="card-link text-decoration-none">&laquo; Back to books list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>

</html>
<?php
require "./Database.php";

$db = new Database();
$books = $db->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php require "./navbar.php" ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <a href="add.php" class="btn btn-primary">Add Book Data</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Writer</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $num = 1 ?>
                        <?php foreach ($books as $book) :  ?>
                            <tr>
                                <th scope="row"><?= $num++; ?></th>
                                <td><?= $book["title"]; ?></td>
                                <td><?= $book["writer"]; ?></td>
                                <td>
                                    <a href="details.php?slug=<?= $book["slug"]; ?>" class="btn btn-primary badge text-decoration-none">Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>

</html>
<?php
session_start();
require "./Database.php";

$db = new Database();
$book = $db->getBySlug($_GET["slug"]);

if (isset($_POST["edit"])) {
    if ($db->edit($_POST) > 0) {
        $_SESSION["message"] = "Data successfuly edited!";
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <?php require "./navbar.php" ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>Add Book Data</h1>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $book["id"]; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $book["title"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="writer" class="form-label">Writer</label>
                        <input type="text" class="form-control" id="writer" name="writer" value="<?= $book["writer"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="<?= $book["year"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="<?= $book["publisher"]; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= $book["price"]; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Edit Data</button>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>

</html>
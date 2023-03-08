<?php
session_start();
require "./Database.php";

$db = new Database();
if ($db->delete($_GET["slug"]) > 0) {
    $_SESSION["message"] = "Data successfuly deleted!";
    header("Location: index.php");
}

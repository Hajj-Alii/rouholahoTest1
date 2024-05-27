<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/UserController.php";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = (int)$_POST["password"];


    if (UserController::canLogin($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        header("location: ErrorPageUser.php");
        exit();
    }
}
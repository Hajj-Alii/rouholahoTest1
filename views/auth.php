<?php
session_start();

// Include database connection

// Dummy username and password (Replace these with your real credentials)
$valid_username = "user";
$valid_password = "password";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username and password are correct
    if ($username == $valid_username && $password == $valid_password) {
        // Authentication successful, set session variables
        $_SESSION["username"] = $username;

        // Redirect to a protected page
        header("Location: form.php");
        exit;
    } else {
        // Authentication failed, redirect back to login page with error message
        $_SESSION["error"] = "Invalid username or password.";
        header("Location: login.php");
        exit;
    }
}
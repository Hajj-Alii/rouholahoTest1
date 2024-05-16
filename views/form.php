<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/indexStyle.css">
    <title>Title</title>
</head>
<body>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/SignalController.php';
$ctrl = new SignalController();
?>
<div>

    <h2>Submit Form</h2>
    <form action="../controllers/auth.php" method="get">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" >

        <label for="address">Address:</label>
        <input type="number" id="address" name="address" >

        <input type="submit" value="Submit">
    </form>

</div>
</body>
</html>
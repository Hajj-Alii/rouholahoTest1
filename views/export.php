<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--<h2>Call Method Example</h2>-->
<form method="post" action="exportHandle.php">
    <button type="submit" name="call_method">Call Method</button>
</form>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/Controller.php';
$ctrl = new Controller();
if(isset($_POST['call_method'])) {
    $ctrl::exportAsExcel();
}

?>
</body>
</html>
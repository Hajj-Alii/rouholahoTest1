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
<form method="post" action="exportHandle.php">
    <button type="submit" name="Export">Export</button>
</form>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/SignalController.php';
$ctrl = new SignalController();
if(isset($_POST['Export'])) {
    $ctrl::exportAsExcel();
}

?>
</body>
</html>
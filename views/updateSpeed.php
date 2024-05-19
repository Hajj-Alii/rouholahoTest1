<?php
require $_SERVER["DOCUMENT_ROOT"]."/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();

echo json_encode($records);
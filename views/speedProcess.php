<?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$currentDateTime = new DateTime();
$date = $currentDateTime->format('Y-m-d h-m-s');
var_dump($date);

//var_dump((int)$_GET["spd"]);
$ctrl::addSpeed((int)$_GET["spd"],  $currentDateTime);
//$ctrl::readAll();
<?php
include $_SERVER['DOCUMENT_ROOT'].'/www/rouholahoTest1/controllers/SignalController.php';;
//include "controllers/SignalController.php";
$ctrl = new SignalController();

//$ctrl::addSignal($_GET["name"], $_GET["address"]);

$ctrl::readAll();


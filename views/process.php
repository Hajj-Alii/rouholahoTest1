<?php
include $_SERVER['DOCUMENT_ROOT'].'/www/rouholahoTest1/controllers/Controller.php';;
//include "controllers/Controller.php";
$ctrl = new Controller();

//$ctrl::addSignal($_GET["name"], $_GET["address"]);

$ctrl::readAll();


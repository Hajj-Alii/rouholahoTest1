<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/SpeedController.php';
$ctrl = new SpeedController();
if(isset($_POST['Export']))
    $ctrl::exportAsExcel();






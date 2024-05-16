<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/SignalController.php';
$ctrl = new SignalController();
if(isset($_POST['Export']))
    $ctrl::exportAsExcel();
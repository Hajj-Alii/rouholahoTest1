<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/www/rouholahoTest1/controllers/Controller.php';
$ctrl = new Controller();
if(isset($_POST['Export']))
    $ctrl::exportAsExcel();
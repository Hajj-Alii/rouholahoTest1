<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$newRecords = [];
$records = SpeedController::readAll();
foreach ($records as $record) {
    $newRecords[$record['value']] = $record['time'];
}
var_dump($newRecords);
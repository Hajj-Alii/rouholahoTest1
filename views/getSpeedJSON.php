<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
$formattedRecords = array_map(function ($value, $time) {
    return [
        'speed' => $value,
        'time' => $time->format('Y-m-d h:i:s')
    ];
}, array_keys($records), $records);

$encodedRecords = json_encode($formattedRecords);
header('Content-Type: application/json');
echo $encodedRecords;

?>
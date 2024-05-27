<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$newRecords = [];
$records = $ctrl::readAll();

foreach ($records as $record) {
    $value = $record['status'] === 'silent' ? 0 : $record['value'];
    $newRecords[$record['time']] = $value;
}

$formattedRecords = array_map(function($time, $value) {
    return [

        'speed' => $value,
        'time' => $time,
    ];
}, array_keys($newRecords), $newRecords);

$encodedRecords = json_encode($formattedRecords);
header('Content-Type: application/json');
echo $encodedRecords;
?>


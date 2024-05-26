<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$newRecords = [];
$records = $ctrl::readAll();
foreach ($records as $record) {
    $newRecords[$record['value']] = $record['time'];
}
$formattedRecords = array_map(function($value, $time) {
    return [
        'speed' => $value,
        'time' => $time
    ];
}, array_keys($newRecords), $newRecords);

$encodedRecords = json_encode($formattedRecords);
header('Content-Type: application/json');
echo $encodedRecords
?>


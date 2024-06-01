<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

$ctrl = new SpeedController();
$records = $ctrl::fetchRecords_jalaliToGregorian($startDate, $endDate);
$formattedRecords = [];

foreach ($records as $record) {
    $formattedRecord = [
        'value' => $record['value'],
        'time' => $record['time'],
        'shift' => $record['shift']
    ];

    $formattedRecords[] = $formattedRecord;
}

$encodedRecords = json_encode($formattedRecords);

header('Content-Type: application/json');

echo $encodedRecords;
?>

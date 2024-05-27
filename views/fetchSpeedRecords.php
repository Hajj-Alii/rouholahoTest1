<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

$ctrl = new SpeedController();
$records = $ctrl::fetchRecords_jalaliToGregorian($startDate, $endDate);

$formattedRecords = [];

foreach ($records as $record) {
    // Determine the value based on the status
    $value = ($record['status'] == 'silent') ? 0 : $record['value'];

    // Construct the new associative array with 'value' and 'time' fields
    $formattedRecord = [
        'value' => $value,
        'time' => $record['time']
    ];

    // Add the formatted record to the new array
    $formattedRecords[] = $formattedRecord;
}

// Encode the formatted records as JSON
$encodedRecords = json_encode($formattedRecords);

// Set the content type header to JSON
header('Content-Type: application/json');

// Output the JSON response
echo $encodedRecords;
?>

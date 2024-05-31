<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";


//$ctrl = new SpeedController();
//$records = $ctrl::fetchRecords_jalaliToGregorian("۱۴۰۳/۰۳/۰۲ ۱۳:۲۴:۴۸", "۱۴۰۳/۰۳/۰۲ ۱۶:۲۴:۴۸");
//var_dump(SpeedModel::getRawRecords(new DateTime("2024-05-22 14:12:14"), new DateTime("2024-05-24 09:26:27")));
//$formattedRecords = [];
//
//foreach ($records as $record) {
//    // Determine the value based on the status
//    $value = ($record['status'] == 'silent') ? 0 : $record['value'];
//
//    // Construct the new associative array with 'value' and 'time' fields
//    $formattedRecord = [
//        'value' => $value,
//        'time' => $record['time'],
//        'shift' => $record['shift']
//    ];
//
//    // Add the formatted record to the new array
//    $formattedRecords[] = $formattedRecord;
//}
//
//// Encode the formatted records as JSON
//$encodedRecords = json_encode($formattedRecords);

// Set the content type header to JSON
//header('Content-Type: application/json');

// Output the JSON response
//var_dump($records);



//var_dump(SpeedController::readAll());

var_dump(SpeedModel::getRecords(new DateTime("2024-05-31 19:22:51", new DateTimeZone("Asia/Tehran")), new DateTime("2024-05-31 19:25:51", new DateTimeZone("Asia/Tehran"))));

?>

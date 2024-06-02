<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";



$startDate = '۱۴۰۳/۰۳/۱۱ ۲۲:۲۶:۲۴';
$endDate = '۱۴۰۳/۰۳/۱۱ ۲۲:۳۹:۲۴';
$shift = 'C';

header('Content-Type: application/json');

if ($startDate && $endDate && $shift) {
    try {
        // Call the getShiftRecords function
        $shiftActivity = SpeedController::getShiftRecords($startDate, $endDate, $shift);

        // Call the getShiftParams function
        $shiftTotalTonnage = ParamsController::getShiftParams($startDate, $endDate, $shift);

        // Combine the results
        $result = [
            'shiftActive' => $shiftActivity['active'],
            'shiftSilent' => $shiftActivity['silent'],
            'shiftParams' => $shiftTotalTonnage,
        ];

        // Return the result as JSON
        echo json_encode($result);
    } catch (Exception $e) {
        // Return an error message as JSON
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    // Return an error message as JSON
    echo json_encode(['error' => 'Missing parameters']);
}
// Return the result as JSON
//        echo json_encode($result);
// Return an error message as JSON
//        echo json_encode(['error' => $e->getMessage()]);
// Return an error message as JSON
//    echo json_encode(['error' => 'Missing parameters']);


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
//var_dump(SpeedModel::getRawRecords(new DateTime("2024-05-31 22:25:24"), new DateTime("2024-05-31 22:33:24", new DateTimeZone("Asia/Tehran"))));
//var_dump(SpeedModel::getRawRecords(new DateTime("2024-06-01 17:29:53", new DateTimeZone("Asia/Tehran")), new DateTime("2024-06-01 17:42:53", new DateTimeZone("Asia/Tehran"))));
//var_dump(SpeedModel::getRecords2(new DateTime("2024-06-01 17:45:53", new DateTimeZone("Asia/Tehran")), new DateTime("2024-06-01 17:55:53", new DateTimeZone("Asia/Tehran"))));


//var_dump(SpeedModel::getRecords2(new DateTime("2024-06-01 17:29:53"), new DateTime("2024-06-01 17:39:53")));
//$records = SpeedModel::getRecords2(new DateTime("2024-06-01 17:29:53"), new DateTime("2024-06-01 17:39:53"));
//$records2 = SpeedController::fetchRecords_jalaliToGregorian("۱۴۰۳/۰۳/۱۲ ۱۷:۲۹:۴۷", "۱۴۰۳/۰۳/۱۲ ۱۷:۴۰:۴۷");
//echo SpeedController::jalaliToGregorian_DateTime(SpeedModel::gregorianToJalali_str("2024-06-01 17:29:47"));
//var_dump(SpeedModel::getRecords2(SpeedController::jalaliToGregorian_DateTime("۱۴۰۳/۰۳/۱۲ ۱۷:۲۹:۴۷"), SpeedController::jalaliToGregorian_DateTime("۱۴۰۳/۰۳/۱۲ ۱۷:۳۹:۴۷")));
//
//var_dump(SpeedModel::getRecords2(new DateTime("2024-06-01 17:29:47"), new DateTime("2024-06-01 17:40:52")));
//var_dump($records2);
//echo "<br/>". SpeedModel::gregorianToJalali_str("2024-06-01 17:29:47");
//$formattedRecords = array();
//foreach ($records as $record)
//    $formattedRecords[] = $record;
//var_dump($records);
//var_dump($records2);

//var_dump(SpeedModel::getShiftRecords(new DateTime("2024-05-30 19:57:38"), new DateTime("2024-05-30 20:01:38"), "C"));
//var_dump(SpeedController::getShiftRecords("۱۴۰۳/۰۳/۱۰ ۱۹:۵۷:۰۲", "۱۴۰۳/۰۳/۱۰ ۲۱:۰۲:۰۳", "C"));


?>

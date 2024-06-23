<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

//header('Content-Type: application/json');
//
//
//
//try {
//    $result = ParamsController::fetchParams2("۱۴۰۳/۰۳/۱۲ ۱۳:۰۱:۳۷", "۱۴۰۳/۰۳/۲۸ ۱۳:۰۱:۳۷");
//
//    if (empty($result['params'])) {
//        echo json_encode(['params' => [], 'hasSpeedRecords' => $result['hasSpeedRecords']]);
//    } else {
//        echo json_encode($result);
//    }
//} catch (Exception $e) {
//    echo json_encode(['error' => $e->getMessage()]);
//}

//var_dump(SpeedModel::getRawRecords(new DateTime("2024-6-01 09:00:00"), new DateTime("2024-6-22 16:00:00")));
$startDate = "۱۴۰۳/۰۳/۰۱ ۱۳:۳۳:۳۴";
$endDate = "۱۴۰۳/۰۴/۰۳ ۱۴:۳۲:۰۴";
$shift = "A";
$records = SpeedModel::getRecords2(new DateTime("2024-6-21 09:00:00"), new DateTime("2024-6-22 09:00:00"), "all");

$ctrl = new SpeedController();
$records2 = $ctrl::fetchRecords_jalaliToGregorian($startDate, $endDate, $shift);

$formattedRecords = [];

//foreach ($records2 as $record) {
//    $formattedRecord = [
//        'value' => $record['value'],
//        'time' => $record['time'],
//        'shift' => $record['shift']
//    ];
//
//    $formattedRecords[] = $formattedRecord;
//}

//$encodedRecords = json_encode($formattedRecords);

// Log the number of records fetched
echo ("Number of records fetched: " . count($records2));

// Output the encoded JSON (commented out for debugging)
// echo $encodedRecords;
var_dump($records2); // Dump for debugging purposes


?>


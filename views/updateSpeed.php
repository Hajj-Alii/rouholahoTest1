<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

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
$records = SpeedModel::getRecords2(new DateTime("2024-6-22 09:00:00"), new DateTime("2024-6-23 09:00:00"), "all");
$sum= 0;
foreach ($records as $record) {
    var_dump($record);
    $sum ++;
}
echo $sum;

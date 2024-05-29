<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

//header('Content-Type: application/json');
//
//$startDate = $_GET['startDate'];
//$endDate = $_GET['endDate'];
////
//try {
//    $records = ParamsController::fetchParams( $startDate,$endDate);
//    echo json_encode($records);
//} catch (Exception $e) {
//    echo json_encode(['error' => $e->getMessage()]);
//}
var_dump(ParamsModel::insertParams(new DateTime("2024-05-29 09:35:08", new DateTimeZone("Asia/Tehran")),
new DateTime("now", new DateTimeZone("Asia/Tehran")), 55, 555));
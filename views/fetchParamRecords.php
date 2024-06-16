<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

header('Content-Type: application/json');

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

try {
    $result = ParamsController::fetchParams2($startDate, $endDate);

    if (empty($result['params'])) {
        echo json_encode(['params' => [], 'hasSpeedRecords' => $result['hasSpeedRecords']]);
    } else {
        echo json_encode($result);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


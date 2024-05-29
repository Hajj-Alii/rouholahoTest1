<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

header('Content-Type: application/json');

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

try {
    $records = ParamsController::fetchParams($startDate, $endDate);
    echo json_encode($records);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


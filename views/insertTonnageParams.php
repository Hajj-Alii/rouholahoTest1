<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

// Log the received JSON data
$requestPayload = file_get_contents('php://input');
file_put_contents('request_log.txt', $requestPayload . PHP_EOL, FILE_APPEND);

header('Content-Type: application/json');

try {
    $data = json_decode($requestPayload, true);

    if (!$data) {
        throw new Exception('Invalid input data.');
    }

    $startDate = $data['startDate'];
    $endDate = $data['endDate'];
    $width = (int)$data['width'];
    $grammage = (int)$data['grammage'];

    ParamsController::insertParams($startDate, $endDate, $width, $grammage);

    echo json_encode(['message' => 'Data inserted successfully']);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

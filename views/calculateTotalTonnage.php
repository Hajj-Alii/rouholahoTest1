<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

// Get raw POST data and decode JSON
$postData = file_get_contents("php://input");
$data = json_decode($postData);

// Check if JSON decoding was successful
if ($data === null) {
    // JSON decoding failed
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Extract start and end date/time from decoded JSON
$startDate = $data->startDate;
$endDate = $data->endDate;

// Calculate total tonnage
$totalTonnage = ParamsController::calculate_totalTonnage($startDate, $endDate);

// Return result as JSON
echo json_encode(['totalTonnage' => $totalTonnage]);

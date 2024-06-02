<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

header('Content-Type: application/json');

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

try {
    $records = ParamsController::fetchParams($startDate, $endDate);

    // Check if records are empty
//    if (empty($records)) {
        // Return a custom message or an empty array
//        echo json_encode(['error' => 'No records found']); // Custom message
        // Alternatively, you can return an empty array
        // echo json_encode([]); // Empty array
//    } else {
        // Encode and return records as JSON
        echo json_encode($records);
//    }
} catch (Exception $e) {
    // Handle any exceptions and return an error message
    echo json_encode(['error' => $e->getMessage()]);
}

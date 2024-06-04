<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

header('Content-Type: application/json');

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

try {
    $records = ParamsController::fetchParams($startDate, $endDate);

    if (empty($records)) {
//        echo json_encode(['error' => 'No records found']); // Custom message
         echo json_encode([]); // Empty array
    } else {
        echo json_encode($records);
    }
} catch (Exception $e) {
    // Handle any exceptions and return an error message
    echo json_encode(['error' => $e->getMessage()]);
}

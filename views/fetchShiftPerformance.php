<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";


$startDate = $_GET['startDate'] ?? null;
$endDate =  $_GET['endDate'] ?? null;
$shift = $_GET['shift'] ?? null;

header('Content-Type: application/json');

if ($startDate && $endDate && $shift) {
    try {
        // Convert Jalali to Gregorian
        $startDateGregorian = SpeedController::jalaliToGregorian_DateTime($startDate);
        $endDateGregorian = SpeedController::jalaliToGregorian_DateTime($endDate);


        // Call the getShiftRecords function
        $shiftTotalTonnage= ParamsController::getShiftParams($startDate, $endDate, $shift);

        // Call the getShiftParams function
        $shiftActivity  = SpeedController::getShiftRecords($startDate, $endDate, $shift);

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
?>

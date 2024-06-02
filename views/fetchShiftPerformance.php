<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";


$startDate = str_replace('%', ' ',$_GET['startDate']) ?? null;
$endDate =  str_replace('%', ' ',$_GET['endDate']) ?? null;
$shift = $_GET['shift'] ?? null;

header('Content-Type: application/json');


// Debug input values
error_log("Start Date: " . $startDate);
error_log("End Date: " . $endDate);
error_log("Shift: " . $shift);

if ($startDate && $endDate && $shift) {
    try {
        // Convert Jalali to Gregorian
        $startDateGregorian = SpeedController::jalaliToGregorian_DateTime($startDate);
        $endDateGregorian = SpeedController::jalaliToGregorian_DateTime($endDate);

        // Debug converted dates
        error_log("Start Date (Gregorian): " . $startDateGregorian);
        error_log("End Date (Gregorian): " . $endDateGregorian);

        // Call the getShiftRecords function
        $shiftActivity = ParamsController::getShiftParams($startDateGregorian, $endDateGregorian, $shift);

        // Call the getShiftParams function
        $shiftTotalTonnage = SpeedController::getShiftRecords($startDateGregorian, $endDateGregorian, $shift);

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

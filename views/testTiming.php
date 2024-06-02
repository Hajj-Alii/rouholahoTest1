<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

//ParamsController::insertParams("۱۴۰۳/۰۳/۱۳ ۱۳:۲۹:۱۸", "۱۴۰۳/۰۳/۱۳ ۱۳:۳۹:۲۷", 11, 12);



//$startDate = '۱۴۰۳/۰۳/۱۱ ۲۲:۲۶:۲۴';
//$endDate = '۱۴۰۳/۰۳/۱۱ ۲۲:۳۹:۲۴';
//$shift = 'C';

//header('Content-Type: application/json');

//if ($startDate && $endDate && $shift) {

        $records = ParamsModel::selectParams_gregorian(new DateTime("2024-06-02 13:29:38"), new DateTime("2024-06-02 13:32:38"));
        var_dump($records);
        echo ParamsController::shiftExists($records, 'C');
        var_dump(ParamsController::getShiftParams("۱۴۰۳/۰۳/۱۳ ۱۳:۲۹:۴۶", "۱۴۰۳/۰۳/۱۳ ۱۳:۳۳:۴۶", "C"));
        var_dump("");
        // Return the result as JSON
//        echo json_encode($result);



// Convert Jalali to Gregorian


// Call the getShiftRecords function
$shiftTotalTonnage= ParamsController::getShiftParams("۱۴۰۳/۰۳/۱۳ ۱۳:۲۹:۴۶", "۱۴۰۳/۰۳/۱۳ ۱۳:۳۳:۴۶", 'C');

// Call the getShiftParams function
$shiftActivity  = SpeedController::getShiftRecords("۱۴۰۳/۰۳/۱۳ ۱۳:۲۹:۴۶", "۱۴۰۳/۰۳/۱۳ ۱۳:۳۳:۴۶", 'C');

// Combine the results
$result = [
    'shiftActive' => $shiftActivity['active'],
    'shiftSilent' => $shiftActivity['silent'],
    'shiftParams' => $shiftTotalTonnage,
];

// Return the result as JSON
echo json_encode($result);



//    echo json_encode(['error' => 'Missing parameters']);


?>

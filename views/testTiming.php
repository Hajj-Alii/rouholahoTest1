<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";

// Get start and end date/time from POST request
$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];

// Calculate total tonnage
$totalTonnage = ParamsController::calculate_totalTonnage($startDate, $endDate);
//var_dump(ParamsModel::selectParams(ParamsController::jalaliToGregorian_DateTime($startDate), ParamsController::jalaliToGregorian_DateTime($endDate)));
// Return result as JSON
var_dump($totalTonnage);

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "controllers/SpeedController.php";
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;


if(isset($_GET["startDate"]) && isset($_GET["endDate"])){
    $startDate = $_GET["startDate"];
    $endDate = $_GET["endDate"];
    var_dump($startDate, $endDate);
    var_dump(SpeedController::fetchRecords_jalaliToGregorian($startDate, $endDate));

}
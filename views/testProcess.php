<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "controllers/SpeedController.php";
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;


//if($_SERVER['REQUEST_METHOD'] == 'GET') {
//    if (SpeedController::valuesExist(["startDate", "endDate"])){
//        var_dump(SpeedController::getDeactiveArray(
//            SpeedController::jalaliToGregorian_DateTime($_GET["startDate"]),
//            SpeedController::jalaliToGregorian_DateTime($_GET["endDate"])));}
//    else
//        echo "value doesnt exist";
//
//    if(SpeedController::valuesExist(["startDate", "endDate"])){
//        var_dump(SpeedController::getActiveArray(
//            SpeedController::jalaliToGregorian_DateTime($_GET["startDate"]),
//            SpeedController::jalaliToGregorian_DateTime($_GET["endDate"]))
//        );
//    }
//}
var_dump(SpeedController::readAll());




//var_dump(
//    SpeedModel::getActiveRecords(
//        new DateTime("2024-05-24 08:34:4", new DateTimeZone("Asia/Tehran")),
//        new DateTime("now", new DateTimeZone("Asia/Tehran")))
//);

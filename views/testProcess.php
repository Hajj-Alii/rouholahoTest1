<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "models/SpeedModel.php";
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

if($_SERVER['REQUEST_METHOD'] == 'GET')
    if (isset($_GET["startDateTime"]) && !empty($_GET["startDateTime"]))
        var_dump(SpeedModel::jalalianToGregorian($_GET["startDateTime"]));

<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";

use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;
//$startDate = new DateTime("2024-05-24 09:26:27");
//var_dump(SpeedModel::readRecord($startDate)['time']);
//$record = SpeedModel::readRecord($startDate);
//$lastTime = new DateTime($record['time']);
$startdate = new DateTime("2024-05-22 14:01:14");
$endDate = new DateTime("2024-05-22 14:28:14");
var_dump(SpeedModel::getRecords($startdate, $endDate));

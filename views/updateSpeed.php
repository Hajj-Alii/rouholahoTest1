<?php
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

//var_dump(new DateTime("now", new DateTimeZone("Asia/Tehran")));
//var_dump(Jalalian::now(new DateTimeZone("Asia/Tehran")));
//var_dump(SpeedModel::fetchFirstRecord_Time());
//var_dump(new DateTime("2024-05-21 14:12:14", new DateTimeZone("Asia/Tehran")));
$records = SpeedModel::getRawRecords(new DateTime("2024-05-21 14:12:14", new DateTimeZone("Asia/Tehran")), new DateTime("now", new DateTimeZone("Asia/Tehran")));

$paramsArray = ParamsModel::insertParams(new DateTime("2024-05-21 14:12:14", new DateTimeZone("Asia/Tehran")), new DateTime("now", new DateTimeZone("Asia/Tehran")), 11, 111);
//foreach ($records as $record)
//{
//    $paramsArray['item'] = $record['value'];
//    $paramsArray['date'] = $record['time'];
//}
var_dump($paramsArray);

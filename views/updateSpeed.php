<?php
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

//var_dump(new DateTime("now", new DateTimeZone("Asia/Tehran")));
//var_dump(Jalalian::now(new DateTimeZone("Asia/Tehran")));
//var_dump(SpeedModel::fetchFirstRecord_Time());
$records = SpeedController::fetchAllRecords2();
foreach ($records as $record)
    foreach ($record as $item)
        var_dump($item);
?>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";

use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
class ParamsController{


    public static function isStartOlder(DateTime $startDate, DateTime $endDate)
    {
        return $startDate <= $endDate;
    }

    public static function convertPersianToEnglish($number)
    {
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($persianDigits, $englishDigits, $number);
    }

    public static function jalaliToGregorian_DateTime($jalaliDateTime)
    {
        $formmatedDate = str_replace("/", "-", self::convertPersianToEnglish($jalaliDateTime));
        return Carbon::createFromTimestamp(Jalalian::fromFormat("Y-m-d H:i:s", $formmatedDate)->getTimestamp());
    }

    public static function insertParams($startTime, $endTime, $width, $grammage)
    {
        $startTime2 = self::jalaliToGregorian_DateTime($startTime);
        $endTime2 = self::jalaliToGregorian_DateTime($endTime);
        if(self::isStartOlder($startTime2, $endTime2))
            ParamsModel::insertParams($startTime2, $endTime2, $width, $grammage);
        else
            echo "end time {$endTime2->format("Y-m-d H:i:s")} is older than start time {$endTime2->format("Y-m-d H:i:s")}";
    }

}
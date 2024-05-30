<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";

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

    public static function insertParams($startTime, $endTime, $width, $grammage): bool
    {
        $startTime2 = self::jalaliToGregorian_DateTime($startTime);
        $endTime2 = self::jalaliToGregorian_DateTime($endTime);

        if (!is_numeric($width) || !is_numeric($grammage)) {
            echo "Width and grammage must be valid numbers.";
            return false;
        }

        if (self::isStartOlder($startTime2, $endTime2)) {
            try {
                ParamsModel::insertParams($startTime2, $endTime2, $width, $grammage);
                return true;
            } catch (Exception $e) {
                // Log the error message
                error_log("Error inserting parameters: " . $e->getMessage());
                echo "An error occurred while inserting parameters.";
                return false;
            }
        } else {
            echo "End time {$endTime2->format("Y-m-d H:i:s")} is older than start time {$startTime2->format("Y-m-d H:i:s")}";
            return false;
        }
    }
    public static function fetchParams($startTime, $endTime)
    {
        $startTime2 = self::jalaliToGregorian_DateTime($startTime);
        $endTime2 = self::jalaliToGregorian_DateTime($endTime);
        if(self::isStartOlder($startTime2, $endTime2))
            return ParamsModel::selectParams($startTime2, $endTime2);
        else
            echo "end time {$endTime2->format("Y-m-d H:i:s")} is older than start time {$endTime2->format("Y-m-d H:i:s")}";

    }

    public static function calculate_totalTonnage($startTime, $endTime){
        $startTimeGregorian = self::jalaliToGregorian_DateTime($startTime);
        $endTimeGregorian = self::jalaliToGregorian_DateTime($endTime);
        $records = ParamsModel::selectParams($startTimeGregorian, $endTimeGregorian);
        $totalTonnage = 0;
        foreach($records as $record)
            $totalTonnage += (double)$record['tonnage'];
        return $totalTonnage;
    }

}
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";

use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class SpeedController
{

    public static $speed;

    public static function isStartOlder(DateTime $startDate, DateTime $endDate)
    {
        return $startDate <= $endDate;
    }

    public static function shiftExists($records, $shift)
    {
        foreach ($records as $record)
            if($record['shift'] == $shift)
                return true;
        return false;
    }

    public static function getShiftRecords($startDate, $endDate, $shift)
    {
        $records = SpeedModel::getRecords2(self::jalaliToGregorian_DateTime($startDate), self::jalaliToGregorian_DateTime($endDate));
        $report = [];
        $active = $silent = 0;
        if (self::shiftExists($records, $shift))
            foreach ($records as $record){
                if($record['value'] > 0 && $record['shift'] == $shift) $active ++;
                else $silent ++;
            }
        return ['active' => $active, 'silent' => $silent];
    }


    public static function NMin_Ago_Jalali($minAgo, Jalalian $jalalianDateTime, DateTimeZone $timeZone)
    {
        return Jalalian::forge($jalalianDateTime->getTimestamp() - $minAgo * 60, $timeZone);
    }


    public static function nMin_Ago_Gregorian(DateTime $nowDateTime, $timeZone, $minAgo): DateTime
    {
        $modified = DateTime::createFromFormat('Y-m-d H:i:s', $nowDateTime->format("Y-m-d H:i:s"), $timeZone);
        $modified->modify("-$minAgo min");
        return $modified;
    }

    public static function addSpeed($value, $time)
    {
        if (self::valueExist()) {
            self::$speed = new SpeedModel();
            self::$speed::insertSpd($value, $time);
        } else
            echo "parameter Undefined!";
    }

    public static function valueExist($paramName)
    {
        if (isset($_GET["$paramName"]) && !empty($_GET[$paramName]))
            return true;
        return false;
    }

    public static function valuesExist(array $paramNames)
    {
        foreach ($paramNames as $key)
            if (!isset($_GET[$key]) && empty($_GET[$key])) {
                echo "parameter $key Undefined!";
                return false;
            }
        return true;
    }

    #region add speed items
    public static function addSpeeds_Items(array $baseArray, array $nameArray, DateTime $nowDateTime, DateTimeZone $timeZone)
    {
        //assumption [spd5,spd4, spd3, spd2, spd1]

        if (self::valuesExist($nameArray)) {
            self::$speed = new SpeedModel();
            $i = 4;
            foreach ($nameArray as $name) {

                self::$speed::insertSpd($baseArray[$name], self::nMin_Ago_Gregorian($nowDateTime, $timeZone, $i));
                echo $i;
                $i--;
            }
        }
    }

    #endregion

    public static function readAll()
    {
        $array = [];
        self::$speed = new SpeedModel();
        $records = self::$speed::readAllAsJalali();
        foreach ($records as $record)
            $array[] = ['value' => $record['value'], 'time' => $record["time"], "shift" => $record["shift"]];
        return $array;
    }

    public static function readAll_asJson()
    {
        self::$speed = new SpeedModel();
        $array = self::$speed::readAllAsJalali();
        header('Content-Type: application/json');
        echo json_encode($array);
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

    public static function fetchRecords_jalaliToGregorian($startDate, $endDate, $shift)
    {
//        if (self::isStartOlder($startDate, $endDate))
        return SpeedModel::getRecords2(self::jalaliToGregorian_DateTime($startDate), self::jalaliToGregorian_DateTime($endDate), $shift);
//        else
//            echo "{$endDate->format("Y-m-d H:i:s")} is older than {$startDate->format("Y-m-d H:i:s")}";
    }

    public static function fetchRecords_gregorian($startDate, $endDate)
    {
        if (self::isStartOlder($startDate, $endDate))
            return SpeedModel::getRecords($startDate, $endDate);
        else
            echo "{$startDate->format("Y-m-d H:i:s")} is older than {$endDate->format("Y-m-d H:i:s")}";
    }

    public static function fetchAllRecords2()
    {
        return self::fetchRecords_gregorian(SpeedModel::fetchFirstRecord_Time(), new DateTime("now", new DateTimeZone("Asia/Tehran")));
    }

    public static function fetchAllRecords()
    {
        return self::fetchRecords_jalaliToGregorian(SpeedModel::fetchFirstRecord_Time(), self::jalaliToGregorian_DateTime(Jalalian::now(new DateTimeZone("Asia/Tehran"))));
    }


    #region export as Excel
    public static function exportAsExcel()
    {
        self::$speed = new SpeedModel();
        echo self::$speed::exportAs_Excel();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=speedItems.xls");
    }
    #endregion
}

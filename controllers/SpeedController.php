<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";

use \Morilog\Jalali\Jalalian;

class SpeedController
{

    public static $speed;

    public static function NMin_Ago_Jalali($minAgo, Jalalian $jalalianDateTime, DateTimeZone $timeZone)
    {
        return Jalalian::forge($jalalianDateTime->getTimestamp() - $minAgo * 60, $timeZone);
    }


    public static function nMin_Ago_Gregorian(DateTime $nowDateTime, $timeZone, $minAgo): DateTime
    {
        $modified = DateTime::createFromFormat('Y-m-d H:i:s', $nowDateTime->format("Y-m-d H:i:s"), $timeZone);
        if ($minAgo == 1)
            $modified->modify("-0 min");
        else
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

    public static function addSpeeds_Items(array $baseArray, array $nameArray, DateTime $nowDateTime, DateTimeZone $timeZone)
    {
        //assumption [spd5,spd4, spd3, spd2, spd1]

        if (self::valuesExist($nameArray)) {
            self::$speed = new SpeedModel();
            $i = 5;
            foreach ($nameArray as $name) {
                self::$speed::insertSpd($baseArray[$name], self::nMin_Ago_Gregorian($nowDateTime, $timeZone, $i));
                $i--;
            }
        }
    }

    public static function readAll()
    {

        self::$speed = new SpeedModel();

        $array = self::$speed::readAllAsJalali();

//        foreach ($array as $value => $time)
//            $array[$value] = $time;
        return $array;
    }
    public static function getActiveArray(DateTime $startDate, DateTime $endDate)
    {
        return SpeedModel::getActiveTimes($startDate, $endDate);
    }
    public static function getDeactiveArray(DateTime $startDate, DateTime $endDate)
    {
        return SpeedModel::getDeactiveTimes($startDate, $endDate);

    }
    public static function calculateActiveTime(DateTime $startDate, DateTime $endDate)
    {
        return count(SpeedModel::getActiveTimes($startDate, $endDate));
    }

    public static function calculateDeactiveTime(DateTime $startDate, DateTime $endDate){
        return count(SpeedModel::getDeactiveTimes($startDate, $endDate));
    }

    public static function calculateActive_AVG(DateTime $startDate, DateTime $endDate)
    {
        $sum = 0;
        foreach(self::getActiveArray($startDate, $endDate) as $value => $time)
            $sum += $value;
        return $sum / self::calculateActiveTime($startDate, $endDate);
    }


    public static function exportAsExcel()
    {
        self::$speed = new SpeedModel();

        echo self::$speed::exportAs_Excel();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=speedItems.xls");
    }

}
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/SpeedModel.php";

use \Morilog\Jalali\Jalalian;

class SpeedController
{

    public static $speed;

    public static $speedCondition;


    public static function NMin_Ago($minAgo, Jalalian $jalalianDateTime, DateTimeZone $timeZone)
    {
        return Jalalian::forge($jalalianDateTime->getTimestamp() - $minAgo * 60, $timeZone);
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
//        var_dump($paramNames);
        for($i = 0; $i < count($paramNames); $i++) {
            if (!self::valueExist($paramNames[$i])) {
                echo "Undefined parameter $paramNames[$i])";
                return false;
            }

        }
        return true;
    }

    public static function addSpeeds_Items(array $valueArray, Jalalian $time, DateTimeZone $timeZone)
    {
        //assumption [spd5,spd4, spd3, spd2, spd1]

//        if (self::valuesExist($valueArray)) {
        self::$speed = new SpeedModel();
        for ($i = 4; $i >= 0; $i--)
            self::$speed::insertSpd((int)$valueArray[$i] +1, self::NMin_Ago($i, $time, $timeZone));
//        }
//        else
//            echo "they dont exist, in speed controller";


    }

    public static function readAll()
    {

        self::$speed = new SpeedModel();

        $array = self::$speed::readAll();

        foreach ($array as $value => $time)
            $array[$value] = $time;
        var_dump($array);
    }


}
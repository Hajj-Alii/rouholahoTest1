<?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/models/SpeedModel.php";
class SpeedController
{

    public static $speed;

    public static $speedCondition;

    public static function valueExist($paramName)
    {
        if (isset($_GET["$paramName"]) && !empty($_GET[$paramName]))
            return true;
        return false;
    }

    public static function valuesExist($paramNames = array()){
        foreach ($paramNames as $name)
            if(self::valueExist($name))
                return true;
        return false;
    }

    public static function addSpeed($value, $time){
        if( self::valueExist()){
            self::$speed = new SpeedModel();
            self::$speed::insertSpd($value, $time);
        }
        else
            echo "parameter Undefined!";
    }


    public static function add5thSpeed($key, $value, $time)
    {
        if(self::valueExist($key))
        {
            self::$speed = new SpeedModel();

            self::$speed::insertSpd($value, $time);

        }
        else
            echo "Undefined parameter $value";
    }

//    public static function addSpeeds_Items($valueArray = array() ,$time){
//
//        if(self::valuesExist($valueArray))
//            {
//                self::$speed = new SpeedModel();
//                $interval = new DateInterval('PT5M');
//                $time->sub($interval);
//                self::$speed::insertSpd($valueArray[0], $time);
//
//
//            }
//}

    public static function readAll(){

        self::$speed = new SpeedModel();

        $array = self::$speed::readAll();

        foreach($array as $value => $time)
            $array[$value] = $time;
        var_dump($array);
        }





}
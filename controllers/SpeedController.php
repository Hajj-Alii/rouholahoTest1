<?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/models/SpeedModel.php";
class SpeedController
{

    public static $speed;

    public static $speedCondition;

    public static function valueExist()
    {
        if (isset($_GET["spd"]) && !empty($_GET["spd"]))
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

    public static function readAll(){

        self::$speed = new SpeedModel();

        $array = self::$speed::readAll();

        foreach($array as $value => $time)
            $array[$value] = $time;
        var_dump($array);
        }





}
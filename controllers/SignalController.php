<?php
include $_SERVER['DOCUMENT_ROOT'] . '/www/rouholahoTest1/models/Signal.php';

//include "models/Signal.php";
class SignalController
{
    public static $nameAvailable = false;
    public static $addressAvailable = false;

    // Signal class object, to call its methods
    private static $signal;

    public static function nameExist()
    {
        if (isset($_GET["name"]) && !empty($_GET["name"]))
            return true;
        return false;
    }

    public static function addressExist()
    {
        if (isset($_GET["address"]) && !empty($_GET["address"]))
            return true;
        return false;
    }

    public static function addSignal($name, $address)
    {
        if (self::nameExist() && self::addressExist()) {
            self::$signal = new Signal();
            self::$signal->insertSignal($name, $address);
        } else
            echo "Undefined name parameter";
    }

    public static function readAll()
    {
        self::$signal = new Signal();
        $array = self::$signal->readAll();

        foreach ($array as $address => $name)
            $array[$address] = $name;

        var_dump($array);
    }

    public static function exportAsExcel()
    {
        self::$signal = new Signal();

        echo self::$signal->getAllAsExcel();
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=signals.xls");
    }

}

//
//
//include "models/DataAccess.php";
//$nameAvailable = $addressAvailable = false;
//
//if (isset($_GET["name"]) && !empty($_GET["name"])) {
//    $nameAvailable = true;
//    echo " Signal name is " . $_GET["name"];
//} else {
//    echo " Signal name is null";
//}
//
//
//if (isset($_GET["address"]) && !empty($_GET["address"])) {
//    $addressAvailable = true;
//    echo " Signal address is " . $_GET["address"];
//} else {
//    echo " Signal address is undefined";
//}
//
//if ($nameAvailable && $addressAvailable)
//    DataAccess::insertSignal($_GET["name"], (int)$_GET["address"]);
//?>
<!---->

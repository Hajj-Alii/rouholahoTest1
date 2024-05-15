<?php

class Controller{
    public static $nameAvailable = false;
    public static $addressAvailable = false;

    private static $signal;

    public static function nameExist(){
        if(isset($_GET["name"]) && !empty($_GET["name"]))
            return true;
        return false;
    }

    public static function addressExist(){
        if(isset($_GET["address"]) && !empty($_GET["address"]))
            return true;
        return false;
    }
    public function addsignal($name, $address){
        if(self::nameExist() && self::addressExist())
        {
            $signal = new Signal();
            $signal->insertSignal($name, $address);
        }
        else
            echo "Undefined name parameter";
    }


}
















include "models/DataAccess.php";
$nameAvailable = $addressAvailable = false;

if (isset($_GET["name"]) && !empty($_GET["name"])) {
    $nameAvailable = true;
    echo " Signal name is " . $_GET["name"];
} else {
    echo " Signal name is null";
}


if (isset($_GET["address"]) && !empty($_GET["address"])) {
    $addressAvailable = true;
    echo " Signal address is " . $_GET["address"];
} else {
    echo " Signal address is undefined";
}

if ($nameAvailable && $addressAvailable)
    DataAccess::insertSignal($_GET["name"], (int)$_GET["address"]);
?>


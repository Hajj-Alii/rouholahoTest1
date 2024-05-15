<?php

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


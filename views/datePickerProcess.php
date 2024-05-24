<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

if(isset($_GET["startDate"])){
    $starDate = $_GET["startDate"];
    $formmatedDate = str_replace("/", "-", $starDate);
    $jalalian = Jalalian::fromFormat('Y-m-d', $formmatedDate);
    $timestamp = $jalalian->getTimestamp();

    $gregorianDate = Carbon::createFromTimestamp($timestamp);

    echo $formmatedDate."<br/>";

    echo $gregorianDate->format('Y-m-d H:i:s'); // Outputs: 2021-03-20 00:00:00"Y-m-d");




}
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";

use \Morilog\Jalali\Jalalian;

$ctrl = new SpeedController();
$timeZone = new DateTimeZone("Asia/Tehran");
$nowDateTime = new DateTime("now", $timeZone);

$nameArray = [
    "spd5",
    "spd4",
    "spd3",
    "spd2",
    "spd1"];
    $ctrl::addSpeeds_Items($_GET, $nameArray, $nowDateTime, $timeZone);

//echo $nowDateTime->modify("-5 minutes")->format("Y-m-d H:i:s");
//for($i = 5; $i >= 1; $i--) {
//    echo $ctrl::nMin_Ago_Gregorian($nowDateTime, $i)->format("Y-m-d H:i:s") . "<br/>";
//    echo "$i<br/>";
//    echo "Now Time is".$nowDateTime->format("Y-m-d H:i:s")."<br/><br/><br/><br/>";
//}


//    $ctrl::addSpeeds_Items($_GET, $nameArray, $nowDateTime, $timeZone);
//echo $ctrl::nMin_Ago_Gregorian($nowDateTime, 5)->format("Y-m-d H:i:s");
//
//$jalaliDate = jdate(strtotime("2024-05-18 11:43:32"));
//echo $jalaliDate."<br/>";





















 //// $jDate = \Morilog\Jalali\Jalalian::now();
//// $date = \Morilog\Jalali\Jalalian::forge('now'); // 1391-10-02 00:00:00
// $timestamp = \Morilog\Jalali\Jalalian::forge('last sunday');
//$jDate = jdate(\Morilog\Jalali\Jalalian::forge('now'));
//
// //echo $date;
//// $date =\Morilog\Jalali\Jalalian::forge('last sunday')->format('time'); // 00:00:00
//echo $timestamp;

// $DateTime = new DateTime("2023-07-25");

// $IntlDateFormatter = new IntlDateFormatter(
//     'ir_IR@calendar=persian',
//     IntlDateFormatter::NONE,
//     IntlDateFormatter::NONE,
//     'Asia/Tehran',
//     IntlDateFormatter::TRADITIONAL,
//     "Y-m-d H:i:s"
// );

// echo $IntlDateFormatter->format($date);


//$ctrl::addSpeed((int)$_GET["spd"],  $date);

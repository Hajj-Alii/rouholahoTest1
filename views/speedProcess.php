 <?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/controllers/SpeedController.php";
include  $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/"."vendor/autoload.php";
use \Morilog\Jalali\Jalalian;
$ctrl = new SpeedController();
// $timezone = new DateTimeZone('Asia/Tehran');

//
// $date = \Morilog\Jalali\Jalalian::forge('now')->getTimestamp(); // 1333857600
//echo jdate($date);
// $date = new jDateTime(true, true, 'Asia/Tehran');
//
// echo $date->date("Y-m-d h:i:s", false, false)."\n";

$timeZone = new DateTimeZone("Asia/Tehran");
$newDate = Jalalian::forge('now', $timeZone);
echo $newDate;
//$ctrl::add5thSpeed('spd',$_GET['spd'], $newDate);























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

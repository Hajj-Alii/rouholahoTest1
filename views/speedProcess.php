 <?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/controllers/SpeedController.php";
include  $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/"."vendor/autoload.php";
use \Morilog\Jalali\Jalalian;
$ctrl = new SpeedController();


$timeZone = new DateTimeZone("Asia/Tehran");
$nowDate = Jalalian::forge('now', $timeZone);
//
//
// if ($ctrl::valuesExist(["spd5", "spd4", "spd3", "spd2", "spd1"]))
//     echo "YES"; it was OK!

//if ($ctrl::valuesExist($_GET))
//    echo "yes"; is bad
//else echo "no";
$keyArray = ["spd5", "spd4", "spd3", "spd2", "spd1"];
$newArray = array();
if($ctrl::valuesExist($keyArray))
{
//    echo "yes they all exist<br/>";
    $normalArray = array_values($_GET);
    $ctrl::addSpeeds_Items($normalArray, $nowDate, $timeZone);

}

//var_dump( $_GET);




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

 <?php
include_once $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/controllers/SpeedController.php";
include  $_SERVER["DOCUMENT_ROOT"]. "/www/rouholahoTest1/"."vendor/autoload.php";
use \Morilog\Jalali\Jalalian;
$ctrl = new SpeedController();


 // Create a Jalalian object
// $jalaliDate = Jalalian::fromFormat('Y-m-d H:i:s', 'now');
// $date = Jalalian::forge('now')->getTimestamp();
//
// $nowTimeStamp = Jalalian::forge('now')->getTimestamp();
// $date = jdate($nowTimeStamp);
// $fiveMinAgo = $nowTimeStamp - 5 * 60;
// $nowDateTime = Jalalian::now();
// $nowDate = jdate($nowTimeStamp);
// echo $nowTimeStamp."<br/>";
// echo $nowDateTime."<br/>";
//// echo $nowDateTime;
// echo $fiveMinAgo;

// // Display the original date and time
// echo "Original Jalali DateTime: " . $jalaliDate->format('Y-m-d H:i:s') . "\n";
//
// // Convert the Jalali date to a Unix timestamp
// $timestamp = $jalaliDate->getTimestamp();
//
// // Subtract the desired number of minutes (e.g., 10 minutes)
// $timestamp -= 10 * 60; // 10 minutes * 60 seconds per minute
//
// // Convert the modified timestamp back to a Jalalian object
// $modifiedJalaliDate = Jalalian::forge($timestamp);
//
// // Display the modified date and time
// echo "Modified Jalali DateTime: " . $modifiedJalaliDate->format('Y/m/d H:i:s') . "\n";


 $timeZone = new DateTimeZone("Asia/Tehran");
$nowDate = Jalalian::forge('now', $timeZone);

$nowTimeStamp = $nowDate->getTimestamp();
$fiveMinAgo = Jalalian::forge($nowTimeStamp - 5 * 60, $timeZone);
echo "NOW IS : ".$nowDate."<br/>";
echo "FIVE MIN AGO WAS : ".$fiveMinAgo;




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

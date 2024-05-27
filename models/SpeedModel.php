<?php
include_once "DataAccess.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";

use Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class SpeedModel
{

    public static $data;


    #region insert single record
    public static function insertSpd($value, DateTime $dateTime)
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("INSERT INTO testdb1.speed(value, time) VALUES(:value, :time);");
            $statement->execute([":value" => $value, ":time" => $dateTime->format("Y-m-d H:i:s")]);

        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }
    #endregion

    #region read all
    public static function readAllAsGregorian()
    {
        self::$data = new DataAccess();
        $speedArray = [];
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->query("SELECT * FROM testdb1.speed;");

            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($records as $record)
                $speedArray[$record["value"]] = $record["time"];

            return $speedArray;
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }
    #endregion



    public static function fetchFirstRecord_Time()
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("SELECT time from testdb1.speed ORDER BY time ASC LIMIT 1;");
            $statement->execute();
            $firstDateTime = new DateTime($statement->fetch(PDO::FETCH_ASSOC)['time'], new DateTimeZone("Asia/Tehran"));
            return $firstDateTime;

        }
        catch (PDOException $e)
        {
            echo "connection failed: " . $e->getMessage();
        }

    }

    public static function fetchLastRecord_Time()
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("SELECT time from testdb1.speed ORDER BY time DESC LIMIT 1;");
            $statement->execute();
            $firstRecord = $statement->fetch(PDO::FETCH_ASSOC);
            return $firstRecord;
        }
        catch (PDOException $e){
            echo "connection error: " . $e->getMessage();
        }
    }



    #region readAllAsJalali
    public static function readAllAsJalali()
    {
        self::$data = new DataAccess();
        $speedArray = [];
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->query("SELECT * FROM testdb1.speed;");

            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($records as $record) {
                $value = $record["value"] !== null ? $record["value"] : "null";
                $time = self::gregorianToJalali($record["time"])->format("Y-m-d H:i:s");
                $speedArray[] = ["value" => $value, "time" => $time];

            }

            return $speedArray;
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }

    }
#endregion

    #region gregorian to jalali
    public static function gregorianToJalali(string $dateTime)
    {
        return jdate(strtotime($dateTime));

    }
    public static function gregorianToJalali_str(string $dateTime)
    {
        return jdate(strtotime($dateTime))->format("Y-m-d H:i:s");
    }

    #endregion

    #region export as excel
    public static function exportAs_Excel()
    {
        try {
            $records = self::readAllAsJalali();
            $data = "Value\tTime\n";// excel coloumn header
            foreach ($records as $value => $time)
                $data .= $value . "\t" . $time . "\n";
            return $data;

        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

    #endregion


    public static function getRawRecords(DateTime $startDate, DateTime $endDate)
    {
        self::$data = new DataAccess();

        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("SELECT * FROM testdb1.speed WHERE time BETWEEN :start_date AND :end_date;");
            $startDateFormatted = $startDate->format("Y-m-d H:i:s");
            $endDateFormatted = $endDate->format("Y-m-d H:i:s");


            $statement->bindParam(':start_date', $startDateFormatted);
            $statement->bindParam(':end_date', $endDateFormatted);
            $statement->execute();

            $records = $statement->fetchAll(PDO::FETCH_ASSOC);

//            echo "Query executed. Records fetched: " . count($records) . "\n";
//            print_r($records); // Debug print

            return $records; // Return the fetched records
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return []; // Return an empty array on failure
        }
    }

    public static function readRecord(DateTime $dateTime)
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("SELECT * FROM testDb1.speed WHERE time = :dateTime;");
            $formattedDate = $dateTime->format("Y-m-d H:i:s");
            $statement->bindParam(":dateTime", $formattedDate);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $exception) {
            echo 'connection failed: ', $exception->getMessage();
            return false;
        }
    }

    public static function getRecords(DateTime $startDate, DateTime $endDate)
    {
        self::$data = new DataAccess();

        try {
            $records = self::getRawRecords($startDate, $endDate);

            // Initialize result array
            $resultRecords = [];
            $lastRecordTime = $startDate;

            if (empty($records)) {
                // No records found, fill the entire range with silent records
                $currentSilentTime = clone $startDate;
                while ($currentSilentTime <= $endDate) {
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($currentSilentTime->format('Y-m-d H:i:s')),
                        'value' => null, // "silent times" value
                        'status' => 'silent',
                    ];
                    $currentSilentTime->add(new DateInterval('PT1M')); // Increment by 1 minute
                }
            } else {
                foreach ($records as $record) {
                    $currentRecordTime = new DateTime($record['time']);

                    // Fill gaps before the first record
                    while ($lastRecordTime < $currentRecordTime) {
                        $resultRecords[] = [
                            'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                            'value' => null, // "silent times" value
                            'status' => 'silent',
                        ];
                        $lastRecordTime->add(new DateInterval('PT1M'));
                    }

                    // Add the current active record
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($record['time']),
                        'value' => $record['value'],
                        'status' => 'active',
                    ];

                    // Update lastRecordTime for the next iteration
                    $lastRecordTime = clone $currentRecordTime;
                    $lastRecordTime->add(new DateInterval('PT1M')); // Move to the next minute
                }

                // Fill gaps after the last record up to endDate
                while ($lastRecordTime <= $endDate) {
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                        'value' => null, // "silent times" value
                        'status' => 'silent',
                    ];
                    $lastRecordTime->add(new DateInterval('PT1M'));
                }
            }

            return $resultRecords; // Return the combined set of fetched records and generated "silent times" records
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return []; // Return an empty array on failure
        }
    }


    #region farsi to English nums
    public static function convertPersianToEnglish($number)
    {
        $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($persianDigits, $englishDigits, $number);
    }

    #endregion

    #region jalali to gregorian
    public static function jalalianToGregorian($jalalianDateTime)
    {
        $formmatedDate = str_replace("/", "-", self::convertPersianToEnglish($jalalianDateTime));
        return Carbon::createFromTimestamp(Jalalian::fromFormat('Y-m-d H:i:s', $formmatedDate)->getTimestamp())->format('Y-m-d H:i:s');
    }

    #endregion

    public static function jalaliToGregorian_DateTime($jalaliDateTime)
    {
        $formmatedDate = str_replace("/", "-", self::convertPersianToEnglish($jalaliDateTime));
        return Carbon::createFromTimestamp(Jalalian::fromFormat("Y-m-d H:i:s", $formmatedDate)->getTimestamp());
    }


}
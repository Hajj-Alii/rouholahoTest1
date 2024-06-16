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
            $statement = self::$data::$pdo->prepare("INSERT INTO testdb1.speed(value, time, shift) VALUES(:value, :time, :shift);");
            $statement->execute([":value" => $value, ":time" => $dateTime->format("Y-m-d H:i:s"), ":shift" => self::getCurrentShift($dateTime)]);

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

        } catch (PDOException $e) {
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
        } catch (PDOException $e) {
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
                $shift = $record["shift"] !== null ? $record["shift"] : "null";
                $time = self::gregorianToJalali($record["time"])->format("Y-m-d H:i:s");
                $speedArray[] = ["value" => $value, "time" => $time, "shift" => $shift];

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


    public static function getRecord(DateTime $dateTime)
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

    #endregion

    public static function getRawRecords(DateTime $startDate, DateTime $endDate)
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("
            SELECT * FROM testdb1.speed 
            WHERE time BETWEEN :start_date AND :end_date
        ");
            $startDateFormatted = $startDate->format("Y-m-d H:i:s");
            $endDateFormatted = $endDate->format("Y-m-d H:i:s");
            $statement->bindParam(':start_date', $startDateFormatted);
            $statement->bindParam(':end_date', $endDateFormatted);
            $statement->execute();
            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
//            if (empty($records))
//                echo "No records found between " . $startDateFormatted . " and " . $endDateFormatted . ".";
            return $records;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return [];
        }
    }

    #region getRecords
    public static function getRecords(DateTime $startDate, DateTime $endDate)
    {
        self::$data = new DataAccess();

        try {
            self::$data::connect();

            $records = self::getRawRecords($startDate, $endDate);

            // Initialize result array
            $resultRecords = [];
            $lastRecordTime = clone $startDate;

            if (empty($records)) {
                // No records found, fill the entire range with silent records
                while ($lastRecordTime <= $endDate) {
                    echo "whole silent Filling silent record: " . $lastRecordTime->format('Y-m-d H:i:s') . "\n";
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                        'value' => null, // "silent times" value
                        'shift' => self::getCurrentShift($lastRecordTime), // Add shift
                        'status' => 'silent'
                    ];
                    $lastRecordTime->add(new DateInterval('PT1M')); // Increment by 1 minute
                }
            } else {
                foreach ($records as $record) {
                    $currentRecordTime = new DateTime($record['time']);
                    // Fill gaps before the first record
                    while ($lastRecordTime < $currentRecordTime && $lastRecordTime <= $endDate) {
                        echo "currentRecordTime: {$currentRecordTime->format("Y-m-d H:i:s")}, lastRecord:  " . $lastRecordTime->format('Y-m-d H:i:s') . "\n";
                        $resultRecords[] = [
                            'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                            'value' => null, // "silent times" value
                            'shift' => self::getCurrentShift($lastRecordTime), // Add shift
                            'status' => 'silent',
                        ];
                        $lastRecordTime->add(new DateInterval('PT1M'));
                    }

                    // Add the current active record if it's within the range
                    if ($currentRecordTime >= $startDate && $currentRecordTime <= $endDate) {
                        echo "Adding active record: " . $currentRecordTime->format('Y-m-d H:i:s') . "\n";
                        $resultRecords[] = [
                            'time' => self::gregorianToJalali_str($record['time']),
                            'value' => $record['value'],
                            'shift' => $record['shift'], // Add shift from record
                            'status' => 'active'
                        ];
                    }

                    // Update lastRecordTime for the next iteration
                    $lastRecordTime = clone $currentRecordTime;
                    $lastRecordTime->add(new DateInterval('PT1M')); // Move to the next minute
                }

                // Fill gaps after the last record up to endDate
                while ($lastRecordTime <= $endDate) {
                    echo "last while Filling silent record: " . $lastRecordTime->format('Y-m-d H:i:s') . "\n";
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                        'value' => null, // "silent times" value
                        'shift' => self::getCurrentShift($lastRecordTime), // Add shift
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

    #endregion
    public static function getRecords2(DateTime $startDate, DateTime $endDate)
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
                    // Check if there is no active record already present for this minute
                    if (!self::hasActiveRecord($currentSilentTime, $records)) {
                        $resultRecords[] = [
                            'time' => self::gregorianToJalali_str($currentSilentTime->format('Y-m-d H:i:s')),
                            'value' => 0, // "silent times" value
                            'shift' => self::getCurrentShift($currentSilentTime),
                        ];
                    }
                    $currentSilentTime->add(new DateInterval('PT1M')); // Increment by 1 minute
                }
            } else {
                foreach ($records as $record) {
                    $currentRecordTime = new DateTime($record['time']);

                    // Fill gaps before the first record
                    while ($lastRecordTime < $currentRecordTime) {
                        // Check if there is no active record already present for this minute
                        if (!self::hasActiveRecord($lastRecordTime, $records)) {
                            $resultRecords[] = [
                                'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                                'value' => 0, // "silent times" value
                                'shift' => self::getCurrentShift($lastRecordTime),
                            ];
                        }
                        $lastRecordTime->add(new DateInterval('PT1M'));
                    }

                    // Add the current active record
                    $resultRecords[] = [
                        'time' => self::gregorianToJalali_str($record['time']),
                        'value' => $record['value'],
                        'shift' => self::getCurrentShift($currentRecordTime),
                    ];

                    // Update lastRecordTime for the next iteration
                    $lastRecordTime = clone $currentRecordTime;
                    $lastRecordTime->add(new DateInterval('PT1M')); // Move to the next minute
                }

                // Fill gaps after the last record up to endDate
                while ($lastRecordTime <= $endDate) {
                    // Check if there is no active record already present for this minute
                    if (!self::hasActiveRecord($lastRecordTime, $records)) {
                        $resultRecords[] = [
                            'time' => self::gregorianToJalali_str($lastRecordTime->format('Y-m-d H:i:s')),
                            'value' => 0, // "silent times" value
                            'shift' => self::getCurrentShift($lastRecordTime),
                        ];
                    }
                    $lastRecordTime->add(new DateInterval('PT1M'));
                }
            }
            return $resultRecords; // Return the combined set of fetched records and generated "silent times" records
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return []; // Return an empty array on failure
        }
    }

// Helper function to check if there is an active record present for a given minute
    private static function hasActiveRecord(DateTime $time, array $records): bool
    {
        foreach ($records as $record) {
            $recordTime = new DateTime($record['time']);
            if ($time->format('Y-m-d H:i') === $recordTime->format('Y-m-d H:i')) {
                return true;
            }
        }
        return false;
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

    public static function getCurrentShift($currentDateTime)
    {
        $shiftStartDate = new DateTime('2024-03-20 00:00:00', new DateTimeZone("Asia/Tehran"));
        $shiftDuration = 12;
        $interval = $shiftStartDate->diff($currentDateTime);
        $totalHoursPassed = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);
        $shiftIndex = (int)($totalHoursPassed / $shiftDuration) % 3;
        $shifts = ['A', 'B', 'C'];
        return $shifts[$shiftIndex];
    }

    public static function getShiftRecords(DateTime $startDate, DateTime $endDate, $shift)
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("SELECT value from testdb1.speed WHERE time BETWEEN :startDate and :endDate AND shift=:shift;");
            $statement->execute([':startDate' => $startDate->format("Y-m-d H:i:s"), ':endDate' => $endDate->format("Y-m-d H:i:s"), ':shift' => $shift]);
            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        } catch (PDOException $exception) {
            echo "Error connection: " . $exception->getMessage();
        }
    }


}
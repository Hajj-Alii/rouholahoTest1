<?php
include_once "DataAccess.php";
include_once "SpeedModel.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";

use \Morilog\Jalali\Jalalian;
use Carbon\Carbon;

class ParamsModel
{
    public static function fetchSpeeds_array(DateTime $startTime, DateTime $endTime, $width, $grammage)
    {
        DataAccess::connect();
        try {
            $paramArray = [];
            $records = SpeedModel::getRawRecords($startTime, $endTime);
            if (count($records) == 0)
                echo "no speed records available in given time between {$startTime->format("Y-m-d H:i:s")} and {$endTime->format("Y:m:d H:i:s")}";
            else {
                    foreach ($records as $record) {
                        $paramArray[] = [
                            'speed' => $record['value'],
                            'time' => $record['time'],
                            'width' => $width,
                            'grammage' => $grammage,
                            'tonnage' => (double)$record['value'] * $width * $grammage
                        ];
                    }
                    return $paramArray;
                }

        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }


    public static function selectParams_jalali(DateTime $startTime, DateTime $endTime)
    {
        DataAccess::connect();
        try {
            $statement = DataAccess::$pdo->prepare("SELECT * FROM testdb1.parameters WHERE time BETWEEN :startTime AND :endTime");
            $startTime2 = $startTime->format("Y-m-d H:i:s");
            $endTime2 = $endTime->format("Y-m-d H:i:s");
            $statement->bindParam(':startTime', $startTime2);
            $statement->bindParam(':endTime', $endTime2);
            $statement->execute();
            $records =  $statement->fetchAll(PDO::FETCH_ASSOC);
            $items = [];
            foreach ($records as $record){
                $newRecord = $record;
                $newRecord['time'] = self::gregorianToJalali($record['time']);
                $items[] = $newRecord;
            }
            return $items;
        }
        catch (PDOException $exception){
            echo "error: ". $exception->getMessage();
        }
    }


    public static function selectParams_gregorian(DateTime $startTime, DateTime $endTime)
    {
        DataAccess::connect();
        try {
            $statement = DataAccess::$pdo->prepare("SELECT * FROM testdb1.parameters WHERE time BETWEEN :startTime AND :endTime");
            $startTime2 = $startTime->format("Y-m-d H:i:s");
            $endTime2 = $endTime->format("Y-m-d H:i:s");
            $statement->bindParam(':startTime', $startTime2);
            $statement->bindParam(':endTime', $endTime2);
            $statement->execute();
            $records =  $statement->fetchAll(PDO::FETCH_ASSOC);
            $items = [];
            foreach ($records as $record){
                $newRecord = $record;
                $newRecord['time'] = $record['time'];
                $items[] = $newRecord;
            }
            return $items;
        }
        catch (PDOException $exception){
            echo "error: ". $exception->getMessage();
        }
    }



    public static function insertParams(DateTime $startTime, DateTime $endTime, $width, $grammage)
    {
        DataAccess::connect();
        try {
            $paramArray = self::fetchSpeeds_array($startTime, $endTime, $width, $grammage);
            $stmt = DataAccess::$pdo->prepare("
            INSERT INTO testdb1.parameters (time,speed, width, grammage, tonnage)
            VALUES (:time, :speed, :width, :grammage, :tonnage);
        ");
            $startDateFormatted = $startTime->format("Y-m-d H:i:s");
            $endDateFormatted = $endTime->format("Y-m-d H:i:s");

            foreach ($paramArray as $params) {
                $stmt->bindValue(':time', $params['time']);
                $stmt->bindValue(':speed', $params['speed']);
                $stmt->bindValue(':width', $params['width']);
                $stmt->bindValue(':grammage', $params['grammage']);
                $stmt->bindValue(':tonnage', $params['tonnage']);
                $stmt->execute();
            }
            return $paramArray;

            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

    public static function gregorianToJalali(string $dateTime)
    {
        return jdate(strtotime($dateTime))->format("Y-m-d H:i:s");

    }

}
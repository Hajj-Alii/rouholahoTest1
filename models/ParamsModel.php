<?php
include_once "DataAccess.php";
include_once "SpeedModel.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
class ParamsModel
{


    public static function recordExists($startTime, $endTime)
    {

        DataAccess::connect();
        try {
            $statement = DataAccess::$pdo->prepare("SELECT * FROM testdb1.parameters WHERE time BETWEEN :start AND :end");
            $statement->bindValue(':start', $startTime);
            $statement->bindValue(':end', $endTime);
            $statement->execute();
            $statement->fetch(PDO::FETCH_ASSOC);
            if ($statement->rowCount() > 0)
                return true;
            else
                return false;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public static function fetchSpeeds(DateTime $startTime, DateTime $endTime, $width, $grammage)
    {
        DataAccess::connect();
        try {
            $paramArray = [];
            $records = SpeedModel::getRawRecords($startTime, $endTime);
            if (count($records) == 0)
                echo "no speed records available in given time between {$startTime->format("Y-m-d H:i:s")} and {$endTime->format("Y:m:d H:i:s")}";
            else {
                if (self::recordExists($startTime, $endTime))
                    echo "there are records in given range of time";
                else {
                    foreach ($records as $record) {
                        $paramArray[] = [
                            'value' => $record['value'],
                            'time' => $record['time'],
                            'width' => $width,
                            'grammage' => $grammage
                        ];
                    }
                    return $paramArray;
                }
            }
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }


    public static function selectParams(DateTime $startTime, DateTime $endTime)
    {
        DataAccess::connect();
        try {

            $statement = DataAccess::$pdo->prepare("SELECT * FROM testdb1.parameters WHERE time BETWEEN :startTime AND :endTime");
            $startTime2 = $startTime->format("Y-m-d H:i:s");
            $endTime2 = $endTime->format("Y-m-d H:i:s");
            $statement->bindParam(':startTime', $startTime2);
            $statement->bindParam(':endTime', $endTime2);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception){
            echo "error: ". $exception->getMessage();
        }
    }

    public static function insertParams(DateTime $startTime, DateTime $endTime, $width, $grammage)
    {
        DataAccess::connect();
        try {
            $paramArray = self::fetchSpeeds($startTime, $endTime, $width, $grammage);
            $stmt = DataAccess::$pdo->prepare("
            INSERT INTO testdb1.parameters (time,value, width, grammage)
            VALUES (:time, :value, :width, :grammage)
        ");

            foreach ($paramArray as $params) {
                $stmt->bindValue(':time', $params['time']);
                $stmt->bindValue(':value', $params['value']);
                $stmt->bindValue(':width', $params['width']);
                $stmt->bindValue(':grammage', $params['grammage']);
                $stmt->execute();
            }

            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

}
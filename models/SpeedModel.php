<?php
include_once "DataAccess.php";
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
use Morilog\Jalali\Jalalian;
class SpeedModel
{

    public static $data;
    public static $speedArray;


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
    public static function readAll()
    {
        self::$data = new DataAccess();
        self::$speedArray = [];
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->query("SELECT * FROM testdb1.speed;");

            $records = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($records as $record)
                self::$speedArray[$record["value"]] = $record["time"];

            return self::$speedArray;
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }

    public static function gregorianToJalali(string $dateTime){
        return jdate(strtotime($dateTime));

    }

    #endregion

    #region export as excel
    public static function exportAs_Excel()
    {
        self::$data = new DataAccess();
        try {
            $records = self::readAll();
            $data = "Value\tTime\n";// excel coloumn header
            foreach ($records as $value => $time)
                $data .= $value . "\t" . $time . "\n";
        } catch (PDOException $e) {
            echo "connection failed: " . $e->getMessage();
        }
    }
    #endregion
}
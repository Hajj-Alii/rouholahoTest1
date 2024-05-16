<?php
include_once "DataAccess.php";
class SpeedModel
{

    public static $data;
    public static $speedArray;


    #region insert single record
    public static function insertSpd($value, $dateTime)
    {
        self::$data = new DataAccess();
        try {
            self::$data::connect();
            $statement = self::$data::$pdo->prepare("INSERT INTO testdb1.speed(value, time) VALUES(:value, :time);");
            $statement->execute([":value" => $value, ":time" => $dateTime]);

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
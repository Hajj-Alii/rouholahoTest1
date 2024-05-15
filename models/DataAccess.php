<?php

class DataAccess
{
    //region static fields

    static private $con = "mysql:host=localhost;dbname=testdb1";
    static private $username = "root";
    static private $password = "2222";
    public static $pdo;

    //endregion

    #region connect
    public static function connect()
    {
        self::$pdo = null;
        try {
            self::$pdo = new PDO(self::$con, self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

    }

    #endregion

    #region isConnect
    public function isConnect(): bool
    {
        if (!self::$pdo)
            return false;
        return true;
    }
    #endregion




    #region insert
//    public static function insertSignal($name, $address)
//    {
//        try {
//            self::connect();
////            self::$pdo = new PDO(self::$con, self::$username, self::$password);
////            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            $insertStatement = self::$pdo->prepare("INSERT INTO testdb1.signal (address, name) VALUES (:address, :name)");
//            $insertStatement->execute([":address" => $address, ":name" => $name]);
//        } catch (PDOException $exception) {
//            echo "Connection error: " . $exception->getMessage();
//        }
//
//    }

    #endregion

//    public static function readAll()
//    {
//        $signalsArray = array();
//
//        try {
//            self::$pdo = new PDO(self::$con, self::$username, self::$password);
//            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $sql = "SELECT * FROM testdb1.signal;";
//            $statement = self::$pdo->query($sql);
//            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
//                $signalsArray[$row['name']] = $row['address'];
//
//            return $signalsArray;
//        } catch (PDOException $exception) {
//            echo "Connection error: " . $exception->getMessage();
//        }
//    }

}

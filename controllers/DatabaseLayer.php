<?php

 class DatabaseLayer
{
    //region static fields

    static private $con = "mysql:host=localhost;dbname=testdb1";
    static private $username = "root";
    static private $password = "2222";
    private static $pdo;

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

        return self::$con;
    }
    #endregion

     #region insert
    public static function insertSignal($name, $address)
    {
        self::$pdo = new PDO(self::$con, self::$username, self::$password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $insertStatement =  self::$pdo->prepare("INSERT INTO testdb1.signal (address, name) VALUES (:address, :name)");
        $insertStatement ->execute([":address" => $address, ":name" => $name]);
    }
    #endregion

}

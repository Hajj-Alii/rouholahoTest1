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

}

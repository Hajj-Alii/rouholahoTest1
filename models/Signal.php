<?php

class Signal
{
    private static $data;


    #region signals
    private static $_signals = array();


    public function insertSignal($name, $address)
    {
        self::$data = new DataAccess();
        try {
            self::$data->connect();
            $statement = self::$data::$pdo->prepare("INSERT INTO testdb1.signal (address, name) VALUES (:address, :name)");;
            $statement->execute([':address' => $address, ':name' => $name]);
        }
        catch (PDOException $e){
            echo "connection error: " . $e->getMessage();
        }
    }

    public function readAll()
    {

        self::$data = new DataAccess();
        try{
            self::$data->connect();
            $statement = self::$pdo->query("SELECT * FROM testdb1.signal");
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                self::$_signals[$row['name']] = $row['address'];
            return self::$_signals;
        }
        catch (PDOException $exception){
            echo "connection error: " . $exception->getMessage();
        }
    }
}
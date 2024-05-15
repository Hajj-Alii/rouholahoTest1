<?php
include $_SERVER["DOCUMENT_ROOT"]."/www/rouholahoTest1/models/DataAccess.php";
class Signal
{
    // DataAccess object
    private static $data;


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
            $statement = self::$data::$pdo->query("SELECT * FROM testdb1.signal;");
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $address => $name)
                self::$_signals[$address] = $name;
//            foreach ($rows as $row)
//                 $row['address'];
//            while ($row = $statement->fetch(PDO::FETCH_ASSOC)
//                self::$_signals[$row['name']] = $row['address'];
            return self::$_signals;
        }
        catch (PDOException $exception){
            echo "connection error: " . $exception->getMessage();
        }
    }
}
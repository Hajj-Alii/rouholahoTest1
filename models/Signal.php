<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/DataAccess.php";

class Signal
{
    // DataAccess object
    public static $data;

//associative array of signal records
    private static $_signals;


    public function insertSignal($name, $address)
    {
        self::$data = new DataAccess();
        try {
            self::$data->connect();
            $statement = self::$data::$pdo->prepare("INSERT INTO testdb1.signal (address, name) VALUES (:address, :name)");;
            $statement->execute([':address' => $address, ':name' => $name]);

        } catch (PDOException $e) {
            echo "connection error  : " . $e->getMessage();
        }
    }

    public function readAll()
    {
        self::$data = new DataAccess();
        self::$_signals = array();
        try {
            self::$data->connect();
            $statement = self::$data::$pdo->query("SELECT * FROM testdb1.signal;");
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);


            foreach ($rows as $row)
                self::$_signals[$row["Address"]] = $row["Name"];

            return self::$_signals;

        } catch (PDOException $exception) {
            echo "connection error: " . $exception->getMessage();
        }
    }

    public function getAllAsExcel()
    {
        self::$data = new DataAccess();
        try {
            $rows = self::readAll();
            $data = "Address\tName\n"; // Column headers
//            var_dump($rows);
            foreach ($rows as $address => $name)
                $data .= $address . "\t" . $name . "\n";

            return $data;
        } catch (PDOException $exception) {
            echo "connection error: " . $exception->getMessage();
        }

    }


}
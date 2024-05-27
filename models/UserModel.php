<?php
include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/DataAccess.php";

class UserModel{

    public static function fetchUsers($username)
    {
        try {
            DataAccess::connect();
            $statement = DataAccess::$pdo->prepare("SELECT * FROM testdb1.users WHERE username = :username;");
            $statement->bindValue(':username', $username);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
}
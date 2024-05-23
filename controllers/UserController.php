<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/Models/UserModel.php";

class UserController
{
    public static function canLogin($username, $password)
    {
        $user = UserModel::fetchUsers($username);
        if ($user && $password == $user["password"]) {
            $_SESSION["username"] = $user["username"];
            $_SESSION["password"] = $user["password"]; // Assuming you have an ID column
            return true;
        }
        return false;
    }

    public static function isUserLoggedIn()
    {
        return isset($_SESSION["username"]);
    }

    public static function logOut()
    {
        session_unset();
        session_destroy();
    }

}
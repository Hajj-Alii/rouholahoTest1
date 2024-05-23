<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/UserController.php";

echo "invalid access from unAthurized user";
//echo UserController::canLogin("admin1", 1111);
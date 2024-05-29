<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/models/ParamsModel.php";

$data = json_decode(file_get_contents('php://input'), true);

$startDate = $data['startDate'];
$endDate = $data['endDate'];
$width = (int)$data['width'];
$grammage = (int)$data['grammage'];

ParamsController::insertParams($startDate, $endDate, $width, $grammage);
?>

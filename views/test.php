<?php
//public function showSpdTime()
//{
//
//}


//if(isset($_GET["spd"]))
//    echo date($_GET["spd"]);
if (isset($_GET["spd"]) ) {

    // Validate the input to ensure it's a valid date format
    $timestamp = strtotime($_GET["spd"]);

    if ($timestamp !== false) {
        // Format the timestamp as desired
        echo date("Y-m-d H:i:s", $timestamp);

    }
}





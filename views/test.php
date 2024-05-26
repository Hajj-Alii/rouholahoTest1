<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/persian-datepicker/dist/css/persian-datepicker.css">
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/persian-datepicker/dist/js/persian-datepicker.js"></script>
    <script src="../node_modules/persian-date/dist/persian-date.js"></script>
    <title>Document</title>
</head>
<body>
<form method="get" action="testProcess.php">
    <label>
        <input type="text" name="startDate" class="example1" />
        <br/>
    </label>
    <label>
        <input type="text" name="endDate" class="example1" />
        <br/>
    </label>
    <button type="submit" name="submit" value="handled">send</button>

</form>


<script type="text/javascript">
    $(document).ready(function() {
        $(".example1").pDatepicker({
            format: 'YYYY/MM/DD HH:mm:ss',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: false
                }
            }
        });
    });
</script>

</body>

</html>

<?php
//include $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/" . "vendor/autoload.php";
//use \Morilog\Jalali\Jalalian;
//use Carbon\Carbon;
//
//
////
//$jalaliDate = '1400-03-04';
//
//$jalalian = Jalalian::fromFormat('Y-m-d', $jalaliDate);
//
//$timestamp = $jalalian->getTimestamp();
//
//$gregorianDate = Carbon::createFromTimestamp($timestamp);
//
//echo $gregorianDate->format('Y-m-d H:i:s'); // Outputs: 2021-03-20 00:00:00"Y-m-d");
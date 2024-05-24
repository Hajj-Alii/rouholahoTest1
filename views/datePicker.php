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
<form method="get" action="datePickerProcess.php">

    <label>
        <input name="startDate" data-jdp>
    </label>
    <label>
        <input name="endDate" data-jdp>
    </label>
    <button type="submit" name="submit">ارسال</button>

</form>

<script>
    jalaliDatepicker.startWatch();
</script>
</body>


</html>


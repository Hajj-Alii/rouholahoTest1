<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width        =device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/persian-datepicker/dist/css/persian-datepicker.css">
    <script src="../node_modules/persian-datepicker/dist/js/persian-datepicker.js"></script>
    <script src="../node_modules/persian-date/dist/persian-date.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <title>Document</title>
</head>

<body>
<form id="jalaliDateRangeForm" action="#">
    <label for="start">Start date:</label>
    <input type="text" id="start" name="start">

    <label for="end">End date:</label>
    <input type="text" id="end" name="end">

    <input type="submit" value="Submit">
</form>

<script>


    $(document).ready(function () {
        // Initialize Persian Datepicker
        $('#start').persianDatepicker({
            format: 'YYYY/MM/DD'
        });
        $('#end').persianDatepicker({
            format: 'YYYY/MM/DD'
        });

        // Form submission validation
        $('#jalaliDateRangeForm').on('submit', function (event) {
            var startDate = $('#start').val();
            var endDate = $('#end').val();

            if (endDate < startDate) {
                event.preventDefault();
                alert('End date must be after start date.');
            }
        });
    });

</script>
</body>


</html>


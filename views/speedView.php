<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>
<body>
<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
$formattedRecords = array_map(function($value, $time) {
    return [
        'speed' => $value,
        'time' => $time->format('Y-m-d')
    ];
}, array_keys($records), $records);

$encodedRecords = json_encode($formattedRecords);
var_dump($encodedRecords);
?>

<div class="container-fluid">

    <div class="row">
        <!-- Chart Section -->
        <div class="col-md-12">
            <canvas id="speedChart" width="400" height="200"></canvas>
        </div>
    </div>

    <div class="row">
        <table class="table table-bordered table-striped" id="speedTable">
            <thead>
            <tr>
                <th scope="col">سرعت</th>
                <th scope="col">تاریخ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($records as $value => $time): ?>
                <tr>
                    <td><?php echo htmlspecialchars($value); ?></td>
                    <td><?php echo htmlspecialchars($time); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var formattedRecords = <?php echo $encodedRecords; ?>;
    var speedData = formattedRecords.map(function(item) {
        return {
            speed: item.speed,
            time: new Date(item.time)
        };
    });

    // Extract values and labels
    var speeds = speedData.map(item => item.speed);
    var dates = speedData.map(item => item.time);

    // Get canvas element
    var ctx = document.getElementById('speedChart').getContext('2d');

    // Initialize Chart.js chart
    var speedChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Speed',
                data: speeds,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>

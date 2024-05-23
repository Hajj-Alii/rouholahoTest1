<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/indexStyle.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>
<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/UserController.php";
session_start();
if(!UserController::isUserLoggedIn()){
    header("location: login.php");
    exit();
}
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";


?>

<body>
<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-lg-2 d-flex flex-column p-0 bg-dark text-light sidebar">
            <ul class="nav flex-column flex-lg-1">
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('speedView')">نمایش
                        سرعت</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('login')">تناژ
                        تولید</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('performance')">عملکرد
                        شیفت ها</a></li>
            </ul>
        </div>
        <div class="col-lg-9 content" id="content">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
    function showContent(page) {
        fetch(page + '.php')
            .then(response => response.text())
            .then(html => {
                document.getElementById('content').innerHTML = html;
                if (page === 'speedView') {
                    // If the loaded page is speedView.php, initialize the chart
                    initializeChart();
                }
            })
            .catch(error => console.error('Error loading content:', error));
    }

    function initializeChart() {
        fetch('getSpeedJSON.php')
            .then(response => response.json())
            .then(data => {
                const values = data.map(record => record.speed);
                const times = data.map(record => record.time);

                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: times,
                        datasets: [{
                            label: 'Values over Time',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
</script>

</body>
</html>

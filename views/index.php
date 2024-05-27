<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/indexStyle.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/persian-datepicker/dist/css/persian-datepicker.css">
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/persian-datepicker/dist/js/persian-datepicker.js"></script>
    <script src="../node_modules/persian-date/dist/persian-date.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


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
                    // If the loaded page is speedView.php, initialize the chart and table
                    initializeDatePickers();
                    initializeForm();
                    fetchAndDisplayData(); // Fetch default data
                }
            })
            .catch(error => console.error('Error loading content:', error));
    }

    function initializeDatePickers() {
        $("#startDate, #endDate").pDatepicker({
            format: 'YYYY/MM/DD HH:mm:ss',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: false
                }
            }
        });
    }

    function initializeForm() {
        document.getElementById('dateRangeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            fetchAndDisplayData();
        });
    }

    function fetchAndDisplayData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch(`fetchSpeedRecords.php?startDate=${startDate}&endDate=${endDate}`)
            .then(response => response.json())
            .then(data => {
                updateChart(data);
                updateTable(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateChart(data) {
        const ctx = document.getElementById('myChart').getContext('2d');

        // Check if a chart instance already exists
        if (window.myChart instanceof Chart) {
            window.myChart.destroy(); // Destroy the existing chart
        }

        const values = data.map(record => record.value);
        const times = data.map(record => record.time);

        // Create new Chart instance
        window.myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: times,
                datasets: [{
                    label: 'Speed over Time',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
    }

    function updateTable(data) {
        const tableBody = document.getElementById('speedTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = ''; // Clear existing rows

        data.forEach(record => {
            const row = tableBody.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            cell1.textContent = record.value !== null ? record.value : 'Silent';
            cell2.textContent = record.time;
        });
    }

    function exportData() {
        const table = document.getElementById('speedTable');
        const rows = Array.from(table.getElementsByTagName('tr'));

        // Custom headers
        const headers = ['سرعت', 'تاریخ'];

        // Prepare data
        const data = [headers];
        rows.slice(1).forEach(row => {
            const cells = Array.from(row.getElementsByTagName('td')).map(td => td.innerText);
            data.push(cells);
        });

        // Create a new workbook and a worksheet
        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'SpeedRecords');

        // Write the workbook to a file
        XLSX.writeFile(wb, 'speed_records.xlsx');
    }

    // Initialize the content on page load
    document.addEventListener('DOMContentLoaded', () => {
        showContent('speedView');
    });
</script>


</body>
</html>

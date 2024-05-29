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
<body>
<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/UserController.php";
session_start();
if(!UserController::isUserLoggedIn()){
    header("location: login.php");
    exit();
}
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
?>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-lg-2 d-flex flex-column p-0 bg-dark text-light sidebar">
            <ul class="nav flex-column flex-lg-1">
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('speedView')">نمایش سرعت</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('productionTonnage')">تناژ تولید</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('performance')">عملکرد شیفت ها</a></li>
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
                    initializeDatePickers();
                    initializeSpeedViewForm();
                    fetchAndDisplaySpeedData();
                } else if (page === 'productionTonnage') {
                    initializeDatePickers();
                    initializeProductionTonnageForm();
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

    function initializeSpeedViewForm() {
        document.getElementById('dateRangeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            fetchAndDisplaySpeedData();
        });
    }

    function fetchAndDisplaySpeedData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch(`fetchSpeedRecords.php?startDate=${startDate}&endDate=${endDate}`)
            .then(response => response.json())
            .then(data => {
                // console.log(data); // Debugging: Check the fetched data
                updateSpeedChart(data);
                updateSpeedTable(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateSpeedChart(data) {
        const ctx = document.getElementById('myChart').getContext('2d');

        if (window.myChart instanceof Chart) {
            window.myChart.destroy();
        }

        const values = data.map(record => record.value);
        const times = data.map(record => record.time);

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

    function updateSpeedTable(data) {
        const tableBody = document.getElementById('speedTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        data.forEach(record => {
            const row = tableBody.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            cell1.textContent = record.value !== null ? record.value : 'Silent';
            cell2.textContent = record.time;
        });
    }

    function exportSpeedData() {
        const table = document.getElementById('speedTable');
        const rows = Array.from(table.getElementsByTagName('tr'));

        const headers = ['سرعت', 'تاریخ'];
        const data = [headers];
        rows.slice(1).forEach(row => {
            const cells = Array.from(row.getElementsByTagName('td')).map(td => td.innerText);
            data.push(cells);
        });

        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'SpeedRecords');
        XLSX.writeFile(wb, 'speed_records.xlsx');
    }

    function initializeProductionTonnageForm() {
        document.getElementById('dateRangeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            fetchAndDisplayTonnageData();
        });
    }

    function fetchAndDisplayTonnageData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch(`fetchParamRecords.php?startDate=${startDate}&endDate=${endDate}`)
            .then(response => response.json())
            .then(data => {

                console.log(data);
                updateTonnageTable(data);
                showTonnageInputForm(data.length === 0);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateTonnageTable(data) {
        const tableBody = document.getElementById('tonnageTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        data.forEach(record => {
            // console.log(record);
            const row = tableBody.insertRow();
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            cell1.textContent = record.time;
            cell2.textContent = record.speed;
            cell3.textContent = record.width;
            cell4.textContent = record.grammage;
        });
    }

    function showTonnageInputForm(show) {
        document.getElementById('tonnageInputForm').style.display = show ? 'block' : 'none';
    }

    function submitTonnageParams() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const width = document.getElementById('width').value;
        const grammage = document.getElementById('grammage').value;

        // console.log({ startDate, endDate, width, grammage }); // Log the data being sent

        fetch('insertTonnageParams.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ startDate, endDate, width, grammage })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the response from the server
                if (data.error) {
                    alert('Error: ' + data.error);
                } else {
                    alert(data.message);
                    fetchAndDisplayTonnageData();
                }
            })
            .catch(error => console.error('Error inserting data:', error));
    }


</script>
</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/styles/indexStyle.css">

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
if (!UserController::isUserLoggedIn()) {
    header("location: login.php");
    exit();
}
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
?>

<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-lg-2 d-flex flex-column p-0 bg-dark text-light sidebar">
            <ul class="nav flex-column flex-lg-1">
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('speedView')">نمایش
                        سرعت</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#"
                                        onclick="showContent('productionTonnage')">تناژ تولید</a></li>
                <li class="nav-item"><a class="nav-link custom-link" href="#" onclick="showContent('shiftsPerformance')">عملکرد
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
                    initializeDatePickers();
                    initializeSpeedViewForm();
                    loadSpeedViewState();  // Load saved state if available
                } else if (page === 'productionTonnage') {
                    initializeDatePickers();
                    initializeProductionTonnageForm();
                    loadProductionTonnageState();  // Load saved state if available
                } else if (page === 'shiftsPerformance') {
                    initializeDatePickers();
                    initializeShiftPerformanceForm();
                    loadShiftPerformanceState();  // Load saved state if available
                }

            })
            .catch(error => console.error('Error loading content:', error));
    }


    // Save state to localStorage
    function saveSpeedViewState(startDate, endDate, data) {
        localStorage.setItem('speedViewState', JSON.stringify({ startDate, endDate, data}));
    }

    function saveProductionTonnageState(startDate, endDate) {
        localStorage.setItem('productionTonnageState', JSON.stringify({ startDate, endDate}));
    }

    function saveShiftPerformanceState(startDate, endDate, shift) {
        localStorage.setItem('shiftPerformanceState', JSON.stringify({ startDate, endDate, shift}));
    }

    // Load state from localStorage
    function loadSpeedViewState() {
        const state = JSON.parse(localStorage.getItem('speedViewState'));
        if (state) {
            document.getElementById('startDate').value = state.startDate;
            document.getElementById('endDate').value = state.endDate;
            displaySpeedData(state.data);
        }
    }

    function displaySpeedData(data) {
        updateSpeedChart(data);
        updateSpeedTable(data);
    }

    function loadProductionTonnageState() {
        const state = JSON.parse(localStorage.getItem('productionTonnageState'));
        if (state) {
            document.getElementById('startDate').value = state.startDate;
            document.getElementById('endDate').value = state.endDate;
            // updateTonnageTable(state.data);
        }
    }

    function loadShiftPerformanceState() {
        const state = JSON.parse(localStorage.getItem('shiftPerformanceState'));
        if (state) {
            document.getElementById('startDate').value = state.startDate;
            document.getElementById('endDate').value = state.endDate;
            document.getElementById('shift').value = state.shift;
            // displayShiftPerformanceResult(state.data);
        }
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
    function initializeShiftPerformanceForm() {
        document.getElementById('shiftPerformanceForm').addEventListener('submit', function (event) {
            event.preventDefault();
            fetchAndDisplayShiftPerformanceData();
        });
    }

    // function fetchAndDisplayShiftPerformanceData() {
    //     const startDate = document.getElementById('startDate').value;
    //     const endDate = document.getElementById('endDate').value;
    //     const shift = document.getElementById('shift').value;
    //
    //     fetch(`fetchShiftPerformance.php?startDate=${startDate}&endDate=${endDate}&shift=${shift}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             displayShiftPerformanceResult(data);
    //         })
    //         .catch(error => console.error('Error fetching shift performance data:', error));
    // }

    function displayShiftPerformanceResult(data) {
        const resultDiv = document.getElementById('shiftPerformanceResult');
        if (data.error) {
            resultDiv.innerHTML = `<p class="text-danger">${data.error}</p>`;
        } else {
            const activeMinutes = data.shiftActive || 0; // Ensure default to 0 if undefined or null
            const silentMinutes = data.shiftSilent || 0; // Ensure default to 0 if undefined or null
            const totalTonnage = data.shiftParams || 0; // Ensure default to 0 if undefined or null

            resultDiv.innerHTML = `
            <p>دقیقه فعال: ${activeMinutes}</p>
            <p>دقیقه خاموش: ${silentMinutes}</p>
            <p>تناژ کل: ${totalTonnage}</p>
        `;
        }
    }

    function initializeSpeedViewForm() {
        document.getElementById('dateRangeForm').addEventListener('submit', function (event) {
            event.preventDefault();
            fetchAndDisplaySpeedData();
        });
    }

    // function fetchAndDisplaySpeedData() {
    //     const startDate = document.getElementById('startDate').value;
    //     const endDate = document.getElementById('endDate').value;
    //
    //     fetch(`fetchSpeedRecords.php?startDate=${startDate}&endDate=${endDate}`)
    //         .then(response => response.json())
    //         .then(data => {
    //             updateSpeedChart(data);
    //             updateSpeedTable(data);
    //             saveSpeedViewState(startDate, endDate, data);  // Save state
    //         })
    //         .catch(error => console.error('Error fetching data:', error));
    // }
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
            const cell3 = row.insertCell(2);
            cell1.textContent = record.value !== null ? record.value : 'Silent';
            cell2.textContent = record.time;
            cell3.textContent = record.shift;
        });
    }

    function exportSpeedData() {
        const table = document.getElementById('speedTable');
        const rows = Array.from(table.getElementsByTagName('tr'));

        const headers = ['سرعت', 'تاریخ', 'شیفت'];
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
        document.getElementById('dateRangeForm').addEventListener('submit', function (event) {
            event.preventDefault();
            fetchAndDisplayTonnageData();
            // fetchAndDisplayTotalTonnage();

        });
    }

    function fetchAndDisplaySpeedData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch(`fetchSpeedRecords.php?startDate=${startDate}&endDate=${endDate}`)
            .then(response => response.json())
            .then(data => {
                updateSpeedChart(data);
                updateSpeedTable(data);
                saveSpeedViewState(startDate, endDate, data);  // Save state
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function fetchAndDisplayTonnageData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        fetch(`fetchParamRecords.php?startDate=${startDate}&endDate=${endDate}`)
            .then(response => response.json())
            .then(data => {
                if (data.params.length === 0) {
                    // If no records found, show text boxes if speed records exist
                    if (data.hasSpeedRecords) {
                        showTonnageInputForm(true);
                    } else {
                        showTonnageInputForm(false);
                        alert('هیچ رکورد سرعتی برای بازه زمانی داده شده یافت نشد!');
                    }
                } else {
                    // If records found, update table and hide text boxes
                    updateTonnageTable(data.params);
                    saveProductionTonnageState(startDate, endDate, data.params);  // Save state
                    showTonnageInputForm(false);
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function showTonnageInputForm(show) {
        const form = document.getElementById('tonnageInputForm');
        if (show) {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }


    function fetchAndDisplayShiftPerformanceData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const shift = document.getElementById('shift').value;

        fetch(`fetchShiftPerformance.php?startDate=${startDate}&endDate=${endDate}&shift=${shift}`)
            .then(response => response.json())
            .then(data => {
                displayShiftPerformanceResult(data);
                saveShiftPerformanceState(startDate, endDate, shift, data);  // Save state
            })
            .catch(error => console.error('Error fetching shift performance data:', error));
    }

    function updateTonnageTable(data) {
        const tableBody = document.getElementById('tonnageTable').getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        if (data ) {
            data.forEach(record => {
                const row = tableBody.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);
                const cell4 = row.insertCell(3);
                const cell5 = row.insertCell(4);
                cell1.textContent = record.time;
                cell2.textContent = record.speed;
                cell3.textContent = record.width;
                cell4.textContent = record.grammage;
                cell5.textContent = record.tonnage;
            });
        } else {
            console.error('Invalid data format:', data);
        }
    }


    // function showTonnageInputForm(show) {
    //     document.getElementById('tonnageInputForm').style.display = show ? 'block' : 'none';
    // }


    function submitTonnageParams() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const width = document.getElementById('width').value;
        const grammage = document.getElementById('grammage').value;
        // Validate inputs
        if (!startDate || !endDate || !width || !grammage) {
            alert('Please fill out all fields.');
            return;
        }

        fetch('insertTonnageParams.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({startDate, endDate, width, grammage})
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

    // function fetchAndDisplayTotalTonnage() {
    //     const startDate = document.getElementById('startDate').value;
    //     const endDate = document.getElementById('endDate').value;
    //
    //     // Send start and end date/time to backend
    //     fetch('calculateTotalTonnage.php', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({ startDate, endDate })
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             document.getElementById('totalTonnageLabel').textContent = 'Total Tonnage: ' + data.totalTonnage;
    //             updateTonnageTable(data.records);
    //             showTonnageInputForm(data.records.length === 0);
    //         })
    //         .catch(error => console.error('Error fetching data:', error));
    // }

    function exportTonnageData() {
        const table = document.getElementById('tonnageTable');
        const rows = Array.from(table.getElementsByTagName('tr'));

        const headers = ['تاریخ', 'سرعت', 'عرض', 'گرماژ', 'تناژ'];
        const data = [headers];
        rows.forEach(row => {
            const cells = Array.from(row.getElementsByTagName('td')).map(td => td.innerText);
            data.push(cells);
        });

        const ws = XLSX.utils.aoa_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'TonnageRecords');
        XLSX.writeFile(wb, 'tonnage_records.xlsx');
    }

</script>
</body>
</html>

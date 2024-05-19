<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body class="container-fluid">
<?php
require $_SERVER["DOCUMENT_ROOT"]."/www/rouholahoTest1/controllers/SpeedController.php";

    $ctrl = new SpeedController();
    $records = $ctrl::readAll();


?>

<table class= "table table-bordered table-striped">
    <thead>
    <tr>
        <th scope="col">سرعت</th>
        <th  scope="col">تاریخ</th>
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
<!--<script>-->
<!--    document.getElementById('updateButton').addEventListener('click', function() {-->
<!--        fetch('updateSpeed.php')-->
<!--            .then(response => response.json())-->
<!--            .then(data => {-->
<!--                // Get the table body element-->
<!--                const tbody = document.querySelector('#speedTable tbody');-->
<!---->
<!--                // Clear the current table content-->
<!--                tbody.innerHTML = '';-->
<!---->
<!--                // Populate the table with new data-->
<!--                data.forEach(record => {-->
<!--                    const row = document.createElement('tr');-->
<!--                    const valueCell = document.createElement('td');-->
<!--                    const dateCell = document.createElement('td');-->
<!---->
<!--                    valueCell.textContent = record.value;-->
<!--                    dateCell.textContent = record.date;-->
<!---->
<!--                    row.appendChild(valueCell);-->
<!--                    row.appendChild(dateCell);-->
<!---->
<!--                    tbody.appendChild(row);-->
<!--                });-->
<!--            })-->
<!--            .catch(error => console.error('Error fetching data:', error));-->
<!--    });-->
<!--</script>-->
</body>
</html>




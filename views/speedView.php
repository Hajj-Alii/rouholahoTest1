
<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
?>
<body>



<div class="container   ">

    <div class="row">
        <!-- Chart Section -->
        <div class="col-md-12">
            <canvas id="myChart" width="400" height="200"></canvas>
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

    <div class="row">
        <div >

        </div>

    </div>

</div>
</body>
<script>
    // console.log(encodedRecords)

</script>
</html>
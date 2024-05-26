<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
var_dump($records);
?>


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
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?php echo htmlspecialchars($record['value']); ?></td>
                    <td><?php echo htmlspecialchars($record['time']); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div>

        </div>

    </div>

</div>
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

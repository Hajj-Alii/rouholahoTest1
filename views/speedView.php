<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
?>


<div class="container">
    <div>
        <div class="row">
            <div class="col-md-12">
                <form method="get" action="" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="startDate" class="sr-only">تاریخ شروع</label>
                        <input type="text" id="startDate" name="startDate" data-jdp class="form-control" >
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="endDate" class="sr-only">تاریخ پایان</label>
                        <input type="text" id="endDate" name="endDate" data-jdp class="form-control" >
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-2">ارسال</button>
                </form>
            </div>
        </div>
    </div>
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

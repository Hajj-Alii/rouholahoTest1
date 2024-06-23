<?php

require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";

$ctrl = new SpeedController();
$records = $ctrl::readAll();
?>
<div class="container">
    <div>
        <div>
            <h2>نمایش سرعت</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form id="dateRangeForm" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="startDate">تاریخ شروع:</label>
                        <input type="text" id="startDate" name="startDate" data-jdp class="form-control">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="endDate">تاریخ پایان:</label>
                        <input type="text" id="endDate" name="endDate" data-jdp class="form-control">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="shift">شیفت:</label>
                        <select class="form-control" id="shift" name="shift">
                            <option value="all">همه</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mb-2">نمایش</button>
                    <button type="button" name="export" class="btn btn-secondary mb-2" onclick="exportSpeedData()">ذخیره</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <canvas id="myChart" width="400" height="200"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="shiftPerformanceResult">
            <!-- This div will show the shift performance result -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped" id="speedTable">
                <thead>
                <tr>
                    <th scope="col">سرعت</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">شیفت</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($record['value']); ?></td>
                        <td><?php echo htmlspecialchars($record['time']); ?></td>
                        <td><?php echo htmlspecialchars($record['shift']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
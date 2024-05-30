<?php
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/SpeedController.php";
require $_SERVER["DOCUMENT_ROOT"] . "/www/rouholahoTest1/controllers/ParamsController.php";
?>
<div class="container">
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
                <button type="submit" class="btn btn-primary mb-2">بررسی</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped" id="tonnageTable">
                <thead>
                <tr>
                    <th>تاریخ</th>
                    <th>سرعت</th>
                    <th>عرض</th>
                    <th>گرماژ</th>
                    <th>تناژ</th>
                </tr>
                </thead>
                <tbody>
                <!-- Records will be populated here -->
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" id="tonnageInputForm" style="display: none;">
        <div class="col-md-12">
            <div class="form-group">
                <label for="width">عرض:</label>
                <input type="text" id="width" name="width" class="form-control">
            </div>
            <div class="form-group">
                <label for="grammage">گرماژ:</label>
                <input type="text" id="grammage" name="grammage" class="form-control">
            </div>
            <button type="button" onclick="submitTonnageParams()" class="btn btn-secondary mb-2">ذخیره</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label id="totalTonnageLabel"></label>
        </div>
    </div>
</div>
</div>

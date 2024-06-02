<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form id="shiftPerformanceForm">
                <div class="form-row">
                    <div class="form-group col-md-4 mb-2">
                        <label for="startDate">تاریخ شروع:</label>
                        <input type="text" class="form-control" id="startDate" name="startDate" placeholder="تاریخ شروع">
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label for="endDate">تاریخ پایان:</label>
                        <input type="text" class="form-control" id="endDate" name="endDate" placeholder="تاریخ پایان">
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label for="shift">شیفت:</label>
                        <select class="form-control" id="shift" name="shift">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary btn-primary">نمایش</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="shiftPerformanceResult"></div>
            <p id="shiftPerformanceCalculations"></p>
        </div>
    </div>
</div>

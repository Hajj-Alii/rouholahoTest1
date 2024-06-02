<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form id="shiftPerformanceForm" class="form-inline">
                <div class="form-group mb-2">
                    <label for="startDate">تاریخ شروع:</label>
                    <input type="text" class="form-control form-control mx-2" id="startDate" name="startDate" placeholder="تاریخ شروع">
                </div>
                <div class="form-group mb-2">
                    <label for="endDate" class="">تاریخ پایان:</label>
                    <input type="text" class="form-control form-control mx-2" id="endDate" name="endDate" placeholder="تاریخ پایان">
                </div>
                <div class="form-group mb-2">
                    <label for="shift" class="">شیفت:</label>
                    <select class="form-control form-control mx-2" id="shift" name="shift">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm mb-2">نمایش</button>
            </form>

        </div>



    </div>

    <div id="shiftPerformanceResult"></div>
    <p id="shiftPerformanceCalculations"></p>
</div>

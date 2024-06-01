<div class="container">
    <h2>عملکرد شیفت ها</h2>
    <form id="shiftPerformanceForm">
        <div class="form-group">
            <label for="startDate">تاریخ شروع:</label>
            <input type="text" class="form-control" id="startDate" name="startDate">
        </div>
        <div class="form-group">
            <label for="endDate">تاریخ پایان:</label>
            <input type="text" class="form-control" id="endDate" name="endDate">
        </div>
        <div class="form-group">
            <label for="shift">شیفت:</label>
            <select class="form-control" id="shift" name="shift">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">ارسال</button>
    </form>
    <div id="shiftPerformanceResult"></div>
    <p id="shiftPerformanceCalculations"></p>
</div>

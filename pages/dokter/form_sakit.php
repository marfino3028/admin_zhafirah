<div class="row" id="formSakit" style="display: none;">
    <div class="col-md-6">
        <div class="form-group">
            <label for="istirahat_mulai_tanggal">Istirahat Mulai Tanggal*</label>
            <input type="date" class="form-control" id="istirahat_mulai_tanggal" name="istirahat_mulai_tanggal">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="istirahat_sampai_tanggal">Istirahat Sampai Tanggal*</label>
            <input type="date" class="form-control" id="istirahat_sampai_tanggal" name="istirahat_sampai_tanggal">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="istirahat_selama">Lamanya Hari*</label>
            <input type="text" class="form-control" id="istirahat_selama" name="istirahat_selama">
        </div>
    </div>
</div>

<script>
    document.getElementById('istirahat_mulai_tanggal').addEventListener('change', calculateDays);
    document.getElementById('istirahat_sampai_tanggal').addEventListener('change', calculateDays);

    function calculateDays() {
        var startDate = document.getElementById('istirahat_mulai_tanggal').value;
        var endDate = document.getElementById('istirahat_sampai_tanggal').value;

        if (startDate && endDate) {
            var start = new Date(startDate);
            var end = new Date(endDate);
            var timeDiff = end - start;
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; // Including the start date
            document.getElementById('istirahat_selama').value = daysDiff;
        } else {
            document.getElementById('istirahat_selama').value = '';
        }
    }
</script>
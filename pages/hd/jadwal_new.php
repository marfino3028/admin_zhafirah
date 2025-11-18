<div class="box box" style="margin-left: 10px; margin-right: 10px;">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-bordered">
				<div class="box-title">
					<h3>
						<i class="fa fa-edit"></i>Jadwal Hemodialisa (HD)</h3>
				</div>
				<div class="box-content nopadding">
                    <form action="pages/hd/jadwal_insert.php" method="POST" class='form-horizontal form-bordered'>
						<div class="form-group">
							<label for="textfield" class="control-label col-sm-2" style="text-align: right;">Frekuensi HD</label>
							<div class="col-sm-2">
        						<select id="tahun" name="tahun" class='form-control' required="required">
        							<option value="">--Pilih Tahun--</option>
        								<option value="2024">2024</option>
        								<option value="2025">2025</option>
        						</select>
							</div>
							<div class="col-sm-4">
        						<select id="waktu" name="waktu" class='form-control' required="required">
        							<option value="">--Pilih Frekuensi HD--</option>
        								<option value="1">1 Minggu Sekali</option>
        								<option value="2">2 Minggu Sekali</option>
        								<option value="3">3 Minggu Sekali</option>
        								<option value="4">4 Minggu Sekali</option>
        						</select>
							</div>
							<label for="textfield" class="control-label col-sm-1" style="text-align: right;">Mulai</label>
							<div class="col-sm-2">
        						<input type="date" id="tgl_mulai" name="tgl_mulai" class='form-control' value="<?php echo date("Y-m-d")?>">
							</div>
						</div>
						<div class="form-group" id="lainnya">
							<label for="textfield" class="control-label col-sm-2" style="text-align: right;">Pilih hari</label>
							<div class="col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox0" onclick="masalah()" value="1">Hari Senin
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox1" onclick="masalah()" value="2">Hari Selasa
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox2" onclick="masalah()" value="3">Hari Rabu
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox3" onclick="masalah()" value="4">Hari Kamis
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox4" onclick="masalah()" value="5">Hari Jumat
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox5" onclick="masalah()" value="6">Hari Sabtu
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkbox6" onclick="masalah()" value="7">Hari Minggu
									</label>
								</div>
							</div>
						</div>
                		<div class="form-actions col-sm-offset-2 col-sm-10" id="sederhana" name="sederhana">
                		    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                            <input type="submit" class="btn btn-success" name="simpan" value="Submit/Kirim Data">
                		</div>
                	</form>	
                </div>
            </div>
        </div>
    </div>
</div>
						
<script language="Javascript">
        function checkAll() {
 
            let inputs = document.querySelectorAll('.check3');
 
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].checked = false;
            }
        }
        
	function masalah() {
	    var waktu = document.getElementById("waktu").value;
	    var total = document.querySelectorAll('input[type="checkbox"]:checked').length;
	    
	    if (waktu < total) {
	        alert("Hari yang Anda Pilih melebihi Frekwensi yang yang dipilih sebelumnya");
	        document.querySelectorAll('input[type="checkbox"]:checked').checked = false;
            let inputs = document.querySelectorAll('input[type="checkbox"]:checked');
 
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].checked = false;
            }
	    }
	}	
</script>

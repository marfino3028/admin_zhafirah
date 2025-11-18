<?php
  date_default_timezone_set("Asia/Jakarta");
  include "../../3rdparty/engine.php";
  //print_r($_POST);
  //print_r(date("Y-m-d H:i:s N"));
  if ($_POST['tanggal'] == "") $_POST['tanggal'] = date("Y-m-d");
  
  if ($_POST['id'] != "") {
?>
<div>
    <select id="kd_dokter" name="kd_dokter" size="1" class="form-control" onchange="oncall_dokter(this.value)">
        <option value="">--Pilih Dokter--</option>
        <?php
          $poli = $db->query("select * from tbl_jadwal where hari='".date("N", strtotime($_POST['tanggal']))."' and kd_poli='".$_POST['id']."'");
          for ($i = 0; $i < count($poli); $i++) {
              if ($poli[$i]['janji'] == "*Dengan Perjanjian") {
                echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].' ('.$poli[$i]['janji'].')</option>';
              }
              else {
                echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].' ('.$poli[$i]['mulai'].' s/d '.$poli[$i]['selesai'].')</option>';
              }
          }
        ?>
        <option value="ONCALL">Dokter ON CALL</option>
    </select>
</div>

<?php
  if ($_POST['id'] == 'RI01') {
?>
<div>
	<div style="margin-bottom: 4px; margin-top: 4px;">
      <select id="kelas" name="kelas" size="1" class="form-control" onchange="pilihKelas(this.value)">
          <option value="">--Pilih Kelas Kamar--</option>
          <?php
    		$data = $db->query("select id, kode, nama from tbl_kelas");
    		for ($i = 0; $i < count($data); $i++) {
            	echo '<option value="'.$data[$i]['id'].'">'.$data[$i]['nama'].'</option>'; 
            }
    	  ?>
      </select>
	</div>
  	<div id="KelasInap" style="margin-bottom: 4px; margin-top: 4px;"></div>
  	<div id="KelasInapBed" style="margin-bottom: 4px; margin-top: 4px;"></div>
</div>
<?php
  }
  }
?>

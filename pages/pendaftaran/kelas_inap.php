<?php
  include "../../3rdparty/engine.php";
  //print_r($_POST);
  //if ($_POST['id'] == 'RI01') {
?>
<div>
	<div style="margin-bottom: 4px; margin-top: 4px;">
      <select id="ruangan" name="ruangan" size="1" class="form-control" onchange="pilihRuangan(this.value)" required="required">
          <option value="">--Pilih Ruangan Kelas--</option>
          <?php
    		$data = $db->query("select id, nama from tbl_kelas_ruang where kelas_id='".$_POST['id']."'");
    		for ($i = 0; $i < count($data); $i++) {
            	echo '<option value="'.$data[$i]['id'].'">'.$data[$i]['nama'].'</option>'; 
            }
    	  ?>
      </select>
	</div>
</div>
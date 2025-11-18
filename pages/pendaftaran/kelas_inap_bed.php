<?php
  include "../../3rdparty/engine.php";
  //print_r($_POST);
  //if ($_POST['id'] == 'RI01') {
?>
<div>
	<div style="margin-bottom: 4px; margin-top: 4px;">
      <select id="kasur" name="kasur" size="1" class="form-control" required="required">
          <option value="">--Pilih Bed--</option>
          <?php
    		$data = $db->query("select id, nama from tbl_kelas_ruang_bed where kelas_ruang_id='".$_POST['id']."'");
    		for ($i = 0; $i < count($data); $i++) {
            	echo '<option value="'.$data[$i]['id'].'">'.$data[$i]['nama'].'</option>'; 
            }
    	  ?>
      </select>
	</div>
</div>
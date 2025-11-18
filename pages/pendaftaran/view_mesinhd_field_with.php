<?php
	//print_r($_POST);
	include "../../3rdparty/engine.php";	
	//print_r($_POST);
	if ($_POST['kd_poli'] == 'HE01') {

	$prsh = $db->query("select * from tbl_mesinHD where id not in (select mesinHD_id from tbl_perjanjian where status_pasien='OPEN' and tgl_daftar='".$_POST['tanggal']."' and shift='".$_POST['id']."')");
	//$sub = $db->query("");
?>
        <select id="mesin_hd" name="mesin_hd" size="1" class="form-control" required="required">
            <option value="">Pilih Mesin HD</option>
            <?php
				for ($i = 0; $i < count($prsh); $i++) {
					echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['merk_mesin'].'</option>';
				}
            ?>
        </select>
<?php
	}
?>

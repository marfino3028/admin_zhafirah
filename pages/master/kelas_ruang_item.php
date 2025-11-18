<?php
	session_start();
	include "../../3rdparty/engine.php";
	$layanan = $db->query("select * from tbl_kelas_ruang where kelas_id='".$_POST['id']."'");
	if (count($layanan) > 0) {
		$disb = '';
		$dtext = '--Pilih Kelas--';
	}
	else {
		$disb = ' disabled="disabled"';
		$dtext = '--Belum ada Sub Kategori--';
	}
?>

<select id="kelas_ruang" name="kelas_ruang" size="1"<?php echo $disb?> class="form-control" required="required">
	<option value=""><?php echo $dtext?></option>
	<?php
		for ($i = 0; $i < count($layanan); $i++) {
			echo '<option value="'.$layanan[$i]['id'].'">'.$layanan[$i]['nama'].'</option>';
		}
	?>
</select>

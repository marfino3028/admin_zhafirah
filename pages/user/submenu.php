<?php
	session_start();
	include "../../3rdparty/engine.php";
	$layanan = $db->query("select id as kode, nm_ka_menu as nama from tbl_kat_sub_menu where status_delete='UD' and kategori_id='".$_POST['id']."'");
	if (count($layanan) > 0) {
		$disb = '';
		$dtext = '--Pilih Sub Kategori--';
	}
	else {
		$disb = ' disabled="disabled"';
		$dtext = '--Belum ada Sub Kategori--';
	}
?>

<select id="subkategoriID" name="subkategoriID" size="1"<?php echo $disb?> class="form-control">
	<option value=""><?php echo $dtext?></option>
	<?php
		for ($i = 0; $i < count($layanan); $i++) {
			echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['nama'].'</option>';
		}
	?>
</select>

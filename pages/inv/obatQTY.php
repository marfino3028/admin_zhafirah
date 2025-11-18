<?php
	date_default_timezone_set("Asia/Bangkok");
	include "../../3rdparty/engine.php";
	$data = $db->query("select * from tbl_obat where kode_obat='".$_POST['kode']."'", 0);
	$tgl = date('Y-m-d');
	
	$tgl11 = date('Y-m-01', strtotime($tgl.' - 1 month'));
	$tgl12 = date('Y-m-01', strtotime($tgl.' - 0 month'));

	$tgl21 = date('Y-m-01', strtotime($tgl.' - 2 month'));
	$tgl22 = date('Y-m-01', strtotime($tgl.' - 1 month'));

	$tgl31 = date('Y-m-01', strtotime($tgl.' - 3 month'));
	$tgl32 = date('Y-m-01', strtotime($tgl.' - 2 month'));
	
	$bln1 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl11' and a.tgl_input < '$tgl12' and b.kode_obat='".$_POST['kode']."'", 0);
	$bln2 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl21' and a.tgl_input < '$tgl22' and b.kode_obat='".$_POST['kode']."'", 0);
	$bln3 = $db->queryItem("select sum(qty) from tbl_resep a left join tbl_resep_detail b on b.resep_id=a.id where a.tgl_input >= '$tgl31' and a.tgl_input < '$tgl32' and b.kode_obat='".$_POST['kode']."'", 0);
	$total = $bln1 + $bln2 + $bln3;
	$rata = $total / 3;
	$qty = ($rata * 1.2) - $data[0]['stock_akhir'];
	
?>
<input type="text" name="qty" id="qty" size="5" value="<?php echo abs(ceil($qty))?>" class="form-control" tabindex="3" />
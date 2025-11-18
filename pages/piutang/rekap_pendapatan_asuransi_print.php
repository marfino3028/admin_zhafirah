<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>MH.THAMRIN HEALTH CARE | Radjak Group</title>
	<link href="style.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="../../js/jquery-1.3.2.js"></script>
	<script type="text/javascript" src="../../js/superfish.js"></script>
	<script type="text/javascript" src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="../../js/tooltip.js"></script>
	<script type="text/javascript" src="../../js/cookie.js"></script>
	<script type="text/javascript" src="../../js/custom.js"></script>
	<script type="text/javascript" src="../../js/utama.js"></script>
	<link href="../../style.css" rel="stylesheet" media="all" />

</head>
<body>

	<p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px; margin-top: 10px;">
		REKAPITULASI PENDAPATAN KASIR (ASURANSI)<br>
		PERIODE : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?>
	</p>

<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$t1 = explode("/", $_GET['d1']);
	$t2 = explode("/", $_GET['d2']);
	//Nilai Tutup Pendapatan Harian
	$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;
	//$data = $db->query("");
	$asuransi = $db->query("select a.nama_perusahaan, sum(b.bayar) as total_tagihan, a.no_kwitansi from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030' and a.nomr <> '' and b.payment_to='ASURANSI' group by a.no_kwitansi", 0);

?>
<div class="hastable box box-content nopadding" border="1" align="left" style="margin-left:10px; margin-right: 10px; margin-top: 20px; width: 98%">
	<table id="sort-table" border="0" style="border: #000000"> 
		<thead> 
			<tr style="font-weight: bold">
				<th style="text-align: center; font-size: 14px; width: 40px">NO</th>
				<th style="text-align: center; font-size: 14px; width: 150px;">NO KWITANSI</th> 
				<th style="text-align: center; font-size: 14px">NAMA ASURANSI</th> 
				<th style="text-align: center; width: 150px; font-size: 14px">TOTAL TAGIHAN</th> 
			</tr> 
		</thead>
		<tbody>
			<?php
				for ($i = 0; $i < count($asuransi); $i++) {
					$no = $i + 1;
			?>
			<tr style="font-weight: bold">
				<th style="text-align: center; font-size: 12px; width: 40px"><?php echo $no?></th>
				<th style="text-align: left; font-size: 12px"><?php echo $asuransi[$i]['no_kwitansi']?></th> 
				<th style="text-align: left; font-size: 12px"><?php echo $asuransi[$i]['nama_perusahaan']?></th> 
				<th style="text-align: right; width: 150px; font-size: 12px"><?php echo number_format($asuransi[$i]['total_tagihan'])?></th> 
			</tr> 
			<?php
				}
			?>
		</tbody>
	</table>
</div>
</body>
</html>
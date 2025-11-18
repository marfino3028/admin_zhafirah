<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Permintaan Obat</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	$noRO = $db->queryItem("select no_ro from tbl_po where no_po='".$_POST['id']."'");
	$ro = $db->query("select * from tbl_ro where no_ro='".$noRO."'", 0);
	$unit = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit'");
	$namaDokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
	$now = $ro[0]['tgl_input_ro'];
	$bln1 = date('F', strtotime($tgl.' - 1 month'));
	$bln2 = date('F', strtotime($tgl.' - 2 month'));
	$bln3 = date('F', strtotime($tgl.' - 3 month'));
?>
<div align="left" style="margin-left: 3%;">
	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Nomor PO : <?php echo $_POST['id']?><br />
		Nomor RO : <?php echo $ro[0]['no_ro']?><br />
		Tanggal Input : <?php echo date("d-m-Y", strtotime($ro[0]['tgl_input_ro']))?><br />
		Unit : <?php echo $ro[0]['unit']?><br />
	</p>
    <div>
        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
            <thead>
            <tr>
                <th style="text-align: center" rowspan="2">No</th>
                <th style="text-align: center" rowspan="2">Nama Obat</th>
                <th style="text-align: center" colspan="3">Bulan</th>
                <th style="text-align: center" rowspan="2">Saldo<br />Akhir</th>
                <th style="text-align: center" rowspan="2">Rata2</th>
                <th style="text-align: center" rowspan="2">Jumlah<br />Pesanan</th>
                <th style="text-align: center" rowspan="2">Harga<br />Obat</th>
                <th style="text-align: center" rowspan="2">Margin</th>
            </tr>
            <tr>
                <th style="text-align: center"><?php echo $bln3?></th>
                <th style="text-align: center"><?php echo $bln2?></th>
                <th style="text-align: center"><?php echo $bln1?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totgigi = 0;
            $adm = $db->query("select * from tbl_ro_detail where no_ro='".$ro[0]['no_ro']."' and status_delete='UD'");
            for ($i = 0; $i < count($adm); $i++) {
                $no = $i + 1;
                $total = $adm[$i]['qty'] * $adm[$i]['harga'];
                ?>
                <tr>
                    <td style="width: 15px; text-align: right"><?php echo $no?></td>
                    <td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['bln3'])?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['bln2'])?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['bln1'])?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['stok_akhir'])?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['rata'])?></td>
                    <td style="text-align: right">
                        <input type="text" id="qty[<?php echo $i?>]" name="qty[<?php echo $i?>]" value="<?php echo number_format($adm[$i]['qty_po'])?>"  class="form-control text-right" />
                        <input type="hidden" id="id[<?php echo $i?>]" name="id[<?php echo $i?>]" value="<?php echo $adm[$i]['id']?>" />
                        <input type="hidden" id="kd_obat[<?php echo $i?>]" name="kd_obat[<?php echo $i?>]" value="<?php echo $adm[$i]['kode_obat']?>" />
                    </td>
                    <td style="text-align: right">
                        <input type="text" id="harga[<?php echo $i?>]" name="harga[<?php echo $i?>]" value="<?php echo $adm[$i]['harga']?>" class="form-control text-right" />
                    </td>
                    <td style="text-align: right">
                        <input type="text" id="margin[<?php echo $i?>]" name="margin[<?php echo $i?>]" value="0" class="form-control text-right" />
                    </td>
                </tr>
                <?php
                $total1 = $total1 + $adm[$i]['qty'];
                $total2 = $total2 + $adm[$i]['harga'];
                $total3 = $total3 + $total;
            }
            ?>
            </tbody>
        </table>
        <p align="left" style="margin-left: 5px; font-weight: bold"><?php echo $namaDokter?></p>
    </div>
</div>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Transfer Obat dari Gudang ke Depo</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
	$ro = $db->query("select * from tbl_transfer where id='".$_GET['id']."'");
	$now = $ro[0]['tgl_input_transfer'];
	$bln1 = date('F', strtotime($tgl.' - 1 month'));
	$bln2 = date('F', strtotime($tgl.' - 2 month'));
	$bln3 = date('F', strtotime($tgl.' - 3 month'));
?>
<div align="left">
	<div>
        <p style="text-align: left; font-size: 14px; font-weight: bold; margin-bottom: 2px; margin-left: 12px;">
            <img src="../../images/billing_1.png" />
        </p>
        <p style="text-align: center; font-size: 14px; font-weight: bold; margin-bottom: 2px;">
            Transfer Obat dari Gudang ke Apotik
        </p>
        <p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
            Nomor Transfer : <?php echo $ro[0]['no_transfer']?><br />
            Nomor Request : <?php echo $ro[0]['no_ro_gudang']?><br />
            Tanggal Input : <?php echo date("d-m-Y", strtotime($ro[0]['tgl_input_transfer']))?><br />
        </p>
    </div>
    <div>
        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
            <thead>
            <tr>
                <th style="text-align: center">No</th>
                <th style="text-align: center">Kode Obat</th>
                <th style="text-align: center">Nama Obat</th>
                <th style="text-align: center">Expired Date (ED)</th>
                <th style="text-align: center">Jumlah Obat yang Ditransfer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totgigi = 0;
            $adm = $db->query("select * from tbl_transfer_detail where transferID='".$_GET['id']."' and status_delete='UD'");
            for ($i = 0; $i < count($adm); $i++) {
                $no = $i + 1;
                $total = $adm[$i]['qty'] * $adm[$i]['harga'];
		$ed = $db->query("select expire_date from tbl_obat where kode_obat='".$adm[$i]['kode_obat']."'");
		$adm[$i]['ed'] = $ed[0]['expire_date'];
                ?>
                <tr>
                    <td style="width: 15px; text-align: right"><?php echo $no?></td>
                    <td style="text-align: center"><?php echo $adm[$i]['kode_obat']?></td>
                    <td style="text-align: left"><?php echo $adm[$i]['nama_obat']?></td>
                    <td style="text-align: left"><?php echo date("d F Y", strtotime($adm[$i]['ed']))?></td>
                    <td style="text-align: right"><?php echo number_format($adm[$i]['qty'])?></td>
                </tr>
                <?php
                $total1 = $total1 + $adm[$i]['qty'];
            }
            ?>
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold; text-align: right">Grand Total</td>
                <td style="text-align: right; font-weight: bold"><?php echo number_format($total1)?></td>
            </tr>
            </tbody>
        </table>
        <p align="left" style="margin-left: 5px; font-weight: bold"><?php echo $namaDokter?></p>
    </div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<p align="center" style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				<b>Mengetahui</b>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">&nbsp;
				
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				KA.UNIT<br />
				Klinik Dialisacare<br /><br /><br /><br />
				
				
				...................
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				BAGIAN PHARMACY<br />
				Klinik Dialisacare<br /><br /><br /><br />
				
				
				<?php echo $ro[0]['input_by']?>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">&nbsp;
				
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				&nbsp;<br />
				Peminta<br /><br /><br /><br />
				
				
				...................
			</p>
		</td>
		<td>
			<p style="margin-left: 95px; margin-top: 2px; margin-bottom: 5px; padding: 5px;">
				&nbsp;<br />
				Penerima<br /><br /><br /><br />
				
				
				...................
			</p>
		</td>
	</tr>
</table>
</div>
</body>
</html>

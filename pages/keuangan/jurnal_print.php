<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Print Pendapatan Labn</title>
	<link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	$data = $db->query("select * from tbl_jurnal where md5(no_dokumen)='".$_GET['id']."' limit 1");
	
?>

	<p style="margin-left: 12px; margin-top: 20px; margin-bottom: 5px; font-size: 24px; font-weight: bold;">
		Detail Jurnal Entri
	</p>
	<div class="col-sm-5">
	   <div style="margin-left: 15px;">
		<address>
			<strong>Nomor Dokumen : <?php echo $data[0]['no_dokumen']?></strong>
			<br>Tanggal Dokumen : <?php echo date("d F Y", strtotime($data[0]['tanggal']))?></strong>
			<br>Status : <?php echo $data[0]['status']?>
			<br>Tipe Dokumen : <?php echo $data[0]['tipe_dokumen']?>
			<br>Petugas : <?php echo $data[0]['petugas']?>
		</address>
	    </div>
	</div>
	<div class="col-sm-7">
	   <div style="margin-left: 15px;">
		<address>
			Mata Uang : <?php echo $data[0]['mata_uang'].' (Rate : '.$data[0]['rate'].')'?>
			<br>Input Date : <?php echo date("d F Y H:i:s", strtotime($data[0]['tgl_insert']))?>
			<br><dl class='dl-horizontal' style="margin-left: -85px;"><dt>Keterangan :</dt> <dd><?php echo $data[0]['keterangan']?></dd></dl>
		</address>
	    </div>
	</div>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">GL Account</th>
                                            <th rowspan="2">Deskripsi</th>
                                            <th colspan="2">Amount Local</th>
                                            <th rowspan="2">Reg. Num#</th>
                                            <th rowspan="2">Cost Center</th>
                                        </tr>
                                        <tr>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
						$data = $db->query("select * from tbl_jurnal where md5(no_dokumen)='".$_GET['id']."'");
                                        	for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                            <tr>
                                                <td><?php echo $data[$i]['gl_kode'].' - '.$data[$i]['gl_nama']?></td>
                                                <td><?php echo $data[$i]['deskripsi']?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['debit'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['credit'])?></td>
                                                <td style="text-align: right;"><?php echo $data[$i]['reg_no']?></td>
                                                <td style="text-align: left;"><?php echo $data[$i]['cost_center_nama']?></td>
                                            </tr>
                                            <?php
							$debet = $debet + $data[$i]['debit'];
							$kredit = $kredit + $data[$i]['credit'];
						}
                                        ?>
                                        <tr>
                                            <th colspan="2" style="text-align: right;">Total</th>
                                            <th style="text-align: right;"><?php echo number_format($debet)?></th>
                                            <th style="text-align: right;"><?php echo number_format($kredit)?></th>
                                            <th colspan="2">&nbsp</th>
                                        </tr>
                                        </tbody>
                                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
</body>
</html>
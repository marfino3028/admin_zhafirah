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
	
?>

	<p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
		Laporan Hutang Karyawan<br />
		Periode : <?php echo $_GET['d1'].' s/d '.$_GET['d2']?><br />
	</p>

    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:20px">NO</th> 
							<th style="width:100px">Tgl Transaksi</th> 
							<th style="width:100px">Tgl Bayar</th> 
							<th>Nama Karyawan</th> 
							<th style="width:100px">Total Harga</th> 
							<th style="width:100px">Jml Pembayaran</th> 
							<th style="width:100px">Status</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							$t1 = explode("/", $_GET['d1']);
							$t2 = explode("/", $_GET['d2']);
							//Nilai Tutup Pendapatan Harian
							$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
							$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
							//$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
							$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;

							$data = $db->query("select * from tbl_polkar where tgl_input_polkar >= '$date1' and tgl_input_polkar < '$date2' and status_delete='UD'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
								$racikan = $db->queryItem("select sum(total) from tbl_polkar_detail where no_polkar='".$data[$i]['no_polkar']."' and racikan_id='1'");
								$data[$i]['total_harga_polkar'] = $data[$i]['total_harga_polkar'] + $racikan;
								if ($data[$i]['tgl_bayar'] == '0000-00-00') {
									$data[$i]['tgl_bayar'] = '<font color="red">Belum</font>';
									$data[$i]['total_bayar'] = 0;
								}
								else {
									$data[$i]['total_bayar'] = $data[$i]['total_harga_polkar'];
								}
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo $data[$i]['tgl_input_polkar']?></td> 
							<td><?php echo $data[$i]['tgl_bayar']?></td> 
							<td><?php echo $data[$i]['nama']?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['total_harga_polkar'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['total_bayar'])?></td> 
							<td style="text-align: right;"><?php echo $data[$i]['status_bayar']?></td> 
						</tr> 
						<?php
								$total_harga = $total_harga + $data[$i]['total_harga_polkar'];
								$total_bayar = $total_bayar + $data[$i]['total_bayar'];
							}
							
						?>
						<tr>
							<td colspan="4" style="text-align:right; font-weight: bold;">Total Hutang/Pendapatan Poli Karyawan</td>
							<td style="text-align: right; font-weight: bold;"><?php echo number_format($total_harga)?></td> 
							<td style="text-align: right; font-weight: bold;"><?php echo number_format($total_bayar)?></td> 
							<td>&nbsp;</td>
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
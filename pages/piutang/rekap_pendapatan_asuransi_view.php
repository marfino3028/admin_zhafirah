<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	$t1 = explode("/", $_POST['d1']);
	$t2 = explode("/", $_POST['d2']);
	//Nilai Tutup Pendapatan Harian
	$tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
	$date1 = $t1[2].'-'.$t1[0].'-'.$t1[1].' '.$tutup_waktu;
	$date2 = date("Y-m-d", mktime(0,0,0,$t2[0],$t2[1]+1,$t2[2])).' '.$tutup_waktu;
	//$data = $db->query("");
	$asuransi = $db->query("select a.nama_perusahaan, sum(b.bayar) as total_tagihan, a.no_kwitansi from tbl_kasir a left join tbl_kasir_detail b on b.no_kwitansi=a.no_kwitansi where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.kode_perusahaan <> 'PPP031' and a.kode_perusahaan <> 'JJJ030' and a.nomr <> '' and b.payment_to='ASURANSI' group by a.no_kwitansi", 0);

?>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
            <div class="box-title">
                <h3>
                    <i class="fa fa-table"></i>

                </h3>
                <a href="#" class="btn btn-sm btn-small btn-darkblue rounded pull-right" onclick="PrintPendapatan()"><span class="fa fa-print"></span>Print Rekapitulasi Pendapatan</a>
            </div>
            <div class="box-content nopadding" style="overflow-x:auto;">
            <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
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
        </div>
    </div>
</div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
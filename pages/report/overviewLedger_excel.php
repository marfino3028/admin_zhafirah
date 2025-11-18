<?php
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=OverviewLedget".date("YmdHis").".xls");

	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_POST)
?>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Kode GL</th>
                                            <th>Nama GL</th>
                                            <th>No. Dokumen</th>
                                            <th>Kode Cost Center</th>
                                            <th>Nama Cost Center</th>
                                            <th>Trnsaction type</th>
                                            <th>Debet</th>
                                            <th>Credit</th>
					    <?php
						if ($_GET['tipe1'] == "false" and $_GET['tipe2'] == "true") {
							echo '<th>Balance</th>';
						}
					    ?>
                                            <th>Description</th>
                                            <th>No. Register</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
						$sqlquery = "";
                                            	$data = $db->query("select no_dokumen, tanggal, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, status_jurnal, tipe_dokumen, cost_center_kode, cost_center_nama, deskripsi, reg_no from tbl_jurnal where tanggal >= '".$_GET['d1']."' and tanggal <= '".$_GET['d2']."' and gl_kode >= '".$_GET['coa1']."' and gl_kode <= '".$_GET['coa2']."' order by no_dokumen desc", 0);
						$no = 0;
                                        	for ($i = 0; $i < count($data); $i++) {
							$no = $no + 1;
                                        ?>
                                            <tr>
                                                <td align="center"><?php echo $no?></td>
                                                <td><?php echo date("d-M-Y", strtotime($data[$i]['tanggal']))?></td>
                                                <td><?php echo $data[$i]['gl_kode']?></td>
                                                <td><?php echo $data[$i]['gl_nama']?></td>
                                                <td><?php echo $data[$i]['no_dokumen']?></td>
                                                <td><?php echo $data[$i]['cost_center_kode']?></td>
                                                <td><?php echo $data[$i]['cost_center_nama']?></td>
                                                <td><?php echo $data[$i]['tipe_dokumen']?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['debit'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['credit'])?></td>
				   	        <?php
							if ($_GET['tipe1'] == "false" and $_GET['tipe2'] == "true") {
								if ($data[$i]['debit'] > 0 and $data[$i]['credit'] == 0) {
									$saldo = $saldo + $data[$i]['debit'];
								}
								else {
									$saldo = $saldo - $data[$i]['credit'];
								}
								echo '<td style="text-align: right;">'.number_format($saldo).'</td>';
							}
					        ?>
                                                <td><?php echo $data[$i]['deskripsi']?></td>
                                                <td><?php echo $data[$i]['reg_no']?></td>
                                            </tr>
                                            <?php
							$ttlDebit = $ttlDebit + $data[$i]['debit'];
							$ttlKredit = $ttlKredit + $data[$i]['credit'];
						}
                                        ?>
                                        </tbody>
					<tfoot>
					    <tr>
						<th colspan="8" style="text-align: right;">Total</th>
						<th><?php echo number_format($ttlDebit)?></th>
						<th style="text-align: right;"><?php echo number_format($ttlKredit)?></th>
						<?php if ($_POST['tipe1'] == "false" and $_POST['tipe2'] == "true") { ?>
						<th style="text-align: right;"><?php echo number_format($saldo)?></th>
						<?php } ?>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					    </tr>
					</tfoot>
                                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
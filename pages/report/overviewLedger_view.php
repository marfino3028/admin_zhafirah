<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	//print_r($_POST)
	//if ($_POST['tipe1'] == "false" and $_POST['tipe2'] == "true") $kolom_balance = 'YA';
	//else $kolom_balance = 'TIDAK';
?>
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>GL</th>
                                            <th>No. Dokumen</th>
                                            <th>Cost Center</th>
                                            <th>Trnsaction type</th>
                                            <th>Debet</th>
                                            <th>Credit</th>
					    <?php
						if ($_POST['tipe1'] == "false" and $_POST['tipe2'] == "true") {
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
                                            	$data = $db->query("select no_dokumen, tanggal, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, status_jurnal, tipe_dokumen, cost_center_kode, cost_center_nama, deskripsi, reg_no from tbl_jurnal where tanggal >= '".$_POST['d1']."' and tanggal <= '".$_POST['d2']."' and gl_kode >= '".$_POST['coa1']."' and gl_kode <= '".$_POST['coa2']."' order by no_dokumen desc", 0);
						$no = 0;
						if ($_POST['tipe1'] == "false" and $_POST['tipe2'] == "true") {
							$no = 1;
							$blNum = $db->query("select nilai from tbl_jurnal_saldo_awal where kode_akun='".$data[0]['gl_kode']."'");
							$saldo_awal = $blNum[0]['nilai'];
							$saldo = $blNum[0]['nilai'];
					?>
                                            <tr>
                                                <td align="center"><?php echo $no?></td>
                                                <td colspan="7"><?php echo '<u>'.$data[0]['gl_kode'].'</u> - '.$data[0]['gl_nama']?></td>
                                                <td style="text-align: right;"><?php echo number_format($saldo_awal)?></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
					<?php	
						}
                                        	for ($i = 0; $i < count($data); $i++) {
							$no = $no + 1;
                                        ?>
                                            <tr>
                                                <td align="center"><?php echo $no?></td>
                                                <td><?php echo date("d-M-Y", strtotime($data[$i]['tanggal']))?></td>
                                                <td><?php echo '<u>'.$data[$i]['gl_kode'].'</u><br>'.$data[$i]['gl_nama']?></td>
                                                <td><?php echo '<u style="cursor: pointer;" title="Lihat Detail Jurnal" onclick="Detail_Jurnal(\''.md5($data[$i]['no_dokumen']).'\')">'.$data[$i]['no_dokumen'].'</u>'?></td>
                                                <td><?php echo '<u>'.$data[$i]['cost_center_kode'].'</u><br>'.$data[$i]['cost_center_nama']?></td>
                                                <td><?php echo $data[$i]['tipe_dokumen']?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['debit'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['credit'])?></td>
				   	        <?php
							if ($_POST['tipe1'] == "false" and $_POST['tipe2'] == "true") {
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
						<th colspan="6" style="text-align: right;">Total</th>
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
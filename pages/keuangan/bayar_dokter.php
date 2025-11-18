<?php
	$dataID = $db->query("select * from tbl_bayar_dokter where md5(id)='".$_GET['id']."'", 0);
	$data = $db->query("select * from tbl_bayar_dokter_detail where md5(bayar_dokter_id)='".$_GET['id']."'", 0);
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Input Jasa Dokter
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Transaksi Jasa Dokter
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/keuangan/bayar_jasaDokter_insert.php" method="post" class="form-horizontal form-bordered form-column" enctype="multipart/form-data" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_paymen" name="tgl_paymen" value="<?php echo date("Y-m-d")?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nilai Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nilai_paymen" name="nilai_paymen" value="<?php echo $dataID[0]['total_pendapatan']?>" size="10" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4" style="text-align: left;">Bukti Bayar</label>
                                                    <div class="col-sm-8">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn btn-default btn-file btn-success">
                                                                <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                            <span class="fileinput-exists">Ganti</span>
                                                            <input type="file" name="dokumen" accept="image/*" required>
                                                            </span>
                                                            <span class="fileinput-filename"></span>
                                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                        </div>
                                                    </div>
                                                 </div>
                                                <div class="form-actions">
                                                    <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']?>" />
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded"  value="Simpan Pembayaran Jasa Dokter" />
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
												<div style="overflow:auto; margin-left: 15px;">
                                                	<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
						<thead> 
						<tr>
							<th style="width:30px">NO</th> 
							<th>NAMA</th> 
							<th>JAMINAN</th> 
							<!--<th style="width:70px">B. ADMIN</th> 
							<th style="width:70px">B. POLI</th> -->
							<th style="width:70px">B. DOKTER</th> 
							<th style="width:80px">B. TINDAKAN</th> 
							<th style="width:70px">B. LAB</th> 
							<th style="width:70px">B. FISIO</th> 
							<th style="width:70px">TOTAL</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							for ($i = 0; $i < count($data); $i++) {
								$no = $i + 1;
						?>
						<tr>
							<td><?php echo $no?></td> 
							<td><?php echo '<u>'.$data[$i]['nomr'].' / '.$data[$i]['no_daftar'].'</u><br>'.$data[$i]['nama']?></td> 
							<td><?php echo $data[$i]['jaminan']?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_dokter'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_tindakan'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_lab'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['b_fisio'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td> 
						</tr> 
						<?php	
								$ttlSum = $ttlSum + $data[$i]['total'];
								$TotalbiayaDokter = $TotalbiayaDokter + $data[$i]['b_dokter'];
								$TotabiayaTindakan = $TotabiayaTindakan + $data[$i]['b_tindakan'];
								$TotalbiayaLab = $TotalbiayaLab + $data[$i]['b_lab'];
								$TotalbiayaFis = $TotalbiayaFis + $data[$i]['b_fisio'];
							}
							$biayaJaga = $db->queryItem("select sum(biaya) from tbl_kehadiran_dokter where tgl_hadir >= '".$dataID[0]['tgl_start']."' and tgl_hadir <= '".$dataID[0]['tgl_end']."' and kode_dokter='".$dataID[0]['kode_dokter']."'", 0);
							$totalAll1 = $ttlSum + $biayaJaga;
							$totalAll2 = $totalAll1 - $dataID[0]['npwp'];
						?>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								GRAND TOTAL
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($ttlSum)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								BIAYA JAGA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($biayaJaga)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								TOTAL JASA
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totalAll1)?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								PAJAK
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($dataID[0][npwp])?>
							</th>
						</tr>
						<tr>
							<th colspan="6" style="text-align: right; font-weight: bold">
								Total Pendapatan Dokter
							</th>
							<th colspan="2" style="text-align: right; font-weight: bold">
								<?php echo number_format($totalAll2)?>
							</th>
						</tr>
						</tbody>
					</table>
                    							</div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
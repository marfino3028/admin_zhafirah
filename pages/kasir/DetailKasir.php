<?php
	$data1 = $db->query("select a.nomr, b.nm_pasien, a.kode_dokter, a.nama_perusahaan, a.biayaAdmin, c.nama_poli from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_pasien='OPEN' and a.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
	$lab = $db->queryItem("select sum(tarif) as jml1 from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$gigi = $db->queryItem("select sum(tarif) as jml1 from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 1);
	$rad = $db->queryItem("select sum(tarif) as jml1 from tbl_rad_detail a  left join tbl_rad b on b.id=a.radId where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
	$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
	$total = $biayaAdmin + $farmasi1[0]['jml1'] + $farmasi2[0]['jml1'] + $embalase + $lab + $rad + $gigi;
	$biayaDokter = $db->queryItem("select tarif_dokter from tbl_dokter where kode_dokter='".$data1[0]['kode_dokter']."'");
	$biayaAdmin = $biayaDokter + $data1[0]['biayaAdmin'];
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Detail Pembayaran: Pasien</h1>
					<div class="other">
						<div class="float-left">Detail Pembayaran Kasir.</div>
						<div class="clearfix"></div>
					</div>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <p style="margin-left: 12px; margin-top: 15px; margin-bottom: 5px;">
			NoMR : <?php echo $data1[0]['nomr']?><br />
			Nama Pasien : <?php echo $data1[0]['nm_pasien']?><br />
			Penjamin Pasien : <?php echo $data1[0]['nama_perusahaan']?>
		</p>
		<table border="1" cellpadding="0" style="border-collapse: collapse" width="400" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" colspan="2">
                    <div class="hastable box box-content nopadding" align="left" style="margin-left: 10px; margin-right: 10px; width: 100%">
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
                            <thead> 
                            <tr>
                                <th colspan="3" style="text-align: left">Administrasi</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left">Biaya Administrasi</td> 
                                <td style="text-align: right"><?php echo number_format($data1[0]['biayaAdmin'])?></td>
                            </tr> 
                            <tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left"><?php echo $data1[0]['nama_poli']?></td> 
                                <td style="text-align: right; width: 75px;"><?php echo number_format($biayaDokter)?></td>
                            </tr> 
                            <tr>
                                <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Administrasi</th> 
                                <th style="text-align: right; font-weight: bold"><?php echo number_format($biayaAdmin)?></th>
                            </tr> 
                            </tbody>
                        </table>
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
                            <thead> 
                            <tr>
                                <th colspan="3" style="text-align: left">Pharmacy</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$farm = $db->query("select a.no_resep, a.nama_obat, a.total from tbl_resep_detail a  left join tbl_resep b on b.no_resep=a.no_resep where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($farm); $i++) {
							?>
							<tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left"><?php echo $farm[$i]['nama_obat']?></td> 
                                <td style="text-align: right; width: 75px;"><?php echo number_format($farm[$i]['total'])?></td>
                            </tr> 
							<?php
									$totFarm = $totFarm + $farm[$i]['total'];
								}
								$farm2 = $db->query("select b.nama, sum(total) as jml1 from tbl_racikan_detail a  left join tbl_racikan b on b.id=a.racikanId where b.no_resep='".$farm[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								if (count($farm2) > 0) {
							?>
							<tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left"><?php echo $farm2[0]['nama']?></td> 
                                <td style="text-align: right; width: 75px;"><?php echo number_format($farm2[0]['jml1'])?></td>
                            </tr> 
							<?php
									$totFarm = $totFarm + $farm2[0]['jml1'];
								}
							?>
                            <tr>
                                <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Pharmacy</th> 
                                <th style="text-align: right; font-weight: bold"><?php echo number_format($totFarm)?></th>
                            </tr> 
                            </tbody>
                        </table>
						<?php
							if ($lab > 0) {
						?>
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
                            <thead> 
                            <tr>
                                <th colspan="3" style="text-align: left">Laboratorium</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$lab = $db->query("select nama_tindakan, tarif from tbl_lab_detail a  left join tbl_lab b on b.id=a.labId where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 0);
								for ($i = 0; $i < count($lab); $i++) {
							?>
							<tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left"><?php echo $lab[$i]['nama_tindakan']?></td> 
                                <td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif'])?></td>
                            </tr> 
							<?php
									$totLab = $totLab + $lab[$i]['tarif'];
								}
							?>
                            <tr>
                                <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Laboratorium</th> 
                                <th style="text-align: right; font-weight: bold"><?php echo number_format($totLab)?></th>
                            </tr> 
                            </tbody>
                        </table>
						<?php
							}
							//if ($gigi > 0) {
						?>
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin"> 
                            <thead> 
                            <tr>
                                <th colspan="3" style="text-align: left">Poli Gigi</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$gigi = $db->query("select nama_tindakan, tarif from tbl_gigi_detail a  left join tbl_gigi b on b.id=a.gigiId where b.no_daftar='".$_GET['id']."' and a.status_delete='UD' and b.status_delete='UD'", 1);
								for ($i = 0; $i < count($gigi); $i++) {
							?>
							<tr>
                                <td style="width: 15px; text-align: right">-</td> 
                                <td style="text-align: left"><?php echo $gigi[$i]['nama_tindakan']?></td> 
                                <td style="text-align: right; width: 75px;"><?php echo number_format($lab[$i]['tarif'])?></td>
                            </tr> 
							<?php
									$totgigi = $totgigi + $gigi[$i]['tarif'];
								}
							?>
                            <tr>
                                <th colspan="2" style="text-align: right; margin-right: 5px; font-weight: bold">Total Biaya Poli Gigi</th> 
                                <th style="text-align: right; font-weight: bold"><?php echo number_format($totgigi)?></th>
                            </tr> 
                            </tbody>
                        </table>
						<?php
							//}
						?>
                    </div>
                </td>
           </tr>
        </table>
    </div>
</form>
</div>
<?php
	$data = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'", 0);
	$daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where md5(nomr)='".$_GET['id']."'");
	
?>
<div class="ui-widget ui-widget-content ui-helper-clearfix form-container">
	<div class="page-title">
		<h1>Detail: PHR Layanan Hemodialisa Medical Report</h1>
		<div class="other">
			<div class="float-left">Detail PHR Layanan Hemodialisa Medical Record Pasien.</div>
			<div class="button float-right">
		
				
			</div>
			<div class="clearfix"></div>
		</div>
    
	<p style="margin-left: 12px; margin-top: 22px; margin-bottom: 5px;">
		Nomor MR : <?php echo $data[0]['nomr']?><br />
		Nama Pasien : <?php echo $data[0]['nm_pasien']?><br />
		Tgl Lahir : <?php echo $data[0]['tmpt_lahir'].', '.$data[0]['tgl_lahir']?><br />
		Berobat ditempat ini sebanyak : <?php echo $daftarnr?> kali<br />
	</p>
	</div>
	<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
		<p align="left" style="font-size: 20px; font-weight: bold;">History Pemeriksaan Dokter</p>
                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th>Tgl</th>
                      <th>Informasi HD</th>
                      <th>Tekanan Darah</th>
                      <th>Berat Badan</th>
                      <th>Riwayat Pemeriksaan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select nomr, nama, diag_etiologi, frekuensi, tgl_hd1, tgl_hd2, durasi_hd, tipe_mesin, akses_sirkulasi, lokasi, fistula, qb, qd, heparin_awal, heparin_m, pre, post, bb_kering, bb_pre, bb_post, dialisat, riwayat_td, alergi, hbs_ag, hcv, hiv, komplikasi_hd, diet, obat2, hasil_lab, no_daftar, user_insert, user_shift, tgl_data from tbl_catatan_dktr_hd where md5(nomr)='".$_GET['id']."' order by tgl_data desc");
	                  for ($i = 0; $i < count($data); $i++) {
				$daftar = $db->query("select a.kode_dokter, b.nama_dokter from tbl_pendaftaran a left join tbl_dokter b on b.kode_dokter=a.kode_dokter where a.no_daftar='".$data[$i]['no_daftar']."'");
                    ?>
                    <tr>
                      <td style="font-size: 13px;">
                        <?php echo date("d-F-Y", strtotime($data[$i]['tgl_data'])).'<br>Nama Dokter: '.$daftar[0]['nama_dokter']?>
			<a class="btn btn-success" target="_blank" href="print_hd.php?id=<?= $data[$i]['no_daftar']; ?>&ids=<?= $data[0]['nomr']; ?>"><i class="fa fa-fw fa-print"></i> Print PHR</a>
                      </td>
                      <td style="font-size: 13px;">
                        <?php 
                      		echo '<small>Diagnosa & Etiologi : '.$data[$i]['diag_etiologi'].'</small><br>';
                      		echo '<small>Tanggal Pertama HD : '.$data[$i]['tgl_hd1'].'</small><br>';
                      		echo '<small>Frekuensi Hemodialisa : '.$data[$i]['frekuensi'].'</small><br>';
                      		echo '<small>Tanggal Terakhir HD : '.$data[$i]['tgl_hd2'].'</small><br>';
                      		echo '<small>Durasi HD : '.$data[$i]['durasi_hd'].'</small><br>';
                      		echo '<small>Tipe Mesin : '.$data[$i]['tipe_mesin'].'</small><br>';
                      		echo '<small>Akses Sirkulasi : '.$data[$i]['akses_sirkulasi'].'</small><br>';
                      		echo '<small>Lokasi : '.$data[$i]['lokasi'].'</small><br>';
                      		echo '<small>Fistulas : '.$data[$i]['fistula'].'</small><br>';
                      		echo '<small>Quick Blood Flow (QB) : '.$data[$i]['qb'].'</small><br>';
                      		echo '<small>Quick Dialysis Flow (QD) : '.$data[$i]['qd'].'</small><br>';
                      		echo '<small>Heparin Dosis Awal : '.$data[$i]['heparin_awal'].'</small><br>';
                      		echo '<small>Heparin Maintenance : '.$data[$i]['heparin_m'].'</small><br>';
                        ?>
                      </td>
                      <td style="font-size: 13px;">
                        <?php 
                      		echo '<small>Pre : '.$data[$i]['pre'].'</small><br>';
                      		echo '<small>Post : '.$data[$i]['post'].'</small><br>';
                      		echo '<small>Berat Badan Kering : '.$data[$i]['bb_kering'].'</small><br>';
                        ?>
                      </td>
                      <td style="font-size: 13px;">
                        <?php 
                      		echo '<small>Berat Badan HD (Pre) :  '.$data[$i]['bb_pre'].'</small><br>';
                      		echo '<small>Berat Badan HD (Pre) : '.$data[$i]['bb_post'].'</small><br>';
                      		echo '<small>Dialisat : '.$data[$i]['dialisat'].'</small><br>';
                      		echo '<small>Riwayat Transfusi Darah : '.$data[$i]['riwayat_td'].'</small>';
                      		echo '<small>Alergi : '.$data[$i]['alergi'].'</small>';
                        ?>
                      </td>
                      <td style="font-size: 13px;">
                        <?php 
                      		echo '<small>HBs AG : '.$data[$i]['hbs_ag'].'</small><br>';
                      		echo '<small>Anti HCV : '.$data[$i]['hcv'].'</small><br>';
                      		echo '<small>Anti HIV : '.$data[$i]['hiv'].'</small><br>';
                      		echo '<small>Komplikasi HD : '.$data[$i]['komplikasi_hd'].'</small><br>';
                      		echo '<small>Diet : '.$data[$i]['diet'].'</small><br>';
                      		echo '<small>Obat-Obatan : '.$data[$i]['obat2'].'</small>';
                      		echo '<small>Hasil Lab : '.$data[$i]['hasil_lab'].'</small>';
                        ?>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>

		<p align="left" style="font-size: 20px; font-weight: bold;">Daftar Dokumen PHR</p>
                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th>Tgl Pemeriksaan</th>
                      <th>Dokter</th>
                      <th>Dokumen</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select * from tbl_hd_phr where md5(nomr)='".$_GET['id']."'");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-F-Y", strtotime($data[$i]['tanggal']))?>
                      </td>
                      <td>
                        <?php echo $data[$i]['kode_dokter'].' - '.$data[$i]['nama_dokter']?>
                      </td>
                      <td>
                        [<a href="dokumen/<?php echo $data[$i]['dokumen']?>" target="_blank">klik disini</a>]
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
	</div>

</div>
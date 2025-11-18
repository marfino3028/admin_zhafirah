<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <?php
	    $pasien = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
  		$daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where nomr='".$_GET['id']."'");
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Profile Pasien Layanan Hemodialisa
                </h3>
              </div>
              <div class="box-content">
                <blockquote>
                  <p>
                    <?php echo $pasien[0]['nomr'].' - '.$pasien[0]['nm_pasien']?>
                  </p>
                  <small>Jenis Kelamin : <?php echo $pasien[0]['jk']?></small>
                  <small>Alamat / Asal : <?php echo $pasien[0]['alamat_pasien']?></small>
                  <small>Berobat ditempat ini sebanyak : <?php echo $daftarnr?> Kali</small>
                </blockquote>
              </div>
            </div>
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> History Pemeriksaan Dokter
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

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
                      $data = $db->query("select nomr, nama, diag_etiologi, frekuensi, tgl_hd1, tgl_hd2, durasi_hd, tipe_mesin, akses_sirkulasi, lokasi, fistula, qb, qd, heparin_awal, heparin_m, pre, post, bb_kering, bb_pre, bb_post, dialisat, riwayat_td, alergi, hbs_ag, hcv, hiv, komplikasi_hd, diet, obat2, hasil_lab, no_daftar, user_insert, user_shift, tgl_data from tbl_catatan_dktr_hd where nomr='".$_GET['id']."' order by tgl_data desc");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-M-Y", strtotime($data[$i]['tgl_data']))?>
                      </td>
                      <td>
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
                      <td>
                        <?php 
                      		echo '<small>Pre : '.$data[$i]['pre'].'</small><br>';
                      		echo '<small>Post : '.$data[$i]['post'].'</small><br>';
                      		echo '<small>Berat Badan Kering : '.$data[$i]['bb_kering'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Berat Badan HD (Pre) :  '.$data[$i]['bb_pre'].'</small><br>';
                      		echo '<small>Berat Badan HD (Pre) : '.$data[$i]['bb_post'].'</small><br>';
                      		echo '<small>Dialisat : '.$data[$i]['dialisat'].'</small><br>';
                      		echo '<small>Riwayat Transfusi Darah : '.$data[$i]['riwayat_td'].'</small>';
                      		echo '<small>Alergi : '.$data[$i]['alergi'].'</small>';
                        ?>
                      </td>
                      <td>
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
              </div>                
            </div>
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Daftar Dokumen PHR Pasien
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

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
                      $data = $db->query("select * from tbl_hd_phr where nomr='".$_GET['id']."' and no_daftar='".$_GET['ids']."'");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-F-Y", strtotime($data[$i]['tanggal']))?>
                      </td>
                      <td>
                        <?php echo $data[$i]['nama_dokter']?>
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
        </div>
        </div>
    </div>
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
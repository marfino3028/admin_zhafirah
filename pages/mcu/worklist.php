<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Layanan Medical CheckUp</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien MCU</a>
            </li>
            <li>
                <a href="javascript:void(0)">Input Hasil MCU</a>
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
                  Profile Pasien Layanan Medical CheckUp
                </h3>
                <a href="index.php?mod=mcu&submod=worklist_new&nomr=<?php echo md5($_GET['id']).'&no_daftar='.md5($_GET['ids'])?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Hasil MCU</a>
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
                  <i class="fa fa-table"></i> History Hasil MCU Pasien
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th>Tgl</th>
                      <th>Anamnesia</th>
                      <th>Kebiasaan</th>
                      <th>Pemeriksaan Fisik</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select * from tbl_mcu_worklist where nomr='".$_GET['id']."' order by tanggal desc");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-M-Y", strtotime($data[$i]['tanggal']))?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Keluhan : '.$data[$i]['keluhan'].'</small><br>';
                      		echo '<small>Diabetes Melitus : '.$data[$i]['diabet'].'</small><br>';
                      		echo '<small>Hipertensi : '.$data[$i]['hipertensi'].'</small><br>';
                      		echo '<small>Penyakit Jantung : '.$data[$i]['jantung'].'</small><br>';
                      		echo '<small>Penyakit Paru-Paru : '.$data[$i]['paru_hd'].'</small><br>';
                      		echo '<small>Kecelakaan : '.$data[$i]['tipe_mesin'].'</small><br>';
                      		echo '<small>Dirawat di RS : '.$data[$i]['akses_sirkulasi'].'</small><br>';
                      		echo '<small>Pengobatan : '.$data[$i]['pengobatan'].'</small><br>';
                      		echo '<small>Alergi : '.$data[$i]['alergi'].'</small><br>';
                      		echo '<small>Operasi : '.$data[$i]['operasi'].'</small><br>';
                      		echo '<small>Diabetes - Ayah : '.$data[$i]['diabet_ayah'].'</small><br>';
                      		echo '<small>Hipertensi_ayah : '.$data[$i]['hipertensi_ayah'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Makan  : '.$data[$i]['makan'].'</small><br>';
                      		echo '<small>Merokok : '.$data[$i]['rokok'].'</small><br>';
                      		echo '<small>Alkohol : '.$data[$i]['alkohol'].'</small><br>';
                      		echo '<small>Kopi : '.$data[$i]['kopi'].'</small><br>';
                      		echo '<small>Olahraga : '.$data[$i]['olahraga_hd'].'</small><br>';
                      		echo '<small>Pola Devikasi : '.$data[$i]['pola'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Tekanan Darah : '.$data[$i]['tekanan_darah'].'</small><br>';
                      		echo '<small>Denyut Nadi : '.$data[$i]['denyut_nadi'].'</small><br>';
                      		echo '<small>Berat Badan : '.$data[$i]['berat_badan'].'</small><br>';
                      		echo '<small>Lingkar Perut : '.$data[$i]['lingkar_perut'].'</small><br>';
                      		echo '<small>BMI : '.$data[$i]['bmi'].'</small><br>';
                      		echo '<small>Respirasi : '.$data[$i]['respirasi'].'</small><br>';
                      		echo '<small>Suhu : '.$data[$i]['suhu'].'</small><br>';
                      		echo '<small>Telinga : '.$data[$i]['telinga'].'</small><br>';
                      		echo '<small>Auricula Extema : '.$data[$i]['extema'].'</small><br>';
                      		echo '<small>MT : '.$data[$i]['mt'].'</small><br>';
                      		echo '<small>Sekret : '.$data[$i]['sekret'].'</small><br>';
                      		echo '<small>Hidung : '.$data[$i]['hidung'].'</small><br>';
                        ?>
                      </td>
                      <td>
			 <a href="index.php?mod=mcu&submod=worklist_saran&id=<?php echo $_GET['id'].'&ids='.$_GET['ids'].'&key='.md5($data[$i]['id'])?>">Kesimpulan<br>& Saran</a>
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
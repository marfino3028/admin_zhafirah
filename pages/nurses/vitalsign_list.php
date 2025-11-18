<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Vital Sign Pasien</a>
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
                  Profile Pasien
                </h3>
                <a href="index.php?mod=nurses&submod=vitalsign_form&id=<?php echo $_GET['id'].'&ids='.$_GET['ids']?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pemeriksaan</a>
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
                  <i class="fa fa-table"></i> History Pemeriksaan Vital Sign Pasien
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th>Tgl</th>
                      <th>Vital Sign</th>
                      <th>Lingkar Kepala</th>
                      <th>SPO2</th>
                      <th>Pain Level</th>
                      <th>User Input</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select * from tbl_catatan_dktr where nomr='".$_GET['id']."' order by tgl_data desc", 0);
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-M-Y", strtotime($data[$i]['tgl_data']))?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Berat Badan : '.$data[$i]['v_weight'].'</small><br>';
                      		echo '<small>Tinggi Badan : '.$data[$i]['v_height'].'</small><br>';
                      		echo '<small>Vitals-BMI : '.$data[$i]['v_bmi'].'</small><br>';
                      		echo '<small>Vitals-BP Sistolik : '.$data[$i]['v_bp'].'</small><br>';
                      		echo '<small>Vitals-BP Diastolik : '.$data[$i]['v_bpd'].'</small><br>';
                      		echo '<small>Nadi : '.$data[$i]['v_pr'].'</small><br>';
                      		echo '<small>Frekuensi Nafas : '.$data[$i]['v_rr'].'</small><br>';
                      		echo '<small>Suhu : '.$data[$i]['v_temp'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Lingkar Kepala : '.$data[$i]['lingkar_k'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Diagnosis :  '.$data[$i]['spo2'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Order : '.$data[$i]['pain_l'].'</small><br>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>'.$data[$i]['user_insert'].'</small><br>';
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
        </div>
    </div>
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
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
                  Profile Pasien
                </h3>
                <a href="index.php?mod=ranap&submod=worklist_form&id=<?php echo md5($_GET['id']).'&ids='.md5($_GET['ids'])?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pemeriksaan</a>
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
                      <th>Subjective</th>
                      <th>Objective</th>
                      <th>Assesment</th>
                      <th>Planning</th>
                      <th>Dirujuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select cc_hpi, past_med_history, past_surgical_histort, alergi, other_subject, v_weight, v_height, v_bmi, v_bp, v_pr, v_rr, v_temp, pe_mata, pe_tht, pe_jantung, pe_paru, pe_abil, pe_eks, s_exam, observation, other_obj, as_diagnosis, as_problems, as_progres, other_as, plan_order, plan_advice, konsul_internal, order_ok, prescrip, other_plan, no_daftar, user_insert, user_shift, rujukan, tgl_data from tbl_catatan_dktr where nomr='".$_GET['id']."' order by tgl_data desc");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-M-Y", strtotime($data[$i]['tgl_data']))?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>CC + HPI : '.$data[$i]['cc_hpi'].'</small><br>';
                      		echo '<small>Past Medical History : '.$data[$i]['past_med_history'].'</small><br>';
                      		echo '<small>Past Surgical History : '.$data[$i]['past_surgical_histort'].'</small><br>';
                      		echo '<small>Allergies : '.$data[$i]['alergi'].'</small><br>';
                      		echo '<small>Other : '.$data[$i]['other_subject'].'</small>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Vitals-Weight : '.$data[$i]['v_weight'].'</small><br>';
                      		echo '<small>Vitals-Hiight : '.$data[$i]['v_height'].'</small><br>';
                      		echo '<small>Vitals-BMI : '.$data[$i]['v_bmi'].'</small><br>';
                      		echo '<small>Vitals-BP : '.$data[$i]['v_bp'].'</small><br>';
                      		echo '<small>Physical Examination-Mata : '.$data[$i]['pe_mata'].'</small><br>';
                      		echo '<small>Physical Examination-THT : '.$data[$i]['pe_tht'].'</small><br>';
                      		echo '<small>Physical Examination-Jantung : '.$data[$i]['pe_jantung'].'</small><br>';
                      		echo '<small>Physical Examination-Paru : '.$data[$i]['pe_paru'].'</small><br>';
                      		echo '<small>Physical Examination-Abil : '.$data[$i]['pe_abil'].'</small><br>';
                      		echo '<small>Physical Examination-Eks : '.$data[$i]['pe_eks'].'</small><br>';
                      		echo '<small>Systemic Examination : '.$data[$i]['s_exam'].'</small><br>';
                      		echo '<small>Observation : '.$data[$i]['observation'].'</small><br>';
                      		echo '<small>Other : '.$data[$i]['other_obj'].'</small>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Diagnosis :  '.$data[$i]['as_diagnosis'].'</small><br>';
                      		echo '<small>Problems : '.$data[$i]['as_problems'].'</small><br>';
                      		echo '<small>Progress Note : '.$data[$i]['as_progres'].'</small><br>';
                      		echo '<small>Other : '.$data[$i]['other_as'].'</small>';
                        ?>
                      </td>
                      <td>
                        <?php 
                      		echo '<small>Order : '.$data[$i]['plan_order'].'</small><br>';
                      		echo '<small>Advice : '.$data[$i]['plan_advice'].'</small><br>';
                      		echo '<small>Konsul Internal : '.$data[$i]['plan_'].'</small><br>';
                      		echo '<small>Order OK / VK : '.$data[$i]['konsul_internal'].'</small><br>';
                      		echo '<small>Prescription : '.$data[$i]['prescrip'].'</small><br>';
                      		echo '<small>Other : '.$data[$i]['other_plan'].'</small>';
                        ?>
                      </td>
                      <td><?php echo $data[$i]['rujukan']?></td>
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
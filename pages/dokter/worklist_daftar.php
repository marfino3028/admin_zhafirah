<?php
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	include "../../header_sub.php";
?>
<div>
  <?php
  $pasien = $db->query("select * from tbl_pasien where nomr='" . $_GET['id'] . "'");
  $daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where nomr='" . $_GET['id'] . "'");
  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-title">
          <h3>
            <i class="fa fa-user"></i>
            Profile Pasien
          </h3>
        </div>
        <div class="box-content">
          <blockquote>
            <p>
              <?php echo $pasien[0]['nomr'] . ' - ' . $pasien[0]['nm_pasien'] ?>
            </p>
            <small>Jenis Kelamin : <?php echo $pasien[0]['jk'] ?></small>
            <small>Alamat / Asal : <?php echo $pasien[0]['alamat_pasien'] ?></small>
            <small>Berobat ditempat ini sebanyak : <?php echo $daftarnr ?> Kali</small>
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
                <th>SUBJECTIVE</th>
                <th>OBJECTIVE</th>
                <th style="width: 30%;">ASSESMENT</th>
                <th>PLANNING</th>
                <th>User Insert</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $data = $db->query("select * from tbl_catatan_dktr where nomr='" . $_GET['id'] . "' order by tgl_data desc", 0);
              for ($i = 0; $i < count($data); $i++) {
              ?>
                <tr>
                  <td>
                    <?php echo date("d-M-Y", strtotime($data[$i]['tgl_data'])) ?>
                  </td>
                  <td>
                    <?php
                    echo '<small>Anamnesis : ' . $data[$i]['anamnesis'] . '</small><br>';
		    echo '<small>CC + HPI : ' . $data[$i]['cc_hpi'] . '</small><br>';
                    echo '<small>Past Medical History : ' . $data[$i]['past_med_history'] . '</small><br>';
                    echo '<small>Past Surgical History : ' . $data[$i]['past_surgical_histort'] . '</small><br>';
                    echo '<small>Allergies : ' . $data[$i]['alergi'] . '</small><br>';
                    echo '<small>Other : ' . $data[$i]['other_subject'] . '</small><br>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small>Vitals-Weight : ' . $data[$i]['v_weight'] . '</small><br>';
                    echo '<small>Vitals-Height : ' . $data[$i]['v_height'] . '</small><br>';
                    echo '<small>Vitals-BMI : ' . $data[$i]['v_bmi'] . '</small><br>';
                    echo '<small>Vitals-BP Sistolik : ' . $data[$i]['v_bp'] . '</small><br>';
                    echo '<small>Vitals-BP Diastolik : ' . $data[$i]['v_bp'] . '</small><br>';
                    echo '<small>Vitals-PR : ' . $data[$i]['v_pr'] . '</small><br>';
                    echo '<small>Vitals-RR : ' . $data[$i]['v_rr'] . '</small><br>';
                    echo '<small>Vitals-Temp : ' . $data[$i]['v_temp'] . '</small><br>';
                    echo '<small>Physical Examination-Mata : ' . $data[$i]['pe_mata'] . '</small><br>';
                    echo '<small>Physical Examination-THT : ' . $data[$i]['pe_tht'] . '</small><br>';
                    echo '<small>Physical Examination-Jantung : ' . $data[$i]['pe_abil'] . '</small><br>';
                    echo '<small>Physical Examination-Paru : ' . $data[$i]['pe_paru'] . '</small><br>';
                    echo '<small>Physical Examination-Abil : ' . $data[$i]['pe_abil'] . '</small><br>';
                    echo '<small>Physical Examination-Eks : ' . $data[$i]['pe_eks'] . '</small><br>';
                    echo '<small>Systemic Examination : ' . $data[$i]['s_exam'] . '</small><br>';
                    echo '<small>Observation : ' . $data[$i]['observation'] . '</small><br>';
                    echo '<small>Other : ' . $data[$i]['other_obj'] . '</small><br>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small>Diagnosa Utama :  ' . $data[$i]['as_diagnosis'].' - '.$data[$i]['as_diagnosis_kode'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder1'] != '') echo '<small>Diagnosa Sekunder 1 :  ' . $data[$i]['diagnosa_sekunder1'].' - '.$data[$i]['icdcode_sekunder1'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder2'] != '') echo '<small>Diagnosa Sekunder 2 :  ' . $data[$i]['diagnosa_sekunder2'].' - '.$data[$i]['icdcode_sekunder2'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder3'] != '') echo '<small>Diagnosa Sekunder 3 :  ' . $data[$i]['diagnosa_sekunder3'].' - '.$data[$i]['icdcode_sekunder3'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder4'] != '') echo '<small>Diagnosa Sekunder 4 :  ' . $data[$i]['diagnosa_sekunder4'].' - '.$data[$i]['icdcode_sekunder4'] . '</small><br>';
                    echo '<small>Problems : ' . $data[$i]['as_problems'] . '</small><br>';
                    echo '<small>Progress Note : ' . $data[$i]['as_progres'] . '</small><br>';
                    echo '<small>Other : ' . $data[$i]['other_as'] . '</small>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small>Order : ' . $data[$i]['plan_order'] . '</small><br>';
                    echo '<small>Advice : ' . $data[$i]['plan_advice'] . '</small><br>';
                    echo '<small>Konsul Internal : ' . $data[$i]['konsul_internal'] . '</small><br>';
                    echo '<small>Order OK / VK : ' . $data[$i]['order_ok'] . '</small><br>';
                    echo '<small>Prescription : ' . $data[$i]['prescrip'] . '</small><br>';
                    echo '<small>Other : ' . $data[$i]['other_plan'] . '</small>';
                    echo '<small>Di Rujuk Ke- : ' . $data[$i]['rujukan'] . '</small>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small>' . $data[$i]['user_insert'] . '</small><br>';
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
  $('#table-data').DataTable({
    responsive: true,
    columnDefs: [{
      targets: [0],
      orderable: false
    }]
  })
</script>
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
          <a href="index.php?mod=dokter&submod=worklist_form_new&id=<?php echo $_GET['id'] . '&ids=' . $_GET['ids'] ?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pemeriksaan</a>
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
              $data = $db->query("select * from tbl_catatan_dktr where nomr='" . $_GET['id'] . "' order by id desc", 0);
              for ($i = 0; $i < count($data); $i++) {
              ?>
                <tr>
                  <td>
                    <?php echo date("l", strtotime($data[$i]['insert_resume'])).'<br>'.date("d F Y", strtotime($data[$i]['insert_resume'])).'<br>'.date("h:i:s A", strtotime($data[$i]['insert_resume'])) ?>
                  </td>
                  <td>
                    <?php
                    echo '<small><b>Anamnesis :</b> ' . $data[$i]['anamnesis'] . '</small><br>';
		    echo '<small><b>CC + HPI :</b> ' . $data[$i]['cc_hpi'] . '</small><br>';
                    echo '<small><b>Past Medical History :</b> ' . $data[$i]['past_med_history'] . '</small><br>';
                    echo '<small><b>Past Surgical History :</b> ' . $data[$i]['past_surgical_histort'] . '</small><br>';
                    echo '<small><b>Allergies :</b> ' . $data[$i]['alergi'] . '</small><br>';
                    echo '<small><b>Other :</b> ' . $data[$i]['other_subject'] . '</small><br>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small><b>Vitals-Weight :</b> ' . $data[$i]['v_weight'] . '</small><br>';
                    echo '<small><b>Vitals-Height :</b> ' . $data[$i]['v_height'] . '</small><br>';
                    echo '<small><b>Vitals-BMI :</b> ' . $data[$i]['v_bmi'] . '</small><br>';
                    echo '<small><b>Vitals-BP Sistolik :</b> ' . $data[$i]['v_bp'] . '</small><br>';
                    echo '<small><b>Vitals-BP Diastolik :</b> ' . $data[$i]['v_bp'] . '</small><br>';
                    echo '<small><b>Vitals-PR :</b> ' . $data[$i]['v_pr'] . '</small><br>';
                    echo '<small><b>Vitals-RR :</b> ' . $data[$i]['v_rr'] . '</small><br>';
                    echo '<small><b>Vitals-Temp :</b> ' . $data[$i]['v_temp'] . '</small><br>';
                    echo '<small><b>Pemeriksaan Fisik :</b> ' . $data[$i]['pe_eks'] . '</small><br>';
                    echo '<small><b>Laboratorium / Radiology :</b> ' . $data[$i]['observation'] . '</small><br>';
                    echo '<small><b>Other :</b> ' . $data[$i]['other_obj'] . '</small><br>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small><b>Diagnosa Utama :</b>  ' . $data[$i]['as_diagnosis'].' - '.$data[$i]['as_diagnosis_kode'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder1'] != '') echo '<small>Diagnosa Sekunder 1 :  ' . $data[$i]['diagnosa_sekunder1'].' - '.$data[$i]['icdcode_sekunder1'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder2'] != '') echo '<small>Diagnosa Sekunder 2 :  ' . $data[$i]['diagnosa_sekunder2'].' - '.$data[$i]['icdcode_sekunder2'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder3'] != '') echo '<small>Diagnosa Sekunder 3 :  ' . $data[$i]['diagnosa_sekunder3'].' - '.$data[$i]['icdcode_sekunder3'] . '</small><br>';
                    if ($data[$i]['diagnosa_sekunder4'] != '') echo '<small>Diagnosa Sekunder 4 :  ' . $data[$i]['diagnosa_sekunder4'].' - '.$data[$i]['icdcode_sekunder4'] . '</small><br>';
                    echo '<small><b>Problems :</b> ' . $data[$i]['as_problems'] . '</small><br>';
                    echo '<small><b>Progress Note :</b> ' . $data[$i]['as_progres'] . '</small><br>';
                    echo '<small><b>Other :</b> ' . $data[$i]['other_as'] . '</small>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<small><b>Order :</b> ' . $data[$i]['plan_order'] . '</small><br>';
                    echo '<small><b>Advice :</b> ' . $data[$i]['plan_advice'] . '</small><br>';
                    echo '<small><b>Konsul Internal :</b> ' . $data[$i]['konsul_internal'] . '</small><br>';
                    echo '<small><b>Order OK / VK :</b> ' . $data[$i]['order_ok'] . '</small><br>';
                    echo '<small><b>Prescription :</b> ' . $data[$i]['prescrip'] . '</small><br>';
                    echo '<small><b>Other :</b> ' . $data[$i]['other_plan'] . '</small>';
                    echo '<small><b>Di Rujuk Ke- :</b> ' . $data[$i]['rujukan'] . '</small>';
                    ?>
                  </td>
                  <td>
                    <?php
                    echo '<p>' . $data[$i]['user_insert'] . '</p>';
                    ?>
                    <a class="btn_no_text btn" style="border-radius: 10px; border: 1px black solid;" title="Edit" href="index.php?mod=dokter&submod=worklist_edit&id=<?php echo $pasien[0]['nomr'].'&kode='.md5($data[$i]['id'])?>">
                       <span class="glyphicon-edit"></span>
                    </a>
                  </td>
                </tr>
              <?php
              }
		$tambahan = $db->query("select no_daftar, nomr, nama, subject, object, assesment, planning, tgl_soap, user_insert from tbl_fisio where nomr='".$_GET['id']."' and subject != ''", 0);
		for ($i = 0; $i < count($tambahan); $i++) {
	      ?>
		<tr>
			<td><p><?php echo date("d F Y H:i:s", strtotime($tambahan[$i]['tgl_soap']))?></p></td>
			<td><p style="font-weight: bold;">SOAP Fisioterapi</p><p><?php echo nl2br($tambahan[$i]['subject'])?></p></td>
			<td><p>&nbsp;</p><p><?php echo nl2br($tambahan[$i]['object'])?></p></td>
			<td><p>&nbsp;</p><p><?php echo nl2br($tambahan[$i]['assesment'])?></p></td>
			<td><p>&nbsp;</p><p><?php echo nl2br($tambahan[$i]['planning'])?></p></td>
			<td><p>&nbsp;</p><p><?php echo 'Terapis:<br>'.$tambahan[$i]['user_insert']?></p></td>
		</tr>
	      <?php
		}
              ?>


            </tbody>
          </table>

          <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
            <tbody>
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
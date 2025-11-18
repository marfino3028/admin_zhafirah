<?php
  date_default_timezone_set("Asia/Jakarta");
  include "../../3rdparty/engine.php";
  //print_r($_POST);
  //print_r(date("Y-m-d H:i:s N"));
  
  if ($_POST['id'] == "01") {
      echo 'Rujukan Atas Inisiatif Sendiri';
      echo '<input type="hidden" name="rujukan_nama" value="Inisiatif Sendiri">';
  }
  elseif ($_POST['id'] == "03") {
      echo '<input type="text" name="rujukan_nama" class="form-control" placeHolder="Nama Faskes BPJS" value="BPJS Kesehatan">';
  }
  else {
?>
<div>
    <select id="kd_dokter_oncall" name="rujukan_nama" size="1" class="form-control">
        <option value="">--Pilih Rumah Sakit--</option>
        <?php
          $poli = $db->query("select * from tbl_rujukan where status_delete='UD'");
          for ($i = 0; $i < count($poli); $i++) {
            echo '<option value="'.$poli[$i]['id'].'">'.$poli[$i]['nama'].'</option>';
          }
        ?>
    </select>
</div>
<small style="margin-top: 10px;">Upload Dokumen Rujukan</small>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen" accept="application/pdf">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
<?php
  }
?>
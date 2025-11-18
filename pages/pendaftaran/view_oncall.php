<?php
  date_default_timezone_set("Asia/Jakarta");
  include "../../3rdparty/engine.php";
  //print_r($_POST);
  //print_r(date("Y-m-d H:i:s N"));
  
  if ($_POST['id'] == "ONCALL") {
?>
<div>
    <select id="kd_dokter_oncall" name="kd_dokter_oncall" size="1" class="form-control">
        <option value="">--Pilih Dokter OnCall--</option>
        <?php
          //$poli = $db->query("select * from tbl_dokter where status_delete='UD' and kode_dokter not in (select kode_dokter from tbl_jadwal where hari='".date("N")."')");
          $poli = $db->query("select * from tbl_dokter where status_delete='UD'");
          for ($i = 0; $i < count($poli); $i++) {
            echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
          }
        ?>
    </select>
</div>
<?php
  }
?>
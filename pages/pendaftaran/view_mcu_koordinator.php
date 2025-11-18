<div>
    <select id="paketmcu_koordinator" name="paketmcu_koordinator" size="1" class="form-control">
        <option value="">--Pilih Dokter Koordinator--</option>
        <?php
	ini_set("display_errors", 1);
	include "../../3rdparty/engine.php";
          $poli = $db->query("select * from tbl_dokter");
          for ($i = 0; $i < count($poli); $i++) {
            echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
          }
        ?>
    </select>
</div>

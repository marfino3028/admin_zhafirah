<div>
    <select id="paket_mcu" name="paket_mcu" size="1" class="form-control" onchange="pilihMCU_paket(this.value)">
        <option value="">--Pilih Paket MCU--</option>
        <?php
	ini_set("display_errors", 1);
	include "../../3rdparty/engine.php";
          $poli = $db->query("select * from tbl_paketmcu_header");
          for ($i = 0; $i < count($poli); $i++) {
            echo '<option value="'.$poli[$i]['id'].'">'.$poli[$i]['nama'].'</option>';
          }
        ?>
    </select>
</div>

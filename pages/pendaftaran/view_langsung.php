<div>
	<td valign="middle" align="center">
	<div style="margin-bottom: 4px; margin-top: 4px;">
	<select id="medis" name="medis" size="1" class="form-control">
		<option value="">--Penunjang Medis--</option>
		<option value="LAB">LABORATORIUM</option>
		<option value="RAD">RADIOLOGI</option>
		<option value="FIS">FISIOTERAPHI</option>
		<option value="SKS">SURAT KET SEHAT</option>
	</select>
	</div></td>
</div>
<div>
    <select id="kd_dokter" name="kd_dokter" size="1" class="form-control">
        <option value="">--Pilih Dokter--</option>
        <?php
        include "../../3rdparty/engine.php";
        $poli = $db->query("select * from tbl_dokter where status_delete='UD'");
        for ($i = 0; $i < count($poli); $i++) {
            echo '<option value="'.$poli[$i]['kode_dokter'].'">'.$poli[$i]['nama_dokter'].'</option>';
        }
        ?>
    </select>
</div>
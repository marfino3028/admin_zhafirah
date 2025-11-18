<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	$data = $db->query("select * from tbl_karyawan where nomr_karyawan='".$_POST['id']."' and status_delete='UD'", 0);
	if (count($data) == 0) {
		echo '<label style="margin-left: 25px; margin-top: 25px; font-weight: bold;">Tidak Ada Data ditemukan</label>';
		die();
	}
	
	echo '<input type="hidden" id="idmr" name="idmr" value="'.$data[0]['id'].'">';
	echo '<input type="hidden" id="nomr" name="nomr" value="'.$_POST['id'].'">';
	echo '<input type="hidden" id="nodaftar" name="nodaftar" value="'.$idNya[0].'">';
?>
<div>
    <div>
    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
        <thead>
        	<td colspan="2">Detail Pasien Poli Karyawan</td>
        </thead>
        <tr>
            <td style="width:140px">Nama Karyawan</td> 
            <td><?php echo $data[0]['nm_karyawan']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Unit/Divisi</td> 
            <td><?php echo $data[0]['unit']?></td>
        </tr> 
    </table>
    </div>
</div>
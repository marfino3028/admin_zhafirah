<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	$idNya = $_POST['id'];
	$data = $db->query("select * from tbl_pasien_jamsostek where nomr='".$idNya."'", 0);
	if (count($data) == 0) {
		echo '<label style="margin-left: 25px; margin-top: 25px; font-weight: bold;">Tidak Ada Data ditemukan</label>';
		die();
	}
	
	echo '<input type="hidden" id="idmr" name="idmr" value="'.$data[0]['id'].'">';
	echo '<input type="hidden" id="nomr" name="nomr" value="'.$data[0]['nomr'].'">';
?>
<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 90%;">
    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
        <thead>
        	<td colspan="2">Detail Pasien</td>
        </thead>
        <tr>
            <td style="width:140px">Nama Pasien</td> 
            <td><?php echo $data[0]['nm_pasien']?></td>
        </tr> 
        <tr>
            <td style="width:140px">No. KPJ</td> 
            <td><?php echo $data[0]['nomr']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Hubungan</td> 
            <td><?php echo $data[0]['hub']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Alamat</td> 
            <td><?php echo $data[0]['alamat_pasien']?></td>
        </tr> 
    </table>
</div>
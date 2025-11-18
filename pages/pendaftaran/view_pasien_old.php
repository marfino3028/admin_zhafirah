<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";

	$idNya = explode("###", $_POST['id']);
	$data = $db->query("select * from tbl_pasien where nomr='".$idNya[1]."' and status_delete='UD'", 0);
	if (count($data) == 0) {
		echo '<label style="margin-left: 25px; margin-top: 25px; font-weight: bold;">Tidak Ada Data ditemukan</label>';
		die();
	}
	
	echo '<input type="hidden" id="idmr" name="idmr" value="'.$data[0]['id'].'">';
	echo '<input type="hidden" id="nomr" name="nomr" value="'.$idNya[1].'">';
	echo '<input type="hidden" id="nodaftar" name="nodaftar" value="'.$idNya[0].'">';
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
            <td style="width:140px">Jenis Kelamin</td> 
            <td><?php echo $data[0]['jk']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Tempat Lahir</td> 
            <td><?php echo $data[0]['tmpt_lahir']?></td>
        </tr> 
        <tr>
            <td style="width:140px">Tanggal Lahir</td> 
            <td><?php echo date("d F Y", strtotime($data[0]['tgl_lahir']))?></td>
        </tr> 
        <tr>
            <td style="width:140px">Alamat</td> 
            <td><?php echo $data[0]['alamat_pasien']?></td>
        </tr> 
    </table>
</div>
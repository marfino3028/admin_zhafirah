<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
	
	$insert = $db->query("insert into tbl_racikanjams (no_resep, nama, user) values ('".$_POST['resep']."', '".$_POST['racikan']."', '".$_SESSION['rg_user']."')");
	$id_racikan = mysql_insert_id();
?>
<table border="0" cellpadding="0" style="border-collapse: collapse;">
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Nama Racikan</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<input type="text" name="nRacikan" id="nRacikan" size="25" value="<?php echo $_POST['racikan']?>" style="text-align: left" tabindex="3" />
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Pilih Obat</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<select id="obatR" name="obatR" size="1" style="width: 190px;" tabindex="1">
			<option value="">--Pilih Obat--</option>
			<?php
				$obat = $db->query("select * from tbl_obat where status_delete='UD'");
				for ($i = 0; $i < count($obat); $i++) {
					echo '<option value="'.$obat[$i]['kode_obat'].'"> &nbsp; &nbsp; &nbsp;'.$obat[$i]['nama_obat'].'</option>';
				}
			?>
		</select>
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Qty / Jumlah</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<input type="text" name="qty" id="qty" size="5" style="text-align: right" tabindex="3" />
		</div></td>
	</tr>
	<tr height="28">
		<td valign="top" align="center" colspan="2" >
		<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
		 <input type="hidden" id="id_racikan" name="id_racikan" value="<?php echo $id_racikan?>" />
		 <input type="button" value="Tambahkan Obat" onclick="simpanObatRacikan()" />
		 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Resep" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=input_resepJamsostek')" />
		</div></td>
	</tr>
</table>

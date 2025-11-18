<table border="0" cellpadding="0" style="border-collapse: collapse;">
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Qty / Jumlah</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<input type="text" name="qty" id="qty" size="5" style="text-align: right" tabindex="3" />
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Frekuensi</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<select id="frekuensi" name="frekuensi" class='chosen-select form-control'>
			<option value="3 x 1">3 x 1</option>
			<option value="2 x 1">2 x 1</option>
			<option value="1 x 1">1 x 1</option>
		</select>
 		</div></td>
	</tr>
	<tr height="28">
		<td valign="top" align="center" colspan="2" >
		<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
		 <input type="button" value="Simpan Obat" onclick="simpanObat()" class="btn btn-sm btn-small btn-primary rounded" />
		 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Resep" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=input_resepJamsostek')" />
		</div></td>
	</tr>
</table>
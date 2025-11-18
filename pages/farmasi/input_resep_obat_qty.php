<table border="0" cellpadding="0" style="border-collapse: collapse; width: 100%">
	<tr height="28">
		<td width="130"><span style="margin-left:10px">Qty / Jumlah</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<input type="text" id="qty" name="qty" class="form-control" placeholder="Qty / Jumlah" tabindex="3" style="text-align: right" />
		</div></td>
	</tr>
	<tr height="28">
		<td width="130"><span style="margin-left:10px">Frekuensi</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<select id="frekuensi" name="frekuensi" class='chosen-select form-control'>
			<option value="- Pilih Frekuensi-">- Pilih Frekuensi-</option>
			<option value="3 x 1">3 x 1</option>
			<option value="2 x 1">2 x 1</option>
			<option value="1 x 1">1 x 1</option>
			<option value="3 x 0.5">3 x 0.5</option>
			<option value="3 x 2.5ml">3 x 2.5ml</option>
			<option value="2 x 2.5ml">2 x 2.5ml</option>
			<option value="1 x 2.5ml">1 x 2.5ml</option>
			<option value="3 x 5ml">3 x 5ml</option>
			<option value="2 x 5ml">2 x 5ml</option>
			<option value="1 x 5ml">1 x 5ml</option>
			<option value="3 x 7.5ml">3 x 7.5ml</option>
			<option value="2 x 7.5ml">2 x 7.5ml</option>
			<option value="1 x 7.5ml">1 x 7.5ml</option>
			<option value="3 x 10ml">3 x 10ml</option>
			<option value="2 x 10ml">2 x 10ml</option>
			<option value="1 x 10ml">1 x 10ml</option>
			<option value="3 x 15ml">3 x 15ml</option>
			<option value="2 x 15ml">2 x 15ml</option>
			<option value="1 x 15ml">1 x 15ml</option>
		</select>
 		</div></td>
	</tr>
	<tr height="28">
		<td width="130"><span style="margin-left:10px">Durasi</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
			<input type="text" id="durasi" name="durasi" class="form-control" placeholder="Durasi" />
 		</div></td>
	</tr>
	<tr height="28">
		<td width="130" valign="top"><span style="margin-left:10px; padding-top: 20px;">Waktu Minum</span></td>
		<td>
		<div style="margin-bottom: 4px; margin-top: 4px;">
                    <div class="checkbox">
                        <label><input type="checkbox" id="waktu1" name="waktu1" value="Pagi">Pagi</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="waktu2" name="waktu2" value="Siang">Siang</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="waktu3" name="waktu3" value="Sore">Sore</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" id="waktu4" name="waktu4" value="Malam">Malam</label>
                    </div>
 		</div></td>
	</tr>
	<tr height="28">
		<td width="130"><span style="margin-left:10px">AC/PC/DC</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<select id="apd" name="apd" class='chosen-select form-control'>
			<option value="AC">AC</option>
			<option value="PC">PC</option>
			<option value="DC">DC</option>
		</select>
 		</div></td>
	</tr>
	<tr height="28">
		<td width="130"><p style="margin-left:10px;">Instruksi Tambahan</p></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<textarea name="tambahan" id="tambahan" class="form-control"></textarea>
 		</div></td>
	</tr>
	<tr height="28">
		<td width="130">&nbsp;</td>
		<td valign="middle" align="left">
		<div class="checkbox">
                        <label><input type="checkbox" id="reminder" name="reminder" value="REMINDER">Reminder Saat Minum Obat</label>
                </div><td>
	</tr>
	<tr height="28">
		<td valign="top" align="center" colspan="2" >
		<div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
		 <input type="button" value="Simpan Obat" onclick="simpanObat()" class="btn btn-sm btn-small btn-primary rounded" />
		 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Resep" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=input_resep')" />
		</div></td>
	</tr>
</table>
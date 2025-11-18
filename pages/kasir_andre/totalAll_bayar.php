<table border="0" cellpadding="0" style="border-collapse: collapse">
<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	$total = $_POST['subtotal'] - $_POST['diskon'];
	if ($_POST['pembulatan'] == '')	$_POST['pembulatan'] = $total;
	$jml_bulat = $_POST['pembulatan'] - $total;
	//$jml_bulat = 0;
	
	if ($_POST['metode'] == 'CC') {
?>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">No Kartu</span></td>
		<td valign="middle" align="right">
		<div style="margin-bottom: 4px; margin-top: 4px; text-align: right; font-weight: bold">
			<input type="text" id="nocc" name="nocc" class="form-control" style="width: 120px; text-align: left; font-weight: bold" />
		</div></td>
	</tr>
<?php	
	}
	elseif ($_POST['metode'] == 'DEBIT') {
?>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">No Kartu</span></td>
		<td valign="middle" align="right">
		<div style="margin-bottom: 4px; margin-top: 4px; text-align: right; font-weight: bold">
			<select id="NamaBank" name="NamaBank" size="1" style="width: 130px;">
				<option value="">--Pilih Bank--</option>
				<option value="BCA">BCA</option>
				<option value="MANDIRI">MANDIRI</option>
				<option value="BNJ">BNI</option>
			</select>
		</div></td>
	</tr>
<?php	
	}
?>

	<tr height="28">
		<td width="110"><span style="margin-left:10px">Total Bayar</span></td>
		<td valign="middle" align="right">
		<div style="margin-bottom: 4px; margin-top: 4px; text-align: right; font-weight: bold">
			<input type="text" id="total_bayar_all_text" name="total_bayar_all_text" class="form-control" value="<?php echo number_format($total)?>" readonly="" style="width: 120px; text-align: right; font-weight: bold" />
			<input type="hidden" id="total_bayar_all" name="total_bayar_all" value="<?php echo $total?>" style="width: 120px; text-align: right; font-weight: bold" />
			<!--<input type="hidden" id="jml_bulat_text" name="jml_bulat_text" class="form-control" value="<?php echo number_format($jml_bulat)?>" readonly="" style="width: 120px; text-align: right; font-weight: bold" />
			<input type="hidden" id="jml_bulat" name="jml_bulat" value="<?php echo $jml_bulat?>" style="width: 120px; text-align: right; font-weight: bold" />-->
		</div></td>
	</tr>
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Jml Pembulatan</span></td>
		<td valign="middle" align="right">
		<div style="margin-bottom: 4px; margin-top: 4px; text-align: right; font-weight: bold">
			<input type="text" id="jml_bulat_text" name="jml_bulat_text" class="form-control" value="<?php echo number_format($jml_bulat)?>" readonly="" style="width: 120px; text-align: right; font-weight: bold" />
			<input type="hidden" id="jml_bulat" name="jml_bulat" value="<?php echo $jml_bulat?>" style="width: 120px; text-align: right; font-weight: bold" />
		</div></td>
	</tr>
</table>
<?php
	session_start();
	include "../../3rdparty/engine.php";
	ini_set("display_errors", 0);
?>
<table border="0" cellpadding="0" style="border-collapse: collapse;">
	<tr height="28">
		<td width="110"><span style="margin-left:10px">Nama Racikan</span></td>
		<td valign="middle" align="center">
		<div style="margin-bottom: 4px; margin-top: 4px;">
		<input type="text" name="nRacikan" id="nRacikan" size="15" style="text-align: left" tabindex="3" /> <input type="button" value="Add" onclick="TambahRacikan()" />
		</div></td>
	</tr>
</table>

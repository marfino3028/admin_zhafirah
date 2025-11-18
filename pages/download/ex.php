<?php
require('html_table.php');

$htmlTable='<table>
<tr>
<td>S. No.</td>
<td>Location1</td>
<td>Location2</td>
</tr>

<tr>
<td>5</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>';

$pdf=new PDF_HTML_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML("Start of the HTML table.<br>$htmlTable<br>End of the table.");
$pdf->Output();
?>

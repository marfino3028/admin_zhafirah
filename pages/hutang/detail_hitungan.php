<?php
	$sub = $_POST['subtotal_awal'] - $_POST['diskon'] - $_POST['dp'] + $_POST['retur'] + $_POST['lain'];
	$ppn = round($sub * 11 /100);
	$total = $sub + $ppn;
	$subTxt = number_format($sub);
	$totalTxt = number_format($total);

?>

<script language="Javascript">
	updateAll('<?php echo $sub?>', '<?php echo $ppn?>', '<?php echo $total?>', '<?php echo $subTxt?>', '<?php echo $totalTxt?>');
</script>
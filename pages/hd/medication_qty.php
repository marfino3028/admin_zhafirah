	<?php
		//include "../../header-sub.php";
		include "../../3rdparty/engine.php";
		$layanan = $db->query("select * from tbl_bph_detail where id='".$_POST['id']."'");
		
	?>
	
	<script language="Javascript">
	    //layanan(id)
	    document.getElementById('qty').value = '<?php echo $layanan[0]['qty']?>';
	</script>

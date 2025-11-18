<style>
.containerCal {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 100%; /* 1:1 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>

<?php
    $daftar = $db->query("select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'");
    $pasien = $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
    //echo "select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'";
    //print_r($daftar);
    //print_r($pasien);
?>

<div class="row">
	<div class="col-sm-12">
		<div class="box">
			<div class="box-title">
				<h3>
					<i class="fa fa-calendar"></i>
					Jadwal Rutin HD <?php echo $pasien[0]['nm_pasien']?>
				</h3>
				<div class="actions">
					<a href="index.php?mod=hd&submod=jadwal_new&id=<?php echo md5($daftar[0]['no_daftar'])?>" data-toggle="modal" class='btn'>
					<i class="fa fa-plus-circle"></i> Tambah Jadwal</a>
				</div>
			</div>
		</div>
		<div class="box-content nopadding">
			<div class="containerCal">
					<iframe class="responsive-iframe" src="pages/hd/calendar.php?id=<?php echo $_GET['id']?>"></iframe>
			</div>
		</div>
	</div>
</div>

<?php
	$data = $db->query("select * from tbl_menu where id='".$_GET['id']."'");
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Menu</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small new">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Data Master Menu
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama_menu" name="nama_menu" class="form-control" value="<?php echo $data[0]['nama_menu']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kategori Menu</label>
                                            <div class="col-sm-5">
                                                <select id="kategori" name="kategori" size="1" class="form-control" onchange="subkategori(this.value)">
                                                    <?php
                                                    $layanan = $db->query("select kategori_id as kode, nm_ka_menu as nama from tbl_kat_menu where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        if ($layanan[$i]['kode'] == $data[0]['kategori_id'])
                                                            echo '<option value="'.$layanan[$i]['kode'].'" selected="selected">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                        else
                                                            echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <div id="submenu">
						<?php
							
								$layanan = $db->query("select id as kode, nm_ka_menu as nama from tbl_kat_sub_menu where status_delete='UD' and kategori_id='".$data[0]['kategori_id']."'", 0);
						?>
<select id="subkategoriID" name="subkategoriID" size="1" class="form-control">
	<?php
		if (count($layanan) > 0) {
			echo '<option value="">--Pilih Sub Kategori--</option>';
			for ($i = 0; $i < count($layanan); $i++) {
				if ($data[0]['kategori_sub_id'] == $layanan[$i]['kode']) {
					echo '<option value="'.$layanan[$i]['kode'].'" selected>'.$layanan[$i]['nama'].'</option>';
				}
				else {
					echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['nama'].'</option>';
				}
			}
		}
		else {
			echo '<option value="">--Belum ada sub kategori--</option>';
		}
	?>
</select>
						</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="link" name="link" class="form-control" value="<?php echo $data[0]['link']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
                                                <input type="text" id="ket_kategori" name="ket_kategori" class="form-control" style="width: 350px" value="<?php echo $data[0]['keterangan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Menu" onclick="simpanData(this.form, 'pages/user/menu_update.php')" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
	function subkategori(id) {
		var url = "pages/user/submenu.php";
		var data = {id:id};
		
		$('#submenu').fadeOut();
		$('#submenu').load(url,data, function(){
			$('#submenu').fadeIn('fast');
		});
	}
</script>
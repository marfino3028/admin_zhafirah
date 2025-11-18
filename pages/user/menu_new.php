<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Master Menu
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Master Menu
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama_menu" name="nama_menu" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kategori Menu</label>
                                            <div class="col-sm-5">
                                                <select id="kategori" name="kategori" size="1" class="form-control" onchange="subkategori(this.value)">
                                                    <option value="">--Pilih Kategori--</option>
                                                    <?php
                                                    $layanan = $db->query("select kategori_id as kode, nm_ka_menu as nama from tbl_kat_menu where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-5">
                                                <div id="submenu">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="link" name="link" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="ket_kategori" name="ket_kategori" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Menu" onclick="simpanData(this.form, 'pages/user/menu_insert.php')" />
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
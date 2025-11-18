<?php
	$sub = $db->query("select * from tbl_kat_sub_menu where md5(id)='".$_GET['id']."'", 0);
	//print_r($sub);
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kategori Menu
                </a>
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
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Data Master Kategori Menu
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/user/submenu_kategori_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kategori Menu</label>
                                            <div class="col-sm-10">
                                                <select id="kategori" name="kategori" size="1" class="form-control" required="required">
                                                    <option value="">--Pilih Kategori--</option>
                                                    <?php
                                                    $layanan = $db->query("select id as kode, nm_ka_menu as nama from tbl_kat_menu where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
							if ($sub[0]['kategori_id'] == $layanan[$i]['kode']) { 
                                                        	echo '<option value="'.$layanan[$i]['kode'].'" selected>'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
							}
							else {
								echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
							}
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Sub  Ketegori Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" value="<?php echo $sub[0]['nm_ka_menu']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="keterangan" name="keterangan" class="form-control" value="<?php echo $sub[0]['ket_kategori']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
					    <input type="hidden" name="id" value="<?php echo md5($sub[0]['id'])?>">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Kategori Menu" />
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
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Kamar Inap</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Master Isi Kamar Inap
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
                                        Form Edit Isi Kamar Inap
                                    </h3>
                                </div>
                              	<?php
                              		$data = $db->query("select * from tbl_kelas_ruang where md5(id)='".$_GET['id']."'");
                              	?>
                                <div class="box-content nopadding">
                                    <form action="pages/master/inap_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kelas</label>
                                            <div class="col-sm-10">
                                                <select id="kategori" name="kategori" size="1" class="form-control" required="required">
                                                    <option value="">--Pilih Kelas--</option>
                                                    <?php
                                                    $layanan = $db->query("select id as kode, nama as nama from tbl_kelas");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        if ($data[0]['kelas_id'] == $layanan[$i]['kode']) {
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
                                            <label for="textfield" class="control-label col-sm-2">Nama Ruangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" value="<?php echo $data[0]['nama']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                          	<input type="hidden" name="id" value="<?php echo md5($data[0]['id'])?>" />
                                            <input type="submit" name="simpan" id="simpan" value="Simpan Data" class="btn btn-sm btn-small btn-primary rounded" />
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

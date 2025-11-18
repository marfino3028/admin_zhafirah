<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Radiologi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Persiapan & Inciden</a>
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
                            <div class="box box-bordered box-color">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Persiapan dan Inciden
                                </div>
                                <div class="box-content">
                                    <form action="pages/persiapan/radiologi_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                                        <div class="form-group">
						<label for="textarea" class="control-label col-sm-12"><strong>Persiapan Pelayanan Radiologi</strong></label>
                                        </div>
					<?php
						$data = $db->query("select * from tbl_pemeriksaan order by kategori");
						for ($i = 0; $i < count($data); $i++) {
					?>
                                        <div class="form-group">
						<label for="textarea" class="control-label col-sm-8"><?php echo $data[$i]['kategori'].' - '.$data[$i]['nama']?> </label>
                                        	<div class="col-sm-2">
							<label><input type="radio" name="siap<?php echo $data[$i]['id']?>" value="<?php echo $data[$i]['1']?>" required="required"> &nbsp;<?php echo $data[$i]['1']?></label>
						</div>
                                        	<div class="col-sm-2">
							<label><input type="radio" name="siap<?php echo $data[$i]['id']?>" value="<?php echo $data[$i]['2']?>" required="required"> &nbsp;<?php echo $data[$i]['2']?></label>
						</div>
                                        </div>
					<?php
							echo '<input type="hidden" name="id'.$data[$i]['id'].'" value="'.$data[$i]['id'].'">';
						}
					?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-actions">
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" />
                                                </div>
                                            </div>
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
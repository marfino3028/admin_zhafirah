<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Bed di kamar Inap
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
                            <div class="box box-color box-bordered box-small lightgrey">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Master Bed di Kamar Inap
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/inap_bed_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Kelas</label>
                                            <div class="col-sm-10">
                                                <select id="kelas" name="kelas" size="1" class="form-control" onchange="subkategori(this.value)" required="required">
                                                    <option value="">--Pilih Kelas--</option>
                                                    <?php
                                                    $layanan = $db->query("select * from tbl_kelas");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        echo '<option value="'.$layanan[$i]['id'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].' - Rp. '.number_format($layanan[$i]['tarif']).'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">&nbsp;</label>
                                            <div class="col-sm-10">
                                                <div id="submenu">
                                              		<select id="kelas_ruang" name="kelas_ruang" size="1" class="form-control" disabled="disabled" required="required">
                                                      <option>Pilih Kelas Terlebih dahulu</option>  
                                                  	</select>
                                              	</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Bed</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="bed" name="bed" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Bed" />
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
		var url = "pages/master/kelas_ruang_item.php";
		var data = {id:id};
		
		$('#submenu').fadeOut();
		$('#submenu').load(url,data, function(){
			$('#submenu').fadeIn('fast');
		});
	}
</script>
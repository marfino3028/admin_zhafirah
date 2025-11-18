<script language="javascript">
	function pilihPoli(id) {
		var data = {id:id};
		
		if (id == 'LANGSUNG') { 
			var url = "pages/pendaftaran/view_langsung.php";
		}
		else {
			var url = "pages/pendaftaran/view_not_langsung.php";
		}
		$('#langsung').load(url,data, function(){
			$('#langsung').fadeIn('fast');
		});
	}

function simpanDataDaftar(t, url) {
	document.getElementById('form_karyawan').action = url;
	t.submit();
}
</script>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Data Hubungan Pasien
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
                                        Form Tambah Data Hubungan Keluarga Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/hubungan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Suami/Pegawai</label>
                                            <div class="col-sm-10">
                                                <select id="hub_nomr" name="hub_nomr" size="1" class="form-control">
                                                    <?php
                                                    $dts = $db->query("select * from tbl_hubungan_keluarga where id='".$_GET['id']."'");
                                                    $poli = $db->query("select nomr, nm_pasien from tbl_pasien where status_delete='UD' and nm_pasien <> '' order by nm_pasien");
                                                    for ($i = 0; $i < count($poli); $i++) {
                                                        if ($dts[0]['nomr'] == $poli[$i]['nomr']) {
                                                            echo '<option value="'.$poli[$i]['nomr'].'" selected>'.$poli[$i]['nm_pasien'].'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$poli[$i]['nomr'].'">'.$poli[$i]['nm_pasien'].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Keluarga</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" value="<?php echo $dts[0]['nama']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Hubungan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama_hub" name="nama_hub" class="form-control" style="width: 100%;" value="<?php echo $dts[0]['hubungan']?>" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $dts[0]['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanDataDaftar(this.form, 'pages/pendaftaran/hubungan_update.php')" />
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

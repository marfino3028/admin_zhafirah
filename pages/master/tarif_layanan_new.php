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
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tarif Layanan</a>
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
                                        Form Tambah Data Master Tarif Layanan
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanDatatarif(this.form, 'pages/master/tarif_layanan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis Tarif Layanan</label>
                                            <div class="col-sm-10">
                                                <select id="jenis_layanan" name="jenis_layanan" size="1" onchange="pilih_kategori(this.value)" class="form-control">
                                                    <option value="">--Pilih Jenis Layanan--</option>
                                                    <?php
                                                    $layanan = $db->query("select kode_jns_tarif as kode, nama_jns_tarif as nama from tbl_jns_tarif where status_delete='UD'");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Category Tarif Layanan</label>
                                            <div class="col-sm-10" >
                                                <div id="kategori_layanan">
                                                    <select id="kat_layanan" name="kat_layanan" size="1" class="form-control">
                                                        <option value="">--Pilih Jenis Layanan terlebih dahulu--</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode Tarif</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="kode_tarif" name="kode_tarif" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Pelayanan</label>
                                            <div class="col-sm-10">
                                                    <input type="text" id="nama_pelayanan" name="nama_pelayanan" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Group Tarif Perusahaan</label>                                           
                                            <div class="col-sm-4">
                                                        <select class="form-control" id="gttarif" name="gttarif">
                                                            <option value="">--Pilih Group Tarif--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_gt, nm_gt from tbl_tarif_group where status_delete='UD'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kd_gt'].'">'.$sub[$i]['nm_gt'].'</option>';
                                        					    }
                                        					?>
														</select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2 right" >Poli / Layanan</label>                                           
                                            <div class="col-sm-4">
                                                        <select class="form-control" id="poli" name="poli">
                                                            <option value="">--Pilih Poli/Layanan--</option>
                                        					<?php
                                        					    $sub = $db->query("select kd_poli, nama_poli from tbl_poli where status_delete='UD'");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kd_poli'].'">'.$sub[$i]['nama_poli'].'</option>';
                                        					    }
                                        					?>
														</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-12"><strong>Tarif Rawat Jalan / Outpatient</strong></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif Minimum</label>
                                            <div class="col-sm-4">
                                                    <input type="text" id="tarif_min" name="tarif_min" class="form-control" value="0" onKeyUp="allnumeric(document.form_karyawan.tarif_min)" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Harga Modal</label>
                                            <div class="col-sm-4">
                                                    <input type="text" id="harga_modal" name="harga_modal" class="form-control" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tarif Maksimum</label>
                                            <div class="col-sm-4">
                                                    <input type="text" id="tarif_max" name="tarif_max" class="form-control" value="0" onKeyUp="allnumeric(document.form_karyawan.tarif_max)" />
                                            </div>
					                        <label for="textfield" class="control-label col-sm-6">Harus Menggunakan Angka</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2"><strong>Configurasi Untuk Hasil Lab</strong></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Satuan</label>
                                            <div class="col-sm-4">
                                                    <input type="text" id="satuan" name="satuan" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Nilai Normal</label>
                                            <div class="col-sm-4">
                                                    <input type="text" id="normal" name="normal" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                                <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Tarif Layanan" onclick="simpanData(this.form, 'pages/master/tarif_layanan_insert.php')" />
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
	function pilih_kategori(id) {
        console.log('cau')
		var url  = 'pages/master/kategori_tarif.php';
		var data = {id:id};
		//$('.loading').fadeIn();
		$('#kategori_layanan').fadeOut();
		$('#kategori_layanan').load(url,data, function(){
			//$('.loading').fadeOut('fast');
			$('#kategori_layanan').fadeIn('fast');
		});
	}

	function allnumeric(inputtxt)
	{
		var numbers = /^[0-9]+$/;
		if(inputtxt.value.match(numbers))
		{
			//alert('Your Registration number has accepted....');
			inputtxt.focus();
			return true;
		}
		else
		{
			alert('Please input numeric characters only');
			inputtxt.focus();
			inputtxt.value = "";
			return false;
		}
	} 

</script>
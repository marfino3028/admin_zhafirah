<?php
	$noum = $db->queryItem("select no_um from tbl_um where left(right(no_um, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $db->queryItem("select max(right(no_um, 3)*1) from tbl_um where left(right(no_um, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'UM-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
      	//alert(id);
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
  
  	function pilih_hubungan(id) {}
  
  	function TotalAllBayar() {
		var url = "pages/kasir/metode_bayar.php";
		var metode = document.getElementById('metode').value;
		var data = {metode:metode};

		if (metode == "") {
			document.getElementById('totalAll').innerHTML = '';
		}
		else {
			document.getElementById('totalAll').innerHTML = 'Tunggu sebentar ....';
			$('#totalAll').load(url,data, function(){
				$('#totalAll').fadeIn('fast');
			});
		}
    }
  
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Uang Muka</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
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
                                        Input Uang Muka Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/kasir/um_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Uang Muka</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_daftar" name="no_daftar" class="form-control" value="<?php echo $nomr?>" maxlength="6"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <select id="nodaftar" class="form-control" name="nodaftar" size="1" onchange="CariPasien(this.value)" required="required">
                                                            <option value="">--NoMR--</option>
                                                            <?php
                                                            $daft = $db->query("select * from tbl_pendaftaran where status_pasien='OPEN' and no_daftar not in (select no_daftar from tbl_um group by no_daftar)");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                $nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$daft[$i]['nomr']."'");
                                                                echo '<option value="'.$daft[$i]['no_daftar'].'###'.$daft[$i]['nomr'].'">'.$daft[$i]['nomr'].'-'.$nama.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <select id="metode" name="metode" size="1" onchange="TotalAllBayar()" class="form-control" required="required">
                                                            <option value="">--Metode Bayar--</option>
                                                            <option value="CASH">Cash</option>
                                                            <option value="ASS">Asuransi Perusahaan</option>
                                                            <option value="CC">Kartu Kredit</option>
                                                            <option value="DEBIT">Debit</option>
                                                        </select>
                                                    </div>
                                                  	<div id="totalAll"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nilai Uang Muka</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nilai" name="nilai" class="form-control" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative; margin-top: 10px; margin-left: 10px; margin-right: 10px; margin-bottom: 10px;"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="data_pasien"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                          	<input type="hidden" >
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Uang Muka" />
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

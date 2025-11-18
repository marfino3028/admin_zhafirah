<?php

	$ceknmr = $db->queryItem("select max(right(no_fisio, 3)*1) from tbl_fisio where left(right(no_fisio, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'FIS-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
</script>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Penunjang Medis</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)"> Fisiotherapi</a>
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
                                        Form Tambah Data Transaksi Fisiotherapi
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/penunjang_medis/input_rad_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Fisiotherapi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_resep" name="no_resep" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">NoMR</label>
                                                    <div class="col-sm-8">
                                                        <select id="nodaftar" name="nodaftar" size="1" class="form-control" onchange="CariPasien(this.value)">
                                                            <option value="">--NoMR--</option>
                                                            <?php
                                                            $daft = $db->query("select * from tbl_pendaftaran where status_pasien='OPEN' and status_delete='UD'");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                $nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$daft[$i]['nomr']."'");
                                                                echo '<option value="'.$daft[$i]['no_daftar'].'###'.$daft[$i]['nomr'].'">'.$daft[$i]['nomr'].'-'.$nama.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Fisioterapi" onclick="simpanData(this.form, 'pages/penunjang_medis/input_fisio_insert.php')" />
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

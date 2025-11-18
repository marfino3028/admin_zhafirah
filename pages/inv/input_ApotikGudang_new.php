<?php

	$ceknmr = $db->queryItem("select max(right(no_ro_gudang, 3)*1) from tbl_ro_to_gudang where left(right(no_ro_gudang, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'ROAG-'.date("dmY").$ceknmr;
	$unit = $db->queryItem("select nilai from tbl_config where kode='SBU'");
	$unit = $db->queryItem("select nama from tbl_sbu where kode='$unit'");
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
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    Permintaan Obat Dari Apotik Ke Gudang
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
                                        Form Tambah Data Permintaan Obat dari Apotik ke Gudang
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/inv/input_ApotikGudang_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">No. Request</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" id="no_ro" name="no_ro" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Tanggal Request</label>
                                                    <div class="col-sm-2">
                                                        <input type="text" id="tgl_input" name="tgl_input" class="form-control" value="<?php echo date("d-m-Y")?>" readonly="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Permintaan Unit</label>
                                                    <div class="col-sm-10">
                                                <select id="unit" name="unit" size="1" class="chosen-select form-control" style="width: 100%;">
                                                    <option value="">--Pilih Unit--</option>
                                                    <?php
							$unit = $db->query("select * from tbl_unit");
							for ($i = 0; $i < count($unit); $i++) {
							    echo '<option value="'.$unit[$i]['nama_unit'].'">'.$unit[$i]['nama_unit'].' - '.$unit[$i]['lantai_nama'].'</option>';
							}
						    ?>
                                                </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Unit yang diminta</label>
                                                    <div class="col-sm-10">
                                                <select id="unit_diminta" name="unit_diminta" size="1" class="chosen-select form-control" style="width: 100%;">
                                                    <option value="">--Pilih Unit--</option>
                                                    <?php
							$unit = $db->query("select * from tbl_unit");
							for ($i = 0; $i < count($unit); $i++) {
							    echo '<option value="'.$unit[$i]['nama_unit'].'">'.$unit[$i]['nama_unit'].' - '.$unit[$i]['lantai_nama'].'</option>';
							}
						    ?>
                                                </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Jenis Permintaan</label>
                                                    <div class="col-sm-10">
                                                <select id="jenis" name="jenis" size="1" class="chosen-select form-control" style="width: 100%;">
                                                    <option value="">--Pilih Jenis--</option>
                                                    <option value="OBATALKES">Obat/Alkes</option>
                                                    <option value="LOGISTIK UMUM">Logistik Umum</option>
                                                </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Request" onclick="simpanData(this.form, 'pages/inv/input_ApotikGudang_insert.php')" />
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

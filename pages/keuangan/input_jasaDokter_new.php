<?php

	$ceknmr = $db->queryItem("select max(right(no_bayar, 3)*1) from tbl_bayar_dokter where left(right(no_bayar, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'DKT-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/keuangan/view_jasaDokter.php";
		var d1 = document.getElementById('mulai').value;
		var d2 = document.getElementById('selesai').value
		var data = {dokter:id, d1:d1, d2:d2};
		
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
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Input Jasa Dokter
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
                                        Form Tambah Data Transaksi Jasa Dokter
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/keuangan/input_jasaDokter_insert.php" method="post" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Pembayaran</label>
                                                    <div class="col-sm-8">
                                                            <input type="text" id="no_bayar" name="no_bayar" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Periode Awal</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="mulai" name="mulai" value="<?php echo date("m/d/Y")?>" size="10" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Sampai dengan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="selesai" name="selesai" value="<?php echo date("m/d/Y")?>" size="10" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Dokter</label>
                                                    <div class="col-sm-8">
                                                        <select id="kode_dokter" name="kode_dokter" size="1" class="form-control" onchange="CariPasien(this.value)">
                                                            <option value="">--Dokter--</option>
                                                            <?php
                                                            $daft = $db->query("select nama_dokter, kode_dokter from tbl_dokter where status_delete='UD'", 0);
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="'.$daft[$i]['kode_dokter'].'">'.$daft[$i]['nama_dokter'].'</option>';
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
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded"  value="Simpan Data Jasa Dokter" />
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
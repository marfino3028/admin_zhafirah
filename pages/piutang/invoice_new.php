<?php

	$ceknmr = $db->queryItem("select max(right(no_inv, 3)*1) from tbl_invoice where left(right(no_inv, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'INV-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function GetData(id) {
		//var no_inv = document.getElementById('no_inv').value;
		//var tgl_input = document.getElementById('tgl_input').value;
		//var kirim = document.getElementById('kirim').value;
		//var jatuh_tempo = document.getElementById('jatuh_tempo').value;
		var url = "pages/piutang/invoice_asuransi.php";
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
                <a href="javascript:void(0)">Piutang</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembuatan Invoice
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
                                        Form Tambah Data Invoice
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Invoice</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_inv" name="no_inv" class="form-control" value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_input" name="tgl_input" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Kirim</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_kirim" name="tgl_kirim" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Jatuh Tempo</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Asuransi</label>
                                                    <div class="col-sm-8">
                                                        <select id="asuransi" name="asuransi" size="1" class="form-control" onchange="GetData(this.value)">
                                                            <option value="">--Metode Asuransi--</option>
                                                            <?php
                                                            $data = $db->query("select distinct kode_perusahaan, nama_perusahaan from  tbl_kasir where status_inv='BLM' and kode_perusahaan not in ('PPP031', 'JJJ030')");
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                echo '<option value="'.$data[$i]['kode_perusahaan'].'">'.$data[$i]['nama_perusahaan'].'</option>';
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
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Invoice" onclick="simpanData(this.form, 'pages/piutang/invoice_insert.php')" />
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
<?php

	$ceknmr = $db->queryItem("select max(right(no_transfer, 3)*1) from tbl_transfer where left(right(no_transfer, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'TOGA-'.date("dmY").$ceknmr;
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Distribusi Barang dari Gudang ke Depo
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
					Distribusi Barang dari Gudang ke Depo
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/inv/transfer_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Transfer</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_penerimaan" name="no_penerimaan" class="form-control"  value="<?php echo $nomr?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Transfer</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgl_input" name="tgl_input" class="form-control" value="<?php echo date("d-m-Y")?>" readonly="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Request Order</label>
                                                    <div class="col-sm-8">
                                                        <select id="no_po" name="no_po" size="1" class="form-control" onchange="CariPasien(this.value)">
                                                            <option value="">--Pilih No. Req--</option>
                                                            <?php
                                                            $daft = $db->query("select no_ro_gudang from tbl_ro_to_gudang where status_delete='UD' and total_permintaan > 0 and status_pakai='BLM' order by tgl_input_ro_gudang desc");
                                                            for ($i = 0; $i < count($daft); $i++) {
                                                                echo '<option value="'.$daft[$i]['no_ro_gudang'].'">'.$daft[$i]['no_ro_gudang'].'</option>';
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
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Distribusi" onclick="simpanData(this.form, 'pages/inv/transfer_insert.php')" />
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
	function CariPasien(id) {
		var url = "pages/inv/view_ro_gudang.php";
		var data = {id:id};
		if (id == "" ) {
			document.getElementById('data_pasien').innerHTML = '';
		}
		else {
			$('.loading').fadeIn();
			$('#data_pasien').fadeOut();
			$('#data_pasien').load(url,data, function(){
				$('.loading').fadeOut('fast');
				$('#data_pasien').fadeIn('fast');
			});
		}
	}

	function UpdateQTY(id) {
		var url = "pages/inv/view_qty_form.php";
		var baris = "harga" + id;
		var ket = "keterangan" + id;
		var data = {id:id};
		$('.loading').fadeIn();
		$('#'+baris).fadeOut();
		$('#'+baris).load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#'+baris).fadeIn('fast');
		});
		document.getElementById(ket).innerHTML = "Tekan Enter untuk Simpan";
	}

	function SimpanQTY(nilai, id, e) {
            if (e.key === "Enter") {
                e.preventDefault(); // Supaya tidak submit form
                let form = e.target.form;
                let index = Array.prototype.indexOf.call(form, e.target);
		//alert(nilai + " dan " + id);

		var url = "pages/inv/view_qty_update.php";
		var baris = "harga" + id;
		var ket = "keterangan" + id;
		var data = {id:id, nilai: nilai};
		$('.loading').fadeIn();
		$('#'+baris).fadeOut();
		$('#'+baris).load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#'+baris).fadeIn('fast');
		});
		document.getElementById(ket).innerHTML = "";

            }
	}
</script>

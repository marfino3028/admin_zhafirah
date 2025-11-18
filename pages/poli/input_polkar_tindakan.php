<?php
	$data = $db->query("select * from tbl_polkar where id='".$_GET['id']."'");
	$dataTdk = $db->query("select no_daftar, nomr from tbl_resep where id='".$_GET['id']."'", 0);
	$noPolkar = $data[0]['no_polkar'];
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
	
	function simpanObat() {
		var id = '<?php echo $_GET['id']?>';
		var polkar = document.getElementById('no_polkar').value;
		var nama = document.getElementById('nama').value;
		var obat = document.getElementById('obat').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/poli/input_polkar_detail.php";
		var data = {id:id, polkar:polkar, nama:nama, obat:obat, qty:qty};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	
	}
	
	function CreateRacikan(id) {
		if (id == 'RACIK') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_polkar').value;
			var url = "pages/poli/input_polkar_detail_racik.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else {
			var url = "pages/poli/input_polkar_qty.php";
			var data = {id:id};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
	}
	
	function TambahRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_polkar').value;
		var racikan = document.getElementById('nRacikan').value;
		var url = "pages/poli/input_polkar_detail_racik_insert.php";
		var data = {id:ids, resep:resep, racikan:racikan};
		
		$('.loading').fadeIn();
		$('#DataAdd').load(url,data, function(){
			$('#DataAdd').fadeIn('fast');
		});
		
		var data1 = {id:ids, resep:resep};
		var url1 = "pages/farmasi/input_jual_obat_detail2.php";
		$('#data_pasien').load(url1,data1, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function simpanObatRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_polkar').value;
		var obat = document.getElementById('obatR').value;
		var qty = document.getElementById('qty').value;
		var racikan = document.getElementById('id_racikan').value;
		var url = "pages/poli/input_polkar_detail_racik_obat_insert.php";
		var data = {id:ids, resep:resep, obat:obat, qty:qty, racikan:racikan};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}

	function reload_ulang() {
		location.reload();
	}

</script>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Poli</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Poli Karyawan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat Poli Karyawan</a>
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
                                        Form Tambah Data Obat Poli Karyawan
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Polkar</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_polkar']?>
                                                        <input type="hidden" id="no_polkar" name="no_polkar" class="form-control"  value="<?php echo $data[0]['no_polkar']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nama']?>
                                                        <input type="hidden" id="nama" name="nama" class="form-control"  value="<?php echo $data[0]['nama']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y", strtotime($data[0]['tgl_input_polkar']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Obat/Tindakan</label>
                                                    <div class="col-sm-8">
                                                        <select id="obat" name="obat" size="1" class="form-control" tabindex="1" onchange="CreateRacikan(this.value)">
                                                            <option value="">--Pilih Obat--</option>
                                                            <option value="RACIK" style="color:#244EF4; font-weight: bold">Obat Racikan</option>
                                                            <option value="NRACIK" disabled="disabled">Obat Non Racikan</option>
                                                            <?php
                                                            $obat = $db->query("select * from tbl_obat where status_delete='UD'");
                                                            for ($i = 0; $i < count($obat); $i++) {
                                                                echo '<option value="NR###'.$obat[$i]['kode_obat'].'">'.$obat[$i]['nama_obat'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="DataAdd">
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-4">Qty / Jumlah</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="qty" id="qty" size="5" class="form-control text-right" tabindex="3" />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="button" value="Simpan Obat" onclick="simpanObat()" class="btn btn-sm btn-small btn-primary rounded" />
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Poli Karyawan" onclick="simpanData(this.form, 'index.php?mod=poli&submod=karyawan')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">

                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Nama Obat</th>
                                                            <th style="width:30px">Sat</th>
                                                            <th style="width:30px">QTY</th>
                                                            <th style="width:40px">Harga</th>
                                                            <th style="width:40px">Total</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from  tbl_polkar_detail where status_delete='UD' and jenis='NR' and polkar_id='".$_GET['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['nama_obat']?></td>
                                                                <td><?php echo $satuan?></td>
                                                                <td><div align="right"><?php echo $data[$i]['qty']?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $sbttl = $sbttl + $data[$i]['total'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">SubTotal</td>
                                                            <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    &nbsp;
                                                    <?php
                                                    $resep = $db->query("select * from  tbl_polkar_racikan where no_polkar='".$noPolkar."' and status_delete='UD'", 0);
                                                    for ($j = 0; $j < count($resep); $j++) {

                                                        ?>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Obat</th>
                                                                <th style="width:30px">Sat</th>
                                                                <th style="width:30px">QTY</th>
                                                                <th style="width:40px">Harga</th>
                                                                <th style="width:40px">Total</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="6" style="height: 10px;"><?php echo '<p align="left" style="margin-top: 0px; margin-bottom: 0px; margin-left: 5px; font-weight: bold">Obat Racikan : '.$resep[$j]['nama'].'</p>'?></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikanH_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $data = $db->query("select * from tbl_polkar_detail where status_delete='UD' and jenis='R' and racikan_id='".$resep[$j]['id']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['nama_obat']?></td>
                                                                    <td><?php echo $satuan?></td>
                                                                    <td><?php echo $data[$i]['qty']?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                                    <td class="text-center">
                                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
                                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $sbttl2[$j] = $sbttl2[$j] + $data[$i]['total'];
                                                            }
                                                            $tambahan = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                            $totalRacikan = $tambahan + $sbttl2[$j];
                                                            ?>
                                                            <tr>
                                                                <td colspan="5">&nbsp;</td>
                                                                <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($totalRacikan)?></div></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                    ?>
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
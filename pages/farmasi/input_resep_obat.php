<?php
	ini_set("display_errors", 0);

	$data = $db->query("select * from tbl_resep where id='".$_GET['id']."'");
	if ($data[0]['id'] < 1) {
	    $data = $db->query("select * from tbl_resep where no_daftar='".$_GET['id02']."'");
    	if ($data[0]['id'] < 1) {
        	$ceknmr = $db->queryItem("select max(right(no_resep, 3)*1) from tbl_resep where left(right(no_resep, 11), 8)='".date("dmY")."'", 0);
        	$ceknmr = $ceknmr + 1;
        	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
        	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
        	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
        	$nomr = 'R-'.date("dmY").$ceknmr;
        	$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_GET['id01']."'", 0);
    		$insert = $db->query("insert into  tbl_resep (no_resep, nomr, nama, tgl_input, total_harga, no_daftar, diagnosa) values ('".$nomr."', '".$_GET['id01']."', '".$nama."', '".date("Y-m-d")."', '0', '".$_GET['id02']."', 'AUTO')", 0);
    		//echo '<br><br>ini hanya test<br><br>';
    		$id = $db->queryItem("select id from tbl_resep order by id desc", 0);
    		//echo $id;
    		$_GET['id'] = $id;
    		$data = $db->query("select * from tbl_resep where id='".$_GET['id']."'");
	    }
	    else {
	        $_GET['id'] = $data[0]['id'];
	    }
	}
	$dataSrc = $db->query("select * from tbl_resep where id='".$_GET['id']."'");
	$dataTdk = $db->query("select no_daftar, nomr from tbl_resep where id='".$_GET['id']."'", 0);
	//$_GET['id'] = $data[0]['id'];
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
	
	function clearBox(id) {
		document.getElementById(id).innerHTML = "";
	}

	function simpanObat() {
		var id = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_resep').value;
		var depo = document.getElementById('depo').value;
		var obat = document.getElementById('obat').value;
		var qty = document.getElementById('qty').value;
		var fre = document.getElementById('frekuensi').value;
		var dur = document.getElementById('durasi').value;
		var wk1 = document.getElementById('waktu1').value;
		var wk2 = document.getElementById('waktu2').value;
		var wk3 = document.getElementById('waktu3').value;
		var wk4 = document.getElementById('waktu4').value;
		var apd = document.getElementById('apd').value;
		var tam = document.getElementById('tambahan').value;
		var url = "pages/farmasi/input_resep_obat_detail.php";
		var data = {id:id, resep:resep, obat:obat, depo:depo, qty:qty, fre:fre, dur:dur, wk1:wk1, wk2:wk2, wk3:wk3, wk4:wk4, apd:apd, tam:tam};

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
			var resep = document.getElementById('no_resep').value;
			var url = "pages/farmasi/input_resep_obat_detail_racik.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else if (id == 'MEDIS') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_resep').value;
			var url = "pages/farmasi/input_resep_obat_tindakan.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else if (id == 'ALKES') {
			var ids = '<?php echo $_GET['id']?>';
			var resep = document.getElementById('no_resep').value;
			var url = "pages/farmasi/input_resep_obat_alkes.php";
			var data = {id:ids, resep:resep};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
		else {
			var url = "pages/farmasi/input_resep_obat_qty.php";
			var data = {id:id};
			
			$('.loading').fadeIn();
			$('#DataAdd').load(url,data, function(){
				$('#DataAdd').fadeIn('fast');
			});
		}
	}

	function TambahRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var noPendaftaran = document.getElementById('noPendaftaran').innerHTML;
		var resep = document.getElementById('no_resep').value;
		var racikan = document.getElementById('nRacikan').value;
		var url = "pages/farmasi/input_resep_obat_detail_racik_insert.php";
		var data = {id:ids, resep:resep, racikan:racikan, noPendaftaran:noPendaftaran };
		$('.loading').fadeIn();
		$('#DataAdd').load(url,data, function(){
			$('#DataAdd').fadeIn('fast');
		});
		
		var data1 = {id:ids, resep:resep};
		var url1 = "pages/farmasi/input_resep_obat_detail2.php";
		$('#data_pasien').load(url1,data1, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function simpanObatRacikan() {
		var ids = '<?php echo $_GET['id']?>';
		var noPendaftaran2 = document.getElementById('noPendaftaran').innerHTML;
		var resep = document.getElementById('no_resep').value;
		var obat = document.getElementById('obatR').value;
		var qty = document.getElementById('qty').value;
		var depo = document.getElementById('depo').value;
		var racikan = document.getElementById('id_racikan').value;
		var url = "pages/farmasi/input_resep_obat_detail_racik_obat_insert.php";
		var data = {id:ids, resep:resep, obat:obat, qty:qty, depo:depo, racikan:racikan, noPendaftaran2:noPendaftaran2};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}

	function PilihTindakan(id) {
		var url = "pages/farmasi/input_resep_obat_tindakan_tarif.php";
		var data = {id:id};
		
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	}	
	
	function PilihAlkes(id) {
		var url = "pages/farmasi/input_resep_obat_alkes_tarif.php";
		var data = {id:id};
		
		$('#TarifAlkes').load(url,data, function(){
			$('#TarifAlkes').fadeIn('fast');
		});
	}	

	function TambahTindakan() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_resep').value;
		var obat = document.getElementById('obat_tindakan').value;
		var tarif = document.getElementById('tTindakan').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/farmasi/input_resep_obat_tindakan_insert.php";
		var data = {id:ids, resep:resep, obat:obat, tarif:tarif, qty:qty};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}

	function TambahAlkes() {
		var ids = '<?php echo $_GET['id']?>';
		var resep = document.getElementById('no_resep').value;
		var obat = document.getElementById('obat_tindakan').value;
		var tarif = document.getElementById('tAlkes').value;
		var url = "pages/farmasi/input_resep_obat_alkes_insert.php";
		var data = {id:ids, resep:resep, obat:obat, tarif:tarif};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
</script>
<!---- JS SELECT2 --->
<script language="javascript">
	$(document).ready(function() {
		$("#obat").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/obat.php",
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 50,
		        data: function (term) {
		            return {
		                term: term
		            };
		        },
		        results: function (data) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        text: item.itemName,
		                        id: item.id
		                    }
		                })
		            };
		        }, 
		    }
		});
	});

</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Farmasi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Resep Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Resep Pasien</a>
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
                                        Form Tambah Data Detail Resep Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Resep</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_resep']?>
                                                        <input type="hidden" id="no_resep" name="no_resep" class="form-control"  value="<?php echo $data[0]['no_resep']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nomr']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nama']?>
                                                    </div>
                                                </div>
 						<div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No.Daftar</label>
                                                    <div class="col-sm-8">
                                                        <span id="noPendaftaran"><?php echo $data[0]['no_daftar'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y", strtotime($data[0]['tgl_input']))?>
                                                    </div>
                                                </div>

						<div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Depo</label>
                                                    <div class="col-sm-8">
                                                        <select id="depo" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Apotik" selected>Apotik</option>
                                                            <option value="Fisioterapi">Fisioterapi</option>
                                                            <option value="Keperawatan">Keperawatan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Obat/Tindakan</label>
                                                    <div class="col-sm-8">
                                                        <!--- SELECT 2 ELEMENT---><input type="text" id="obat" name="obat" onchange="CreateRacikan(this.value)" style="width: 100%;" >
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
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Resep" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=input_resep')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Nama Obat</th>
							    <th>Aturan / Cara Pakai</th>
                                                            <th style="width:30px">Sat</th>
                                                            <th style="width:30px">QTY</th>
                                                            <th style="width:40px">Harga</th>
                                                            <th style="width:40px">Total</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from tbl_resep_detail where status_delete='UD' and resep_id='".$_GET['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['nama_obat']?></td>
								<td><?php echo $data[$i]['frekuensi'].'/'.$data[$i]['apd'].'/'.$data[$i]['waktu_minum']?></td>
                                                                <td><?php echo $satuan?></td>
                                                                <td><div align="right"><?php echo $data[$i]['qty']?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
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
                                                    $resep = $db->query("select * from tbl_racikan where no_resep='".$dataSrc[0]['no_resep']."' and status_delete='UD'", 0);
                                                    for ($j = 0; $j < count($resep); $j++) {
                                                        $data = $db->query("select * from tbl_racikan_detail where status_delete='UD' and racikanId='".$resep[$j]['id']."'", 0);

                                                        ?>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Obat Racikan</th>
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
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obatRacikans_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if (count($data) > 0) {
                                                                $data = $db->query("select * from tbl_racikan_detail where status_delete='UD' and racikanId='".$resep[$j]['id']."'", 0);
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
                                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
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
                                                                <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                        &nbsp;
                                                        <?php
                                                    }
                                                    $tindakan = $db->query("select * from tbl_tindakan where no_daftar='".$dataTdk[0]['no_daftar']."' and nomr='".$dataTdk[0]['nomr']."' and status_delete='UD'", 0);
                                                    if (count($tindakan) > 0) {
                                                        echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Daftar Tindakan Medis : </p>';
                                                        ?>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Tindakan</th>
                                                                <th style="width:40px">Tarif</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            for ($i = 0; $i < count($tindakan); $i++) {
                                                                $tindakan[$i]['nama_tindakans'] = $db->queryItem("select nama_pelayanan from tbl_tarif where kode_tarif='".$tindakan[$i]['kode_tarif']."'", 0);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $tindakan[$i]['nama_tindakans']?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($tindakan[$i]['tarif'])?></div></td>
                                                                    <td class="text-center">
                                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_tindakan_delete.php?id=<?php echo $tindakan[$i]['id'].'&ids='.$_GET['id']?>';">
                                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $tTindakan = $tTindakan + $tindakan[$i]['tarif'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="2">Sub Total</td>
                                                                <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($tTindakan)?></div></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        &nbsp;
                                                        <?php
                                                    }

                                                    $alkes = $db->query("select * from tbl_alkes where no_daftar='".$dataTdk[0]['no_daftar']."' and nomr='".$dataTdk[0]['nomr']."' and status_delete='UD'", 0);
                                                    if (count($alkes) > 0) {
                                                        echo '<p align="left" style="margin-top: 10px; margin-left: 5px; font-weight: bold">Daftar Alkes : </p>';
                                                        ?>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Alkes</th>
                                                                <th style="width:40px">Tarif</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            for ($i = 0; $i < count($alkes); $i++) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $alkes[$i]['nama_alkes']?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($alkes[$i]['tarif'])?></div></td>
                                                                    <td class="text-center">
                                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_alkes_delete.php?id=<?php echo $alkes[$i]['id'].'&ids='.$_GET['id']?>';">
                                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $tAlkes = $tAlkes + $alkes[$i]['tarif'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="2">Sub Total</td>
                                                                <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($tAlkes)?></div></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        &nbsp;
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
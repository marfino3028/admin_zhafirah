<?php

	$data = $db->query("select * from tbl_fisio where id='".$_GET['id']."'");
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
	
	function TampilHarga(kode) {
		document.getElementById('TarifTindakan').innerHTML = 'Tunggu....';
		var url = "pages/penunjang_medis/info_Tarif.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakanFis() {
		var id = document.getElementById('idFisio').value;
		var no_fisio = document.getElementById('no_fisio').value;
		var nomr = document.getElementById('nomr').value;
		var nama = document.getElementById('nama_pasien').value;
		var fis = document.getElementById('fis').value;
		var tarif = document.getElementById('tarifNo').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/penunjang_medis/simpanFisioTindakan.php";
		var data = {id:id, no_fisio:no_fisio, nomr:nomr, nama:nama, fis:fis, tarif:tarif, qty: qty};

		if (tarif > 0) {
			document.getElementById('data_pasien').innerHTML = 'Tunggu....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
		else {
			alert("Silahkan Pilih Tindakan Fisioterapi terlebih dahulu");
		}
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#fis").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/fisio.php",
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
                <a href="javascript:void(0)">Penunjang Medis</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)"> Fisiotherapi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Tindakan Fisioterapi</a>
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
                                        Form Tambah Data Detail Tindakan Fisioterapi
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Fisioterapi </label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_fisio']?>
                                                        <input type="hidden" id="no_fisio" name="no_fisio" value="<?php echo $data[0]['no_fisio']?>" />
                                                        <input type="hidden" id="idFisio" name="idFisio" value="<?php echo $data[0]['id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nomr']?>
                                                        <input type="hidden" id="nomr" name="nomr" value="<?php echo $data[0]['nomr']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nama']?>
                                                        <input type="hidden" id="nama_pasien" name="nama_pasien" value="<?php echo $data[0]['nama']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y", strtotime($data[0]['tgl_insert']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Tindakan </label>
                                                    <div class="col-sm-8">
							<input type="text" id="fis" id="fis" onchange="TampilHarga(this.value)" style="width: 210px" >
                                                    </div>
                                                </div>
                                                <div id="DataAdd">
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-4">Tarif</label>
                                                        <div class="col-sm-8">
                                                            <div id="TarifTindakan" style="margin-bottom: 4px; margin-top: 4px;">
                                                                <input type="text" name="tarif" id="tarif" size="5" value="0" class="form-control text-right" tabindex="3" readonly="" />
                                                                <input type="hidden" name="tarifNo" id="tarifNo" value="0" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-4">QTY</label>
                                                        <div class="col-sm-8">
                                                            <div id="TarifTindakanQTY">
                                                                <input type="text" name="qty" id="qty" size="5" value="1" class="form-control text-right" tabindex="3" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="button" value="Simpan Tindakan" onclick="simpanTindakanFis()" class="btn btn-sm btn-small btn-primary rounded"  />
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Fisioterapi" onclick="simpanData(this.form, 'index.php?mod=penunjang_medis&submod=fisiotherapiInput')" />
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Description</th>
                                                            <th>QTY</th>
                                                            <th>Tarif</th>
                                                            <th>Total</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from tbl_fisio_detail where status_delete='UD' and no_fisio='".$data[0]['no_fisio']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['nama_tindakan'].' - '.$kategori?></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['tarif_dasar'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['tarif'])?></div></td>
                                                                <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/fisio_tindakan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                                                            </tr>
                                                            <?php
                                                            $sbttl = $sbttl + $data[$i]['tarif'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">SubTotal</td>
                                                            <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
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
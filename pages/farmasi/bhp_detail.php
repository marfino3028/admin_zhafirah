<?php

	$data = $db->query("select * from tbl_bhp where md5(id)='".$_GET['id']."'");
	$nama_paket = $data[0]['nm_bhp'];
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
		var url = "pages/penunjang_medis/obat_bhp.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakanLab() {
		var id = document.getElementById('idLab').value;
		var nama = document.getElementById('nm_bhp').value;
		var tarif = document.getElementById('tarifNo').value;
		var kode = document.getElementById('kode').value;
		var qty = document.getElementById('qty').value;
		var url = "pages/farmasi/bhp_simpanItemObat.php";
		var data = {id:id, nama:nama, tarif:tarif, qty:qty, kode:kode};
		
		if (tarif > 0) {
			document.getElementById('data_pasien').innerHTML = 'Tunggu....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
		else {
			alert("Silahkan Pilih Tindakan Laboratorium terlebih dahulu-" + tarif);
		}
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#lab").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/bhp_obat.php",
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
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Paket BHP</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Paket BHP</a>
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
                                        <i class="fa fa-edit"></i> Formulir Detail Paket BHP
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, '')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Paket</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nm_bhp']?>
                                                        <input type="hidden" id="no_lab" name="no_lab" value="<?php echo $data[0]['nm_bhp']?>" />
                                                        <input type="hidden" id="idLab" name="idLab" value="<?php echo $data[0]['id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Deskripsi</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['des_bhp']?>
                                                        <input type="hidden" id="nm_bhp" name="nm_bhp" value="<?php echo $data[0]['nm_bhp']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y")?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Obat</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="lab" id="lab" onchange="TampilHarga(this.value)" style="width: 210px" >
                                                    </div>
                                                </div>
                                                <div id="DataAdd">
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-4">Tarif</label>
                                                        <div class="col-sm-8">
                                                            <div id="TarifTindakan">
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
                                                        <input type="button" value="Tambahkan Obat" onclick="simpanTindakanLab()" class="btn btn-sm btn-small btn-primary rounded" />
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Paket BHP" onclick="simpanData(this.form, 'index.php?mod=farmasi&submod=bhp')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                    <div id="data_pasien">	
                                                      	<p style="margin-top: 15px; margin-left: 15px; font-size: 18px;">Daftar Obat untuk Paket <?php echo $nama_paket?></p>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Kode</th>
                                                                <th>Nama Obat</th>
                                                                <th>Satuan</th>
                                                                <th>Harga Beli</th>
                                                                <th>Qty</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_bph_detail where bphID='".$data[0]['id']."'");
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['kode_obat'] ?></td>
                                                                    <td><?php echo $data[$i]['nama_obat'] ?></td>
                                                                    <td><?php echo $data[$i]['satuan'] ?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['harga_beli'])?></div></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                                                                    <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/bph_detail_delete.php?id=<?php echo md5($data[$i]['id']).'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                                                                </tr>
                                                                <?php
                                                                $sbttl = $sbttl + $data[$i]['qty'];
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td colspan="6">Total QTY Obat dalam Paket <?php echo $nama_paket?></td>
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
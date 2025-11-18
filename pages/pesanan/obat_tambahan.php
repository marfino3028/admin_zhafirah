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
		var url = "pages/pesanan/obat_get_tarif.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakan() {
		var url = "pages/pesanan/obat_simpan.php";
		var data = $('#form').serialize();
		
		$('#data_pasien').html('Loading ....');
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#Tarif_Id").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/obat_pesan.php",
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
                <a href="javascript:void(0)">Transaksi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pesanan Obat</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Obat</a>
                <i class="fa fa-angle-right"></i>
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
                                        Form Tambah Pesanan Obat
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pesanan/obat_simpan_add.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form" id="form" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="textfield" class="control-label">Silahkan Pilih Obat dibawah</label>
                                                        <input type="text" name="Tarif_Id" id="Tarif_Id" onchange="TampilHarga(this.value)" style="width: 100%;"  >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="textfield" class="control-label col-sm-4">Tarif / Harga</label>
                                                        <div class="col-sm-8" id="TarifTindakan">
                                                        	<input type="text" name="Tarif" id="Tarif" size="5" value="0" style="text-align: right" tabindex="3" readonly="" class="form-control" />
                                                        	<input type="hidden" name="tarifNo" id="tarifNo" value="0" />
                                                         </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <label for="textfield" class="control-label col-sm-4">QTY</label>
                                                        <div class="col-sm-8" id="TarifTindakanQTY">
                                                        	<input type="text" name="Qty" id="Qty" size="5" value="1" style="text-align: right" tabindex="3" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="submit" value="Simpan Obat" class="btn btn-sm btn-small btn-primary rounded" />
                                                        <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
		                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Pesanan" onclick="location.replace('index.php?mod=pesanan&submod=obat')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
						<p style="margin-top: 10px; margin-left: 10px; font-size: 25px;">Daftar Obat Pesanan</p>
                                                <div id="data_pasien" style="margin-left: 10px; margin-right: 10px;">
                                                    <table id="data-table" style="margin-bottom: 0px;" class="table table-condensed table-bordered dataTable">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Nama Obat</th>
                                                            <th>Harga</th>
                                                            <th>Qty</th>
                                                            <th style="width:40px">Total</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
															$daftar = $db->query("select * from tbl_pesanan_obat_detail where md5(pesanan_id)='".$_GET['id']."'");
															for ($i = 0; $i < count($daftar); $i++) {
																$no = $no + 1;
														?>
                                                        <tr>
                                                        	<td><?php echo $no?></td>
                                                        	<td><?php echo $daftar[$i]['kode_obat'].' - '.$daftar[$i]['nama_obat']?></td>
                                                            <td style="text-align: right;"><?php echo number_format($daftar[$i]['harga_jual'])?></td>
                                                            <td style="text-align: right;"><?php echo number_format($daftar[$i]['qty'])?></td>
                                                            <td style="text-align: right;"><?php echo number_format($daftar[$i]['total_jual'])?></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <?php
																$total = $total + $daftar[$i]['total_jual'];	
															}
														?>
                                                        <tr>
                                                            <td colspan="4" style="font-weight: bold; text-align: right;">SubTotal</td>
                                                            <td><div style="font-weight: bold; text-align: right;"><?php echo number_format($total)?></div></td>
                                                            <td>&nbsp;</td>
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
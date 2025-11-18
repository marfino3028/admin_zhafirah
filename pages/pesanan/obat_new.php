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
                                    <form action="pages/pesanan/obat_simpan.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form" id="form" >
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
		                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Pesanan" onclick="location.replace('index.php?mod=pesanan&submod=obat')" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                    Belum ada data
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
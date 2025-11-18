<?php
	$data = $db->query("select * from tbl_pelayanan_lainnya where id='".$_GET['id']."'");
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
		var url = "pages/pelayanan_lain/pelayanan_lain_get_tarif.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakan() {
		var url = "pages/pelayanan_lain/pelayanan_lain_save_detail.php";
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
				url : "pages/functions/tindakan.php",
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
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pelayanan Lain</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Data Detail Pelayanan Lain </a>
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
                                        Form Tambah Data Detail Pelayanan Lain
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form" id="form" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Id</label>
                                                    <div class="col-sm-10">
                                                        <?php echo $data[0]['Id']?>
                                                        <input type="hidden" id="ParentId" name="ParentId" value="<?php echo $data[0]['Id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Nama Pasien</label>
                                                    <div class="col-sm-10">
                                                        <?php echo $data[0]['NamaPasien']?>
                                                        <input type="hidden" id="nama_pasien" name="nama_pasien" value="<?php echo $data[0]['NamaPasien']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Tanggal Lahir</label>
                                                    <div class="col-sm-10">
                                                        <?php echo date("d F Y", strtotime($data[0]['TanggalLahir']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Umur</label>
                                                    <div class="col-sm-10">
                                                        <?php
                                                        echo date("Y") - date("Y", strtotime($data[0]['TanggalLahir'])) . " Tahun";
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-2">Pilih Tindakan </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="Tarif_Id" id="Tarif_Id" onchange="TampilHarga(this.value)" style="width: 210px" >
                                                    </div>
                                                </div>
                                            </div><p>
                                            <div class="col-sm-6">
                                                <div id="data_pasien">
                                                    <table id="data-table" style="margin-bottom: 0px;" class="table table-condensed table-bordered dataTable nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Tindakan</th>
                                                            <th style="width:40px">Tarif</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $table = $db->query("
							SELECT detail.Id, detail.ParentId, tarif.nama_pelayanan, detail.Tarif,  detail.Qty
							FROM tbl_pelayanan_lainnya_detail AS detail
							LEFT JOIN tbl_tarif AS tarif ON detail.Tarif_Id = tarif.kode_tarif
							
							WHERE detail.ParentId = {$_GET['id']}
							", 0);
                                                        $subtotal = 0;
                                                        for ($i = 0; $i < count($table); $i++) {
                                                            $no = $i +1;
                                                            $tarif = number_format(($table[$i]['Tarif'] * $table[$i]['Qty']));
                                                            echo "<tr>
								<td>{$no}</td>
								<td>{$table[$i]['nama_pelayanan']}</td>
								<td align='right'>{$tarif}</td>
								<td align='center'>
									<a class='btn_no_text btn ui-state-default ui-corner-all' title='Delete' 
									href='pages/pelayanan_lain/pelayanan_lain_delete_detail.php?id={$table[$i]['Id']}&ParentId={$table[$i]['ParentId']}'> 
										<span class='ui-icon ui-icon-circle-close'></span> 
									</a> 
								</td>
							  </tr>";
                                                            $subtotal += ($table[$i]['Tarif'] * $table[$i]['Qty']);
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="2">SubTotal</td>
                                                            <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($subtotal)?></div></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div id="DataAdd">
                                                <table border="0" cellpadding="0" style="border-collapse: collapse;">
                                                    <tr height="28">
                                                        <td width="110"><span style="margin-left:10px">Tarif</span></td>
                                                        <td valign="middle" align="center">
                                                            <div id="TarifTindakan" style="margin-bottom: 4px; margin-top: 4px;">
                                                                <input type="text" name="Tarif" id="Tarif" size="5" value="0" style="text-align: right" tabindex="3" readonly="" class="form-control" />
                                                                <input type="hidden" name="tarifNo" id="tarifNo" value="0" />
                                                            </div></td>
                                                    </tr>
                                                    <tr height="28">
                                                        <td width="110"><span style="margin-left:10px">QTY</span></td>
                                                        <td valign="middle" align="center">
                                                            <div id="TarifTindakanQTY" style="margin-bottom: 4px; margin-top: 4px;">
                                                                <input type="text" name="Qty" id="Qty" size="5" value="1" style="text-align: right" tabindex="3" class="form-control" />
                                                            </div></td>
                                                    </tr>
                                                    <tr height="28">
                                                        <td valign="top" align="center" colspan="2" >
                                                            <div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;" align="center">
                                                                <input type="button" value="Simpan Tindakan" onclick="simpanTindakan()" class="btn btn-sm btn-small btn-primary rounded" />

                                                                <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Pelayanan Lain" onclick="location.replace('index.php?mod=pelayanan_lain&submod=pelayanan_lain')" />
                                                                <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Bayar" onclick="location.replace('index.php?mod=kasir&submod=input_kasir_new&nodaftar=<?php echo $data[0]['Id']?>&nama=<?php echo $data[0]['NamaPasien']?>')" />
                                                            </div></td>
                                                    </tr>
                                                </table>
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
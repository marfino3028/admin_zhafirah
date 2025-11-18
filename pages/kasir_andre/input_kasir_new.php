<?php

	$ceknmr = $db->queryItem("select max(right(no_kwitansi, 3)*1) from tbl_kasir where left(right(no_kwitansi, 11), 8)='".date("dmY")."'", 0);
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	$nomr = 'KW-'.date("dmY").$ceknmr;
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/kasir/detail_bayar.php";
		var data = {id:id};
		
		if (id == "") {
			document.getElementById('data_pasien').innerHTML = '';
		}
		else {
			document.getElementById('data_pasien').innerHTML = 'Tunggu sebentar ....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
	}
	
	function inputTotalBayar(total, total_text) {
		document.getElementById('total_bayar').value = total;
		document.getElementById('total_bayar_text').value = total_text;
	}
	
	function TotalAllBayar() {
		var url = "pages/kasir/totalAll_bayar.php";
		var metode = document.getElementById('metode').value;
		var diskon = document.getElementById('diskon').value
		var subtotal = document.getElementById('total_bayar').value;
		var pembulatan = document.getElementById('pembulatan').value;
		var data = {metode:metode, subtotal:subtotal, diskon:diskon, pembulatan: pembulatan};

		if (metode == "") {
			document.getElementById('totalAll').innerHTML = '';
		}
		else {
			document.getElementById('totalAll').innerHTML = 'Tunggu sebentar ....';
			$('#totalAll').load(url,data, function(){
				$('#totalAll').fadeIn('fast');
			});
		}
	}

	function simpanDataKasir(t, url) {
		var nofr = document.getElementById('nofr').value;
		var nodaftar = document.getElementById('nodaftar').value;
		var metode = document.getElementById('metode').value;
		
		if (nofr == "" || nodaftar == "" || metode == "") {
			alert("Silahkan Lengkapi isian yang sudah disediakan");
		}
		else {
			document.getElementById('form_karyawan').action = url;
			t.submit();
		}
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#nodaftar").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/inputkasir.php",
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
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Pembayaran Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" width="280">
                <div align="left" style="margin-top: 20px;">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="280" bordercolor="#000000">
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. Kwitansi</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_kwitansi" name="no_kwitansi" class="form-control" style="width: 100px; background-color:#CCC; width: 120px;" value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">NO. FR</span></td>
                            <td valign="middle" align="center">
                            	<input type="text" id="nofr" name="nofr" class="form-control" style="width: 120px; text-align: left; font-weight: bold" />
							</td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">No. Pendaftaran</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
							<input type="text" id="nodaftar" name="nodaftar" onchange="CariPasien(this.value)" style="width: 210px" >
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Total Bayar</span></td>
                            <td valign="middle" align="center">
                            	<input type="text" id="total_bayar_text" name="total_bayar_text" class="form-control" readonly="" style="width: 120px; text-align: right; font-weight: bold" />
                            	<input type="hidden" id="total_bayar" name="total_bayar" style="width: 120px; text-align: right; font-weight: bold" />
							</td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Pembulatan</span></td>
                            <td valign="middle" align="center">
                            	<input type="text" id="pembulatan" name="pembulatan" class="form-control" style="width: 120px; text-align: right; font-weight: bold" />
							</td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Nama Penjamin</span></td>
                            <td valign="middle" align="center">
                            	<input type="text" id="penjamin" name="penjamin" class="form-control" style="width: 120px; font-weight: bold" />
							</td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Potongan</span></td>
                            <td valign="middle" align="center">
                            	<input type="text" id="diskon" name="diskon" class="form-control" value="0" style="width: 120px; text-align: right; font-weight: bold" />
							</td>
                        </tr>
                        <tr height="28">
                            <td width="110"><span style="margin-left:10px">Metode Bayar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            	<select id="metode" name="metode" size="1" style="width: 130px" onchange="TotalAllBayar()">
									<option value="">--Metode Bayar--</option>
									<option value="CASH">Cash</option>
									<option value="ASS">Asuransi Perusahaan</option>
									<option value="CC">Kartu Kredit</option>
									<option value="DEBIT">Debit</option>
								</select>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td valign="middle" colspan="2"><div id="totalAll"></div></td>
                        </tr>
                        <tr height="28">
                            <td valign="top" align="center" colspan="2" >
                            <div style="margin-bottom: 14px; margin-top: 14px; margin-left: 15px;">
                             <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" onclick="simpanDataKasir(this.form, 'pages/kasir/input_kasir_insert.php')" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
                <td><div id="data_pasien"></div></td>
            </tr>
        </table>
    </div>

</form>
</div>

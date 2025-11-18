<script language="javascript">
	function pilihPoli(id) {
		var data = {id:id};
		
		if (id == 'LANGSUNG') { 
			var url = "pages/pendaftaran/view_langsung.php";
		}
		else {
			var url = "pages/pendaftaran/view_not_langsung.php";
		}
		$('#langsung').load(url,data, function(){
			$('#langsung').fadeIn('fast');
		});
	}

function simpanDataDaftar(t, url) {
	var hub = document.getElementById('hub').value;
	var nama_hub = document.getElementById('nama_hub').value;
	//alert(hub + " dan " + nama_hub);
	if (hub == "" && nama_hub == "") {
		alert("Silahkan Isi Hubungan Lainnya di text Kosong disamping Hubungan");
	}
	else {
		document.getElementById('form_karyawan').action = url;
		t.submit();
	}
}
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#hub_nomr").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/hubungan.php",
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
    <div class="portlet-header ui-widget-header">Form Tambah Data Hubungan Keluarga Pasien</div>
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/hubungan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
		<table border="1" cellpadding="0" style="border-collapse: collapse; width: 90%;" bordercolor="#000000">
			<tr height="28">
				<td width="160"><span style="margin-left:10px">Nama Suami/Pegawai</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<input type="text" id="hub_nomr" name="hub_nomr" onchange="CariPasien(this.value)" style="width: 100%" >
				</div></td>
			</tr>
			<tr height="28">
				<td width="110"><span style="margin-left:10px">Nama Keluarga</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<input type="text" id="nama" name="nama" class="form-control" style="width: 100%;" />
				</div></td>
			</tr>
			<tr height="28">
				<td width="110"><span style="margin-left:10px">Hubungan</span></td>
				<td valign="middle" align="center">
				<div style="margin-bottom: 4px; margin-top: 4px;">
				<select id="hub" name="hub" size="1" style="width: 40%;">
					<option value="">--Pilih Hubungan--</option>
					<option value="SUAMI">SUAMI</option>
					<option value="ISTRI">ISTRI</option>
					<option value="ANAK">ANAK</option>
					<option value="">LAINNYA</option>
				</select>
				<input type="text" id="nama_hub" name="nama_hub" class="form-control" style="width: 50%;" />
				</div></td>
			</tr>
			<tr height="28">
				 <td width="110">&nbsp;</td>
				<td valign="top" align="center" >
				<div style="margin-bottom: 14px; margin-top: 4px; margin-left: 15px;">
				 <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanDataDaftar(this.form, 'pages/pendaftaran/hubungan_insert.php')" />
				</div></td>
			</tr>
		</table>
    </div>
</form>
</div>

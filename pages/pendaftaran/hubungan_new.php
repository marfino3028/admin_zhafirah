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

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    Data Hubungan Pasien
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
                                        Form Tambah Data Hubungan Keluarga Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/hubungan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Suami/Pegawai</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="hub_nomr" name="hub_nomr" onchange="CariPasien(this.value)" style="width: 100%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Keluarga</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Hubungan</label>
                                            <div class="col-sm-10">
                                                <select id="hub" name="hub" size="1" class="form-control">
                                                        <option value="">--Pilih Hubungan--</option>
                                                        <option value="SUAMI">SUAMI</option>
                                                        <option value="ISTRI">ISTRI</option>
                                                        <option value="ANAK">ANAK</option>
                                                        <option value="">LAINNYA</option>
                                                    </select>
                                                <input type="text" id="nama_hub" name="nama_hub" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanDataDaftar(this.form, 'pages/pendaftaran/hubungan_insert.php')" />
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
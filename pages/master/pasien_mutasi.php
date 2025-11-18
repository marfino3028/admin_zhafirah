<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Mutasi Pasien</a>
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
                                        Form Mutasi Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/pasien_mutasi_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nama Pasien</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nomr" onchange="CariPasien(this.value)" style="width: 100%;" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Klinik Tujuan</label>
                                                    <div class="col-sm-9">
                                                        <select id="rujukan" name="rujukan" size="1" class="form-control">
                                                            <option value="">--Pilih Klinik Asal--</option>
                                                            <?php
                                                            	$rujuk = $db->query("select kode_perusahaan, nama_perusahaan from tbl_perusahaan order by nama_perusahaan");
                                                            	for ($i = 0; $i < count($rujuk); $i++) {
                                                            		echo '<option value="'.$rujuk[$i]['nama_perusahaan'].'">'.$rujuk[$i]['nama_perusahaan'].'</option>';
                                                            	}
							    ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Tipe Pasien</label>
                                                    <div class="col-sm-9">
                                                        <select id="type_pasien" name="type_pasien" size="1" class="form-control">
                                                            <option value="">--Pilih Type Pasien--</option>
                                                            <option value="Klinik">Klinik</option>
                                                            <option value="Alat HD">Alat HD</option>
                                                            <option value="Corporated">Corporated</option>
							    <option value="Mandiri">Mandiri</option>
                                                        </select>
                                                    </div>
                                                </div>
	                                        <div class="form-actions">
        	                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pasien Mutasi" />
                	                        </div>
                                            </div>
                                            <div class="col-sm-7" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative;"></div>
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
<script language="javascript">
    function CariPasien(id) {
        var url = "pages/master/view_pasien.php";
        id = '1###' + id;
        var data = {id:id};

        $('.loading').fadeIn();
        $('#data_pasien').fadeOut();
        $('#data_pasien').load(url,data, function(){
            $('.loading').fadeOut('fast');
            $('#data_pasien').fadeIn('fast');
        });
    }

    function simpanDataDaftar(t, url) {
        var poli = document.getElementById('kd_poli').value;
        var prsh = document.getElementById('kode_perusahaan').value;
        if (poli == "" || prsh == "") {
            alert("Silahkan lengkapi data yang sudah disediakan");
        }
        else {
            document.getElementById('form_karyawan').action = url;
            t.submit();
        }
    }
</script>
<script language="javascript">
    $(document).ready(function() {
        $("#nomr").select2({
            minimumInputLength: 1,
            ajax: {
                url : "pages/functions/nomr.php",
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
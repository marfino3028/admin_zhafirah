<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">AP Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Hutang Pembelian</a>
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
                                        Form Input Hutang Pembelian (A/P Purchasing)
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/hutang/pembelian_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                    	<label for="textfield" class="control-label">Tanggal AP</label>
                                                        <input type="date" id="tgl_ap" name="tgl_ap" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                    	<label for="textfield" class="control-label">Jatuh Tempo</label>
                                                        <input type="date" id="jatuh_tempo" name="jatuh_tempo" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                    	<label for="textfield" class="control-label">Tgl Faktur Pajak</label>
                                                        <input type="date" id="tgl_faktur_pajak" name="tgl_faktur_pajak" class="form-control" value="<?php echo date("Y-m-d")?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
							<label for="textfield" class="control-label">Nama Supplier</label>
							<input type="text" id="nodaftar" name="nodaftar" onchange="CariPasien(this.value)" style="width: 100%;" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
							<label for="textfield" class="control-label">No. Faktur Pajak</label>
                                                        <input type="text" id="faktur_pajak" name="faktur_pajak" class="form-control" required="required" >
                                                    </div>
                                                    <div class="col-sm-6">
							<label for="textfield" class="control-label">No. Invoice</label>
                                                        <input type="text" id="invoice" name="invoice" class="form-control" required="required" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
							<label for="textfield" class="control-label">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div id="data_pasien"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" />
					    <div id="hitung"></div>
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
        var url = "pages/hutang/detail_pembelian.php";
        var data = {
            id: id
        };

        if (id == "") {
            document.getElementById('data_pasien').innerHTML = '';
        } else {
            document.getElementById('data_pasien').innerHTML = 'Tunggu sebentar ....';
            $('#data_pasien').load(url, data, function() {
                $('#data_pasien').fadeIn('fast');
            });
        }
    }

    function HitungSemua() {
	var subtotal = document.getElementById('subtotalnr').value;
	var total = document.getElementById('totalnr').value;
	var retur = document.getElementById('retur').value;
	var diskon = document.getElementById('diskon').value;
	var dp = document.getElementById('dp').value;
	var lain = document.getElementById('lain').value;
	var subtotal_awal = document.getElementById('subtotal_awal').value;
	var total_awal = document.getElementById('total_awal').value;

        var url = "pages/hutang/detail_hitungan.php";
        var data = {
            subtotal: subtotal, total: total, retur: retur, diskon: diskon, dp: dp, lain: lain, subtotal_awal: subtotal_awal, total_awal: total_awal
        };

        document.getElementById('hitung').innerHTML = '';
        $('#hitung').load(url, data, function() {
            $('#hitung').fadeIn('fast');
        });

    }

    function updateAll(sub, ppn, total, subTxt, totalTxt) {
	document.getElementById('ppn').value = ppn;
	document.getElementById('totalnr').value = total;
	document.getElementById('subtotalnr').value = sub;
	document.getElementById('subtotal').innerHTML = subTxt;
	document.getElementById('total').innerHTML = totalTxt;
    }
    
</script>
<script language="javascript">
    $(document).ready(function() {
        $("#nodaftar").select2({
            minimumInputLength: 1,
            ajax: {
                url : "pages/hutang/supplier.php",
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
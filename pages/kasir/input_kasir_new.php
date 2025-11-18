<?php

$ceknmr = $db->queryItem("select max(right(no_kwitansi, 3)*1) from tbl_kasir where left(right(no_kwitansi, 11), 8)='" . date("dmY") . "'", 0);
$ceknmr = $ceknmr + 1;
if ($ceknmr < 10) $ceknmr = '00' . $ceknmr;
elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0' . $ceknmr;
elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
$nomr = 'KW-' . date("dmY") . $ceknmr;
?>
<script language="javascript">
    function CariPasien(id) {
        var url = "pages/kasir/detail_bayar.php";
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

    function inputTotalBayar(total, total_text, sub, sub_text, um, um_text, promo, telp = "Tidak Ada") {
        document.getElementById('total_bayar').value = total;
        document.getElementById('total_bayar_text').value = total_text;
        document.getElementById('sub_total_bayar').value = sub;
        document.getElementById('sub_total_bayar_text').value = sub_text;
        document.getElementById('um_bayar').value = um;
        document.getElementById('um_text').value = um_text;
        document.getElementById('diskon').value = promo;
        document.getElementById('telp').value = telp;
    }

    function TotalAllBayar() {
        var url = "pages/kasir/totalAll_bayar.php";
        var metode = document.getElementById('metode').value;
        var diskon = document.getElementById('diskon').value
        var subtotal = document.getElementById('total_bayar').value;
        var pembulatan = document.getElementById('pembulatan').value;
        var data = {
            metode: metode,
            subtotal: subtotal,
            diskon: diskon,
            pembulatan: pembulatan
        };

        if (metode == "") {
            document.getElementById('totalAll').innerHTML = '';
        } else {
            document.getElementById('totalAll').innerHTML = 'Tunggu sebentar ....';
            $('#totalAll').load(url, data, function() {
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
        } else {
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
                url: "pages/functions/inputkasir.php",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function(term) {
                    return {
                        term: term
                    };
                },
                results: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.itemName,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });
        <?php
        if (isset($_GET['nodaftar']) && isset($_GET['nama'])) {
            echo '$("#nodaftar").select2("data", { id: "PL/' . $_GET['nodaftar'] . '", text: "PL/' . $_GET['nodaftar'] . ' - ' . $_GET['nama'] . '" });';
            echo "CariPasien('PL/" . $_GET['nodaftar'] . "');";
        }
        ?>
    });
</script>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Kasir</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembayaran Kasir
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
                                        Form Tambah Data Pembayaran Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/kasir/input_kasir_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Kwitansi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="no_kwitansi" name="no_kwitansi" class="form-control" value="<?php echo $nomr ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Pendaftaran</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nodaftar" name="nodaftar" onchange="CariPasien(this.value)" style="width: 100%">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Sub Total</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="sub_total_bayar_text" name="sub_total_bayar_text" class="form-control text-right" readonly="" />
                                                        <input type="hidden" id="sub_total_bayar" name="sub_total_bayar" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Uang Muka</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="um_text" name="um_text" class="form-control text-right" readonly="" />
                                                        <input type="hidden" id="um_bayar" name="um_bayar" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Total Bayar</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="total_bayar_text" name="total_bayar_text" class="form-control text-right" readonly="" />
                                                        <input type="hidden" id="total_bayar" name="total_bayar" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pembulatan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="pembulatan" name="pembulatan" class="form-control text-right" value="0" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nama Penjamin</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="penjamin" name="penjamin" class="form-control" required="required" Placeholder="Nama Penjamin" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Telp/WhatsApp</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="telp" name="telp" class="form-control" required="required" Placeholder="No. Telp/WhatsApp" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Potongan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="diskon" name="diskon" class="form-control" value="0" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Total Piutang</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="piutang" name="piutang" class="form-control" value="0" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Metode Bayar</label>
                                                    <div class="col-sm-9">
                                                        <select id="metode" name="metode" size="1" onchange="TotalAllBayar()" class="form-control" required="required">
                                                            <option value="">--Metode Bayar--</option>
                                                            <option value="CASH">Cash</option>
                                                            <option value="ASS">Asuransi Perusahaan</option>
                                                            <option value="CC">Kartu Kredit</option>
                                                            <option value="DEBIT">Debit</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="totalAll"></div>
                                                <div class="form-actions">
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="data_pasien"></div>
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
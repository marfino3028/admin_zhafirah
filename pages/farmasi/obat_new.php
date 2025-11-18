<?php
include "../../3rdparty/engine.php";
$ppn = $db->query("SELECT nilai FROM tbl_config WHERE deskripsi = 'PPN'");
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat</a>
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
                                        Form Tambah Data Master Obat
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/farmasi/obat_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nama Obat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="nama_obat" name="nama_obat" class="form-control" tabindex="1" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Satuan Obat</label>
                                                    <div class="col-sm-4">
                                                        <label>Satuan Kecil</label>
                                                        <select id="satuan" name="satuan" size="1" class="form-control" tabindex="2">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
                                                                echo '<option value="' . $satuan[$i]['nama'] . '">' . $satuan[$i]['kode'] . ' - ' . $satuan[$i]['nama'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Satuan Besar</label>
                                                        <select id="satuan_besar" name="satuan_besar" size="1" class="form-control" tabindex="3">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
                                                                echo '<option value="' . $satuan[$i]['nama'] . '">' . $satuan[$i]['kode'] . ' - ' . $satuan[$i]['nama'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Ppn</label>
                                                    <div class="col-sm-4">
                                                        <label>PPn <small>%</small></label>
                                                        <input type="number" readonly id="ppn" value="<?= $ppn[0]['nilai']; ?>" name="ppn" class="form-control" tabindex="4" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Harga Sebelum PPn</label>
                                                        <input type="number" id="sebelum_ppn" name="sebelum_ppn" class="form-control" tabindex="5" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Margin Obat</label>
                                                    <div class="col-sm-9">
                                                        <label>Margin <small>%</small></label>
                                                        <input type="number" id="margin" name="margin" class="form-control" tabindex="4" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Harga Obat</label>
                                                    <div class="col-sm-4">
                                                        <label>Harga Beli</label>
                                                        <input type="number" id="harga_beli" name="harga_beli" class="form-control" tabindex="4" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Harga Jual</label>
                                                        <input type="number" id="harga_jual" name="harga_jual" readonly class="form-control" tabindex="5" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Suplier</label>
                                                    <div class="col-sm-9">
                                                        <select id="suplier" name="suplier" size="1" tabindex="6" class="form-control">
                                                            <option value="">--Pilih Suplier--</option>
                                                            <?php
                                                            $vendor = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
                                                            for ($i = 0; $i < count($vendor); $i++) {
                                                                echo '<option value="' . $vendor[$i]['kode_suplier'] . '">' . $vendor[$i]['nama_suplier'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Vendor/Pabrik</label>
                                                    <div class="col-sm-9">
                                                        <select id="vendor" name="vendor" size="1" tabindex="7" class="form-control">
                                                            <option value="">--Pilih Vendor/Pabrik--</option>
                                                            <?php
                                                            $vendor = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
                                                            for ($i = 0; $i < count($vendor); $i++) {
                                                                echo '<option value="' . $vendor[$i]['kode_vendor'] . '">' . $vendor[$i]['nama_vendor'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Golongan & Comodity</label>
                                                    <div class="col-sm-4">
                                                        <label>Golongan Obat</label>
                                                        <select id="golongan" name="golongan" size="1" tabindex="8" class="form-control">
                                                            <option value="">Pilih Golongan</option>
                                                            <?php
                                                            $vendor = $db->query("select kd_gol, golongan from tbl_gol_obt");
                                                            for ($i = 0; $i < count($vendor); $i++) {
                                                                echo '<option value="' . $vendor[$i]['kd_gol'] . '">' . $vendor[$i]['golongan'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Comodity Obat</label>
                                                        <select id="comodity" name="comodity" size="1" tabindex="9" class="form-control">
                                                            <option value="">Pilih Comodity</option>
                                                            <?php
                                                            $vendor = $db->query("select kd_comodity, comodity from tbl_comodity");
                                                            for ($i = 0; $i < count($vendor); $i++) {
                                                                echo '<option value="' . $vendor[$i]['kd_comodity'] . '">' . $vendor[$i]['comodity'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Type Obat</label>
                                                    <div class="col-sm-9">
                                                        <select id="jenis" name="jenis" size="1" tabindex="10" class="form-control">
                                                            <option value="">--Type Jenis Obat--</option>
                                                            <option value="Obat">Obat</option>
                                                            <option value="Alkes">Alkes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Stock Obat</label>
                                                    <div class="col-sm-4">
                                                        <label>Stock Keluar</label>
                                                        <input type="number" id="stock_keluar" name="stock_keluar" class="form-control" tabindex="12" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Stock Minimal</label>
                                                        <input type="number" id="stock_min" name="stock_min" class="form-control" tabindex="13" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">&nbsp;</label>
                                                    <div class="col-sm-4">
                                                        <label>Stock Akhir Apotik</label>
                                                        <input type="number" id="stock_akhir_apotik" name="stock_akhir_apotik" class="form-control" tabindex="11" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Stock Akhir Gudang</label>
                                                        <input type="number" id="stock_akhir" name="stock_akhir" class="form-control" tabindex="11" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">&nbsp;</label>
                                                    <div class="col-sm-4">
                                                        <label>Stock Akhir Depo Fisioterapi</label>
                                                        <input type="number" id="stock_akhir_fisio" name="stock_akhir_fisio" class="form-control" tabindex="11" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Stock Akhir Depo Keperawatan</label>
                                                        <input type="number" id="stock_akhir_keperawatan" name="stock_akhir_keperawatan" class="form-control" tabindex="11" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">&nbsp;</label>
                                                    <div class="col-sm-4">
                                                        <label>Stock Minimal Apotik</label>
                                                        <input type="text" id="stock_min_apotik" name="stock_min_apotik" class="form-control" tabindex="14" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Stock Minimal Gudang</label>
                                                        <input type="number" id="stock_min_gudang" name="stock_min_gudang" class="form-control" tabindex="15" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Jumlah & Harga</label>
                                                    <div class="col-sm-4">
                                                        <label>Jumlah per Box</label>
                                                        <input type="number" id="jml_per_box" name="jml_per_box" class="form-control" tabindex="16" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Harga per Box</label>
                                                        <input type="number" id="harga_per_box" name="harga_per_box" class="form-control" tabindex="17" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Kategori Barang</label>
                                                    <div class="col-sm-9">
                                                        <select id="kategori_barang" name="kategori_barang" size="1" tabindex="18" class="form-control">
                                                            <option value="">--Pilih Kategori Barang--</option>
                                                            <?php
                                                            $vendor = $db->query("select id, kategori from tbl_coa_category");
                                                            for ($i = 0; $i < count($vendor); $i++) {
                                                                echo '<option value="' . $vendor[$i]['id'] . '">' . $vendor[$i]['kategori'] . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Tanggal Expired</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" id="tgl_expired" name="tgl_expired" class="form-control" tabindex="19" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Obat" onclick="simpanData(this.form, 'pages/farmasi/obat_insert.php')" tabindex="15" />
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

<script>
    document.getElementById('sebelum_ppn').addEventListener('input', function() {
        var ppn = parseFloat(document.getElementById('ppn').value);
        var sebelumPpn = parseFloat(this.value);
        var hargaBeli = sebelumPpn + (sebelumPpn * (ppn / 100));
        document.getElementById('harga_beli').value = hargaBeli.toFixed(0);
    });

    document.getElementById('margin').addEventListener('input', function() {
        var harga_beli = document.getElementById('harga_beli').value;
        var margin = parseFloat(this.value / 100);
        var harga_jual = parseFloat(margin * harga_beli) + parseFloat(harga_beli);
        document.getElementById('harga_jual').value = harga_jual.toFixed(0);
    });
</script>
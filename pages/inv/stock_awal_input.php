<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat Apotik
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
                            <div class="box box-color box-bordered box-small lightgrey">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Stock Awal Apotik
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Obat</label>
                                            <div class="col-sm-10">
                                                <select id="obat" name="obat" size="1" class="form-control">
                                                    <option value="">--Pilih Obat--</option>
                                                    <?php
                                                    $daft = $db->query("select * from tbl_obat where status_delete='UD' order by nama_obat");
                                                    for ($i = 0; $i < count($daft); $i++) {
                                                        echo '<option value="'.$daft[$i]['kode_obat'].'">'.$daft[$i]['nama_obat'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Tahun Stock</label>
                                            <div class="col-sm-10">
                                                <select id="tahun" name="tahun" size="1" class="form-control">
                                                    <?php
                                                    $tahun_awal = date("Y") + 1;
                                                    for ($i = 2000; $i <= $tahun_awal; $i++) {
                                                        if ($i == date("Y")) {
                                                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                                        }
                                                        else {
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Bulan</label>
                                            <div class="col-sm-10">
                                                <select id="bulan" name="bulan" size="1" class="form-control">
                                                    <option value="">--Pilih Obat--</option>
                                                    <?php
                                                    $bln = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des');
                                                    for ($i = 0; $i < count($bln); $i++) {
                                                        $j = $i + 1;
                                                        echo '<option value="'.$j.'">'.$bln[$i].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jml Stock</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="stock" name="stock" class="form-control text-right" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div id="data_pasien"></div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Stock Apotik" onclick="simpanData(this.form, 'pages/inv/stock_awal_apotik_insert.php')" />
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
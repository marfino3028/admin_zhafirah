<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Kamar Inap</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Master Isi Kamar Inap
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
                                        Form Tambah Isi Kamar Inap
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/master/inap_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kelas</label>
                                            <div class="col-sm-10">
                                                <select id="kategori" name="kategori" size="1" class="form-control" required="required">
                                                    <option value="">--Pilih Kelas--</option>
                                                    <?php
                                                    $layanan = $db->query("select id as kode, nama as nama from tbl_kelas");
                                                    for ($i = 0; $i < count($layanan); $i++) {
                                                        echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama Ruangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="simpan" id="simpan" value="Simpan Data" class="btn btn-sm btn-small btn-primary rounded" />
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

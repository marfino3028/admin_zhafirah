<?php
    //date_default_timezone_set('Asia/Jakarta');
    $t1 = explode("/", $_POST['mulai']);
    $t2 = explode("/", $_POST['selesai']);
    //Nilai Tutup Pendapatan Harian
    $date1 = $t1[2] . '-' . $t1[0] . '-' . $t1[1];
    $date2 = $t2[2] . '-' . $t2[0] . '-' . $t2[1];
    
    if ($_POST['mulai'] == "" and $_POST['selesai'] == "") {
        $d11 = date("m/d/Y");
        $d12 = date("m/d/Y");
        $date1 = date("Y-m-d");
        $date2 = date("Y-m-d");
    } else {
        $d11 = date("m/d/Y", strtotime($date1));
        $d12 = date("m/d/Y", strtotime($date2));
    }
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Pasien
                    </h3>
                </div>
                <div class="box-title">
                    <div class="box">
                        <form action="index.php?mod=pendaftaran&submod=index" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                            Periode <input type="text" id="mulai" name="mulai" value="<?php echo $d11 ?>" size="7" /> s/d <input type="text" value="<?php echo $d12 ?>" id="selesai" name="selesai" size="7" /> &nbsp; &nbsp;
                            <select id="metode" name="metode" size="1" style="width: 170px;">
                                <option value="">--Status Pasien--</option>
                                <?php
                                if ($_POST['metode'] == "" or $_POST['metode'] == "ALL") {
                                    echo '<option value="ALL" selected="selected">ALL / Semua</option>';
                                } else {
                                    echo '<option value="ALL">ALL / Semua</option>';
                                }
                                $data = $db->query("select a.status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where a.status_delete='UD' and b.nm_pasien like '%" . $_POST['search'] . "%' group by a.status_pasien", 0);
                                for ($i = 0; $i < count($data); $i++) {
                                    if ($_POST['metode'] == $data[$i]['status_pasien']) {
                                        echo '<option value="' . $data[$i]['status_pasien'] . '" selected="selected">' . $data[$i]['status_pasien'] . '</option>';
                                    } else {
                                        echo '<option value="' . $data[$i]['status_pasien'] . '">' . $data[$i]['status_pasien'] . '</option>';
                                    }
                                }
                                ?>
                            </select> &nbsp; &nbsp;
                            <input type="submit" class="btn btn-darkblue rounded" value=" View!! " />
                        </form>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i>Pendaftaran Pasien
                                    </h3>
                                    <a href="index.php?mod=pendaftaran&submod=daftar" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Pendaftaran</a>

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NoMR & Pasien</th>
                                                <th>Nama Penjamian/<br>Perusahaan</th>
                                                <th>Dokter</th>
                                                <th style="width:70px">Poli</th>
                                                <th style="width:70px">Tarif Poli</th>
                                                <th style="width:70px">Status</th>
                                                <th style="width:80px">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $start = $_GET['start'];
                                            $apage = $_GET['apage'];
                                            $number = $_GET['number'];
                                            if (!isset($start)) $start = 0;
                                            if (!isset($apage)) $apage = 10;

                                            if ($_POST['metode'] == "" or $_POST['metode'] == "ALL") {
                                                $data = $db->query("select a.dokumen_rujukan, a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_pendaftaran a where a.status_delete='UD' and a.tgl_daftar >= '$date1' and a.tgl_daftar <= '$date2' order by a.id desc", 0);
                                                $nrdata = $db->queryItem("select count(a.id) from tbl_pendaftaran a where a.status_delete='UD' and a.tgl_daftar >= '$date1' and a.tgl_daftar <= '$date2'", 0);
                                            } else {
                                                $data = $db->query("select a.dokumen_rujukan, a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_pendaftaran a where a.status_delete='UD' and a.status_pasien='" . $_POST['metode'] . "' and a.tgl_daftar >= '$date1' and a.tgl_daftar <= '$date2' order by a.id desc", 0);
                                                $nrdata = $db->queryItem("select count(a.id) from tbl_pendaftaran a where a.status_delete='UD' and a.status_pasien='" . $_POST['metode'] . "' and a.tgl_daftar >= '$date1' and a.tgl_daftar <= '$date2'", 0);
                                            }

                                            if (!isset($number)) $number = $nrdata;
                                            $page = new pages();
                                            if ($_POST['search'] == "")
                                                $page->link = "index.php?mod=pendaftaran&submod=index";
                                            else
                                                $page->link = "index.php?mod=pendaftaran&submod=index&search=" . $_POST['search'];

                                            $page->start = $start;
                                            $page->apage = $apage;
                                            $page->number = $number;
                                            $page->total();
                                            $pagehtml = $page->html;

                                            for ($i = 0; $i < count($data); $i++) {
                                                $data[$i]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='" . $data[$i]['nomr'] . "'", 0);
                                                $data[$i]['nama_poli'] = $db->queryItem("select nama_poli from tbl_poli where kd_poli='" . $data[$i]['kd_poli'] . "'", 0);
                                                if ($data[$i]['nama_poli'] == "") $data[$i]['nama_poli'] = $data[$i]['kd_poli'];
                                                $dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='" . $data[$i]['kode_dokter'] . "'");
                                                if ($dokter == "")    $dokter = $data[$i]['nama_poli'];

                                                $data[$i]['tarif'] = $db->queryItem("select tarif from tbl_poli where kd_poli='" . $data[$i]['kd_poli'] . "'", 0);
                                                //$data[$i]['nama_kel'] = $db->queryItem("select nama from tbl_hubungan_keluarga where nomr='" . $data[$i]['nomr'] . "'", 0);
                                                //$data[$i]['hubungan'] = $db->queryItem("select hubungan from tbl_hubungan_keluarga where nomr='" . $data[$i]['nomr'] . "'", 0);
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i + 1 ?></td>
                                                    <td><?php echo $data[$i]['nomr'].'<br>'.$data[$i]['nama'] ?></td>
                                                    <td><?php echo $data[$i]['nama_perusahaan'] ?></td>
                                                    <td><?php echo $dokter ?></td>
                                                    <td><?php echo $data[$i]['nama_poli'] ?></td>
                                                    <td><?php echo number_format($data[$i]['tarif']) ?></td>
                                                    <td><?php echo $data[$i]['status_pasien'] ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($data[$i]['status_pasien'] == 'OPEN') {
                                                        ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=pendaftaran&submod=daftar_edit&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>


                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Pembatalan Pendaftaran Pasien" href="#" onclick="return window.location = 'pages/pendaftaran/daftar_batal.php?id=<?php echo $data[$i]['id'] ?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
							<?php
                                                        }
								if ($data[$i]['dokumen_rujukan'] != "") {
							?>
							<a class="btn_no_text btn" style="border-radius: 4px;" title="Dokumen Rujukan" href="dokumen/<?php echo $data[$i]['dokumen_rujukan']?>" target="_blank">
                                                        	<span class="ui-icon ui-icon-document"></span>
                                                    	</a>
                                                        <?php
								}

                                                                                                                ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    })
</script>
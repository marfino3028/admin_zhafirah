<?php
    if ($_POST['mulai'] == "") {
        $_POST['mulai'] = date("Y-m-d");
    }
    if ($_POST['selesai'] == "") {
        $_POST['selesai'] = date("Y-m-d");
    }
?>

    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Farmasi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Resep Pasien</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
        <div class="box-title">
          <h3>
            <i class="fa fa-user"></i>
            Resep Obat Pasien
          </h3>
        </div>
        <div class="box-content">
          <form action="index.php?mod=farmasi&submod=input_resep" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
            <div class="row">
              <div class="form-group">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-2">
                  <label for="textfield" class="control-label">No. MR</label>
                  <input type="text" id="nomr" name="nomr" placeholder="No. MR" class="form-control" value="<?php echo $_POST['nomr'] ?>" />
                </div>
                <div class="col-sm-4">
                  <label for="textfield" class="control-label">Nama</label>
                  <input type="text" id="nama" name="nama" placeholder="Nama" class="form-control" value="<?php echo $_POST['nama'] ?>" />
                </div>
                <div class="form-actions col-sm-1">
                  <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Cari..." style="margin-top: 40px; />
                </div>
                <div class="col-sm-3">&nbsp;</div>
              </div>
            </div>
          </form>
        </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i>
					    Daftar Resep Pasien
                                        </h3>
                                        <a href="index.php?mod=farmasi&submod=input_resep_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Resep</a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pasien</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Dokter</th>
                                                <th style="width:70px">No.Resep</th>
                                                <th style="width:70px">Total Harga</th>
                                                <th style="width:70px">Status</th>
                                                <th style="width:70px">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ($_POST['nomr'] == "" and $_POST['nama'] == "") {
                                                $data = $db->query("select b.id id_resep, a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_resep b left join tbl_pendaftaran a on a.no_daftar=b.no_daftar where a.status_delete='UD' and a.tgl_daftar >= '".$_POST['mulai']."' and a.tgl_daftar <= '".$_POST['selesai']."' order by a.id desc", 0);
                                            }
                                            else {
						if ($_POST['nama'] == "") {
                                                	$data = $db->query("select b.id id_resep, a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_resep b left join tbl_pendaftaran a on a.no_daftar=b.no_daftar where a.status_delete='UD' and a.nomr='".$_POST['nomr']."' order by a.id desc", 0);
						}
						else {
                                                	$data = $db->query("select b.id id_resep, a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_resep b left join tbl_pendaftaran a on a.no_daftar=b.no_daftar where a.status_delete='UD' and a.nomr='".$_POST['nomr']."' or b.nama like '%".$_POST['nama']."%' order by a.id desc", 0);
						}
                                            }

                                            for ($i = 0; $i < count($data); $i++) {
                                                $data[$i]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
                                                $data[$i]['nama_poli'] = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'", 0);
                                                if ($data[$i]['nama_poli'] == "") $data[$i]['nama_poli'] = $data[$i]['kd_poli'];
                                                $dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
                                                if ($dokter == "")	$dokter = $data[$i]['nama_poli'];

                                                $data[$i]['tarif'] = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'", 0);
                                                $data[$i]['nama_kel'] = $db->queryItem("select nama from tbl_hubungan_keluarga where nomr='".$data[$i]['nomr']."'", 0);
                                                $data[$i]['hubungan'] = $db->queryItem("select hubungan from tbl_hubungan_keluarga where nomr='".$data[$i]['nomr']."'", 0);

						$data_resep = $db->query("select a.no_resep, a.nomr, a.nama, a.id, a.no_daftar from tbl_resep a where a.status_delete='UD' and a.id='".$data[$i]['id_resep']."' order by id desc", 0);
                                                $total = $db->queryItem("select sum(total) from tbl_resep_detail where no_resep='".$data_resep[0]['no_resep']."' and status_delete='UD' group by no_resep");
                                                $totalRacikan = $db->queryItem("select sum(a.total) from tbl_racikan_detail a left join  tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data_resep[0]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by a.racikanId", 0);

                                                $embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
                                                if ($totalRacikan == 0) $embalase = 0;
                                                //menghitung tindakan dan alkes

                                                $tindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data_resep[0]['no_daftar']."'");
                                                $alkes = $db->queryItem("select sum(tarif) from tbl_alkes where no_daftar='".$data_resep[$i]['no_daftar']."'");

                                                //$ttl = $total + $totalRacikan + $embalase + $tindakan + $alkes;
												$ttl = $total + $totalRacikan + $embalase + $tindakan + $alkes;

                                                $cekKasir = $db->queryItem("select id from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");

                                                if ($cekKasir > 0) {
                                                    $status = 'CLOSED';
                                                    $status_tombol = '1';
                                                }
                                                else {
                                                    $status = 'OPEN';
                                                    $status_tombol = '0';
                                                }


                                                ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i+1?></td>
                                                    <td><?php echo $data[$i]['nomr'].'<br>'.$data[$i]['nama']?></td>
                                                    <td><?php echo $data[$i]['nama_perusahaan']?></td>
                                                    <td><?php echo $dokter?></td>
                                                    <td><?php echo $data_resep[0]['no_resep']?></td>
                                                    <td align="right"><div align="right"><?php echo number_format($ttl)?></div></td>
                                                    <td><?php echo $data[$i]['status_pasien']?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($data[$i]['status_pasien'] == 'OPEN') {
                                                            ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $data_resep[0]['id']?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_delete.php?id=<?php echo md5($data_resep[0]['no_resep'])?>';">
                                                                <span class="ui-icon ui-icon-circle-close"></span>
                                                            </a>
                                                            <!--<a class="btn_no_text btn" style="border-radius: 4px;" title="Pembatalan Pendaftaran Pasien" href="#" onclick="return window.location = 'pages/pendaftaran/daftar_batal.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>-->
                                                            <?php
                                                        }
                                                        ?>
                                   			    <a class="btn_no_text btn" style="border-radius: 4px;" title="Etiket Resep Pasien" href="pages/download/etiket.php?&id=<?php echo md5($data_resep[0]['id'])?>" target="_new">
                                                                <span class="ui-icon ui-icon-document"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Cetak Resep Pasien" href="pages/download/resep_catak.php?&id=<?php echo md5($data_resep[0]['id'])?>" target="_new">
                                                                <span class="ui-icon ui-icon-print"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="History Resep Pasien" onclick="tampilHistori('<?php echo md5($data[$i]['nomr'])?>')" href="#">
                                                                <span class="ui-icon ui-icon-print"></span>
                                                            </a>
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
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
<script language="javascript">
	function copyResep(id) {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/farmasi/copy_resep.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}

	function tampilHistori(id) {
		var w = screen.width - 200;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/farmasi/resep_histori.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
	
</script>
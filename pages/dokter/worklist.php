<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Worklist Dokter</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Worklist Dokter</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Worklist Dokter
                    </h3>
                </div>
                <div class="box-title">
					<?php
						if ($_POST['d1'] == "") $_POST['d1'] = date("Y-m-d");
						if ($_POST['d2'] == "") $_POST['d2'] = date("Y-m-d");
					?>
                    <form action="index.php?mod=dokter&submod=worklist" method="POST" class='form-horizontal form-bordered'>
                    <div class="form-group">
                        <label for="textfield" class="control-label col-sm-1"></label>
                        <div class="col-sm-2">
                            <input name="d1" id="d1" class="form-control" autocomplete="off" value="<?php echo $_POST['d1']?>" type="date">
                        </div>
                        <div class="col-sm-2">
                            <input name="d2" id="d2" class="form-control" autocomplete="off" value="<?php echo $_POST['d2']?>" type="date">
                        </div>
                        <div class="col-sm-3">
                            <select id="metode" name="metode" class='chosen-select form-control'>
                                <option value="">--Status Pasien--</option>
                                <?php
                                if ($_POST['metode'] == "" or $_POST['metode'] == "ALL") {
                                    echo '<option value="ALL" selected="selected">ALL / Semua</option>';
                                }
                                else {
                                    echo '<option value="ALL">ALL / Semua</option>';
                                }
                                $data = $db->query("select a.status_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where a.status_delete='UD' and b.nm_pasien like '%".$_POST['search']."%' group by a.status_pasien", 0);
                                for ($i = 0; $i < count($data); $i++) {
                                    if ($_POST['metode'] == $data[$i]['status_pasien']) {
                                        echo '<option value="'.$data[$i]['status_pasien'].'" selected="selected">'.$data[$i]['status_pasien'].'</option>';
                                    }
                                    else {
                                        echo '<option value="'.$data[$i]['status_pasien'].'">'.$data[$i]['status_pasien'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary">View</button>
                        </div>
                    </div>
					</form>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important; min-height: 300px;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i> Worklist Dokter
                                    </h3>
                                    

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered" style="padding-top: 75px;">
                                        <thead>
                                        <tr>
                                          	<th>Action</th>
                                            <th style="width:270px">NOMR</th>
                                            <th style="width:70px">Umur</th>
                                            <th style="width:70px">Pekerjaan</th>
                                            <th style="width:70px">TGL.BEROBAT</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Dokter</th>
                                            <th style="width:70px">Poli</th>
                                            <th style="width:70px">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if ($_POST['metode'] == "" or $_POST['metode'] == "ALL") {
                                            $data = $db->query("select a.no_daftar, a.nomr, a.tgl_daftar, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_pendaftaran a where a.status_delete='UD' and kd_poli <> 'RI01' and a.tgl_daftar >= '".$_POST['d1']."' and a.tgl_daftar <= '".$_POST['d2']."' order by a.id desc", 0);
                                        }
                                        else {
                                            $data = $db->query("select a.no_daftar, a.nomr, a.tgl_daftar, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, a.biayaAdmin, a.kd_poli, a.yang_berobat from tbl_pendaftaran a where a.status_delete='UD' and kd_poli <> 'RI01' and a.status_pasien='".$_POST['metode']."' and a.tgl_daftar >= '".$_POST['d1']."' and a.tgl_daftar <= '".$_POST['d2']."' order by a.id desc", 0);
                                        }

                                        for ($i = 0; $i < count($data); $i++) {
                                            $data[$i]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
                                            $data[$i]['tgl_lahir'] = $db->queryItem("select tgl_lahir from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
                                            $data[$i]['pekerjaan'] = $db->queryItem("select pekerjaan from tbl_pasien where nomr='".$data[$i]['nomr']."'", 0);
                                            $data[$i]['resep'] = $db->queryItem("select id from tbl_resep where no_daftar='".$data[$i]['no_daftar']."'", 0);
                                            $data[$i]['nama_poli'] = $db->queryItem("select nama_poli from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'", 0);
                                            if ($data[$i]['nama_poli'] == "") $data[$i]['nama_poli'] = $data[$i]['kd_poli'];
                                            $dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
                                            if ($dokter == "")	$dokter = $data[$i]['nama_poli'];

                                            $data[$i]['tarif'] = $db->queryItem("select tarif from tbl_poli where kd_poli='".$data[$i]['kd_poli']."'", 0);
                                            $data[$i]['nama_kel'] = $db->queryItem("select nama from tbl_hubungan_keluarga where nomr='".$data[$i]['nomr']."'", 0);
                                            $data[$i]['hubungan'] = $db->queryItem("select hubungan from tbl_hubungan_keluarga where nomr='".$data[$i]['nomr']."'", 0);

                                            if (substr(substr($data[$i]['yang_berobat'], -5), 0, 4) == "diri") {
                                                $data[$i]['berobat'] = $data[$i]['nama'];
                                                $data[$i]['hubungan'] = "Diri Sendiri";
                                            }
                                            elseif (substr(substr($data[$i]['yang_berobat'], -5), 0, 4) == "ISTR") {
                                                $data[$i]['berobat'] = str_replace(" - ISTRI", "", $data[$i]['yang_berobat']);
                                                $data[$i]['hubungan'] = "ISTRI";
                                            }
                                            elseif (substr(substr($data[$i]['yang_berobat'], -5), 0, 4) == " ANA") {
                                                $data[$i]['berobat'] = str_replace(" - ANAK", "", $data[$i]['yang_berobat']);
                                                $data[$i]['hubungan'] = "ANAK";
                                            }

					    $tanggal_lahir_obj = new DateTime($data[$i]['tgl_lahir']);
					    $sekarang = new DateTime(); // Tanggal hari ini

					    $umur = $sekarang->diff($tanggal_lahir_obj);
					    $data[$i]['umur'] = $umur->y . " tahun,<br>" . $umur->m . " bulan";
					    //echo "Umur: " . $umur->y . " tahun, " . $umur->m . " bulan, " . $umur->d . " hari.";
                                         ?>
                                            <tr>
                                                <td>
                                                  	<?php
                                          				if ($data[$i]['status_pasien'] == 'CLOSED') {
                                                    ?>
													<div class="btn-group dropup">
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle" style="color: grey; font-weight: bold;">
                                                          <i class="glyphicon-justify"></i>  
                                                          <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="index.php?mod=dokter&submod=worklist_view&id=<?php echo $data[$i]['nomr'].'&ids='.$data[$i]['no_daftar']?>">View Pemeriksaan</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                  	<?php
                                                        }
                                                        else {
                                          			?>
                                                    <div class="btn-group dropup">
                                                        <a href="#" data-toggle="dropdown" class="btn dropdown-toggle" style="color: blue;">
                                                          <i class="glyphicon-justify"></i>  
                                                          <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <!--<a href="index.php?mod=dokter&submod=worklist_form&id=<?php echo $data[$i]['nomr'].'&ids='.$data[$i]['no_daftar']?>">Input SOAP & Diagnosa</a>-->
                                                                <a href="index.php?mod=dokter&submod=worklist_list&id=<?php echo $data[$i]['nomr'].'&ids='.$data[$i]['no_daftar']?>">Input SOAP & Diagnosa</a>
                                                            </li>
                                                            <li>
                                                                <a href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $data[$i]['resep']?>">Input Resep Elektronik</a>
                                                            </li>
                                                            <li>
                                                                <a href="pages/dokter/worklist_lab.php?id=<?php echo md5($data[$i]['resep'])?>">Input Penunjang Medis Laboratorium</a>
                                                            </li>
                                                            <li>
                                                                <a href="pages/dokter/worklist_rad.php?id=<?php echo md5($data[$i]['resep'])?>">Input Penunjang Medis Radiologi</a>
                                                            </li>
 							    <li>
                                                                <a href="index.php?mod=dokter&submod=keterangan_sehat_sakit&id=<?php echo $data[$i]['nomr'] . '&ids=' . $data[$i]['no_daftar'] ?>">Keterangan Sehat & Sakit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                  	<?php
                                                          } 
                                                    ?>
                                              	</td>
                                                <td><?php echo $data[$i]['nomr'].'<br>'.$data[$i]['berobat'].'<br>'.$data[$i]['hubungan']?></td>
                                                <td><?php echo $data[$i]['umur']?></td>
                                                <td><?php echo $data[$i]['pekerjaan']?></td>
                                                <td><?php echo $data[$i]['tgl_daftar']?></td>
                                                <td><?php echo $data[$i]['nama_perusahaan']?></td>
                                                <td><?php echo $dokter?></td>
                                                <td><?php echo $data[$i]['nama_poli']?></td>
                                                <td><?php echo $data[$i]['status_pasien']?></td>
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
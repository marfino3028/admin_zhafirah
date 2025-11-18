<?php
	
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
	
	// Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-excel");
	 
	// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=Laporan1.xls");
?><div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Lap.Kunjungan Karyawan Indolakto
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i>
                                    </h3>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr style="border: 1px solid #000000">
                                            <th style="width:40px" rowspan="2">No</th>
                                            <th rowspan="2">Tgl. Berobat</th>
                                            <th rowspan="2">NIP/NIK</th>
                                            <th rowspan="2">Departemen</th>
                                            <th colspan="3" style="text-align: center;">Pasien</th>
                                            <th rowspan="2">Keluhan</th>
                                            <th rowspan="2">TD</th>
                                            <th rowspan="2">Diagnosis</th>
                                            <th rowspan="2">Pengantar</th>
                                        </tr>
                                        <tr style="border: 1px solid #000000">
                                            <th>Karyawan</th>
                                            <th>Istri</th>
                                            <th>Anak</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select a.tgl_daftar, a.id, a.nomr, a.yang_berobat, b.nip, b.dept_nama, b.nm_pasien nama, a.no_daftar from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where a.status_delete='UD' and a.tgl_daftar >= '".$_POST['d11']."' and a.tgl_daftar <= '".$_POST['d12']."' order by a.id ASC", 0);
                                        for ($i = 0; $i < count($data); $i++) {
					   $temp = substr(substr($data[$i]['yang_berobat'], -5) ,0 , 4);
					   $sub = $db->query("select cc_hpi, v_bp, as_diagnosis, rujukan from tbl_catatan_dktr where nomr='".$data[$i]['nomr']."' and no_daftar='".$data[$i]['no_daftar']."'");
					   if ($temp == "ISTR") {
                                                $data[$i]['karyawan'] = "";
                                                $data[$i]['istri'] = str_replace(" - ISTRI", "", $data[$i]['yang_berobat']);
                                                $data[$i]['anak'] = "";
					   }
					   elseif ($temp == "diri") {
                                                $data[$i]['karyawan'] = $data[$i]['nama'];
                                                $data[$i]['istri'] = "";
                                                $data[$i]['anak'] = "";
					   }
					   elseif ($temp == " ANA") {
                                                $data[$i]['karyawan'] = "";
                                                $data[$i]['istri'] = "";
                                                $data[$i]['anak'] = str_replace(" - ANAK", "", $data[$i]['yang_berobat']);
					   }
                                           $temp = "";
                                        ?>
                                            <tr style="border: 1px solid #000000">
                                                <td style="text-align: center;"><?php echo $i+1?></td>
                                                <td><?php echo date("d F Y", strtotime($data[$i]['tgl_daftar']))?></td>
                                                <td><?php echo $data[$i]['nip']?></td>
                                                <td><?php echo $data[$i]['dept_nama']?></td>
                                                <td><?php echo $data[$i]['karyawan']?></td>
                                                <td><?php echo $data[$i]['istri']?></td>
                                                <td><?php echo $data[$i]['anak']?></td>
                                                <td><?php echo $sub[0]['cc_hpi']?></td>
                                                <td><?php echo $sub[0]['v_bp']?></td>
                                                <td><?php echo $sub[0]['as_diagnosis']?></td>
                                                <td><?php echo $sub[0]['rujukan']?></td>
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

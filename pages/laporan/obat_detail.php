
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Laporan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Lap.Pemakaian Obat di Indolakto</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Lap.Pemakaian Obat di Indolakto
                    </h3>
                </div>
	<?php
	   if ($_POST['d11'] == "") $d1 = date("Y-m-d");
	   else $d1 = $_POST['d11'];

	   if ($_POST['d12'] == "") $d2 = date("Y-m-d");
	   else $d2 = $_POST['d12'];
	?>
                <div class="box-title">
                    <div class="box">
		<form action="" method="POST" id="filterReport" class='form-horizontal form-bordered'>
		<div class="col-sm-12">	
			<div class="form-group">
				<label for="textfield" class="control-label col-sm-3"></label>
				<div class="col-sm-2">
					<input name="d11" id="d11" class="form-control" autocomplete="off" data-rule-required="true" value="<?php echo $d1?>" type="date">
				</div>
				<div class="col-sm-2">
					<input name="d12" id="d12" class="form-control" autocomplete="off" data-rule-required="true" value="<?php echo $d2?>" type="date">
				</div>
				<div class="col-sm-1">
					<button type="submit" class="btn btn-primary">View</button>
				</div>
				<div class="col-sm-1" id="tombolTombol">
                <?php
					if ($_POST['d11'] != "" or $_POST['d12'] != "") {
						echo '<button type="button" class="btn btn-primary" onclick="SimpanExcel(this.form, \'obat_detail_excel.php\')">Excell</button>';
					}
					else {
						echo '<button type="button" class="btn btn-primary" disabled="disabled">Excell</button>';
					}
				?>
				</div>
			</div>
		</div>
		</form>
                    </div>
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
                                        <tr>
                                            <th style="width:40px" rowspan="2">No</th>
                                            <th rowspan="2">Tgl. Berobat</th>
                                            <th rowspan="2">NIP/NIK</th>
                                            <th rowspan="2">Departemen</th>
                                            <th colspan="3" style="text-align: center;">Pasien</th>
                                            <th rowspan="2">Diagnosis</th>
                                            <th rowspan="2">Nama Obat</th>
                                            <th rowspan="2">Jumlah Obat</th>
                                        </tr>
                                        <tr>
                                            <th>Karyawan</th>
                                            <th>Istri</th>
                                            <th>Anak</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select a.tgl_daftar, a.id, a.nomr, a.yang_berobat, b.nip, b.dept_nama, b.nm_pasien nama, a.no_daftar from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where a.status_delete='UD' and a.tgl_daftar >= '$d1' and a.tgl_daftar <= '$d2' order by a.id ASC", 0);
                                        for ($i = 0; $i < count($data); $i++) {
					   $temp = substr(substr($data[$i]['yang_berobat'], -5) ,0 , 4);
					   $sub = $db->query("select cc_hpi, v_bp, as_diagnosis, rujukan from tbl_catatan_dktr where nomr='".$data[$i]['nomr']."' and no_daftar='".$data[$i]['no_daftar']."'");
					   if ($temp == "ISTR") {
                                                $data[$i]['karyawan'] = "-";
                                                $data[$i]['istri'] = str_replace(" - ISTRI", "", $data[$i]['yang_berobat']);
                                                $data[$i]['anak'] = "-";
					   }
					   elseif ($temp == "diri") {
                                                $data[$i]['karyawan'] = $data[$i]['nama'];
                                                $data[$i]['istri'] = "-";
                                                $data[$i]['anak'] = "-";
					   }
					   elseif ($temp == " ANA") {
                                                $data[$i]['karyawan'] = "-";
                                                $data[$i]['istri'] = "-";
                                                $data[$i]['anak'] = str_replace(" - ANAK", "", $data[$i]['yang_berobat']);
					   }
                                           $temp = "";
					   $sb = $db->queryItem("select no_resep from tbl_resep where nomr='".$data[$i]['nomr']."' and no_daftar='".$data[$i]['no_daftar']."'");
						$resep_obat = "";
						$jml_obat = 0;
						$resep = $db->query("select nama_obat, qty from tbl_resep_detail where no_resep='$sb'");
						for ($j = 0; $j < count($resep); $j++) {
							$resep_obat = $resep_obat.$resep[$j]['nama_obat'].' (<strong>Qty: '.$resep[$j]['qty'].' item</strong>)<br>';
							$jml_obat = $jml_obat + 1;
						}
                                        ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $i+1?></td>
                                                <td><?php echo date("d F Y", strtotime($data[$i]['tgl_daftar']))?></td>
                                                <td><?php echo $data[$i]['nip']?></td>
                                                <td><?php echo $data[$i]['dept_nama']?></td>
                                                <td><?php echo $data[$i]['karyawan']?></td>
                                                <td><?php echo $data[$i]['istri']?></td>
                                                <td><?php echo $data[$i]['anak']?></td>
                                                <td><?php echo $sub[0]['as_diagnosis']?></td>
                                                <td><?php echo $resep_obat?></td>
                                                <td><?php echo $jml_obat?></td>
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
	function SimpanExcel(t, url) {
		url = "pages/laporan/" + url;
		document.getElementById('filterReport').action = url;
		t.submit();
	}
</script>

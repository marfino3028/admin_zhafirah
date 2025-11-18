<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Medical Report</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Medical Record Pasien
                    </h3>
                </div>
                <div class="box-content">
		    <form method="post" action="index.php?mod=pasien&submod=medical_record" class='search-form'>
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        NOMR <input type="text" value="<?php echo $_POST['nomr']?>" id="nomr" name="nomr" size="10" />
                        Atau Nama <input type="text" id="search" name="search" value="<?php echo $_POST['search']?>" size="20" /> 
                        Atau Tanggal Lahir <input type="date" value="<?php echo $_POST['tgl_lahir']?>" id="tgl_lahir" name="tgl_lahir" size="10" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" class="btn btn-darkblue rounded" value=" View!! "  onclick="TampilLaporan()"  />

                    </div>
		    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i> Daftar Pasien (Medical Report)
                                    </h3>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                	<?php
										if ($_POST['nomr'] !="" or $_POST['search'] !="" or $_POST['tgl_lahir'] !="") {
									?>
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th style="width:70px">NOMR</th>
                                            <th>Nama Pasien</th>
                                            <th>Tgl Lahir Pasien</th>
                                            <th>Alamat</th>
                                            <th style="width: 90px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        if ($_POST['search'] != "" and  $_POST['nomr'] == "" and $_POST['tgl_lahir'] == ""){
                                            $data = $db->query("select DISTINCT a.nomr, b.nm_pasien nama, b.tgl_lahir, b.tmpt_lahir, b.alamat_pasien from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr where b.nm_pasien like '%".$_POST['search']."%' order by b.nm_pasien", 0);
					}
                                        elseif ($_POST['search'] == "" and  $_POST['nomr'] != "" and $_POST['tgl_lahir'] == ""){
                                            $data = $db->query("select DISTINCT nomr, nama, kode_perusahaan, nama_perusahaan, no_daftar, tgl_insert from tbl_kasir where nomr='".$_POST['nomr']."' order by tgl_insert desc", 0);
					}
                                        for ($i = 0; $i < count($data); $i++) {
                                            //$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
                                            //if ($dokter == "")	$dokter = $data[$i]['nama_poli'];
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['nomr']?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td><?php echo $data[$i]['tmpt_lahir'].', '.date("d F Y", strtotime($data[$i]['tgl_lahir']))?></td>
                                                <td><?php echo $data[$i]['alamat_pasien']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Detail Medical Record Pasien" href="#" onclick="printMR('<?php echo md5($data[$i]['nomr'])?>')">
                                                        <img src="images/mr_logo.png" width="20">
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Detail Medical Record Layanan HD Pasien untuk PHR" href="#" onclick="return window.location = 'index.php?mod=pasien&submod=medical_record_view&id=<?php echo md5($data[$i]['nomr'])?>';">
                                                        <img src="images/phr_logo.png" width="30">
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
					<?php
						}
					?>
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
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
	function printMR(id) {
		var w = screen.width;
		var h = screen.height;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/pasien/medical_report_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
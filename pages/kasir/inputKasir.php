<?php
	date_default_timezone_set('Asia/Jakarta');
	if ($_POST['tgl_daftar'] == "")  $_POST['tgl_daftar'] = date("Y-m-d");
?>

    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Kasir</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Pembayaran Kasir</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Pembayaran Kasir
                        </h3>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i> Daftar Pembayaran Pasien
                                        </h3>
                                        <a href="index.php?mod=kasir&submod=input_kasir_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pembayaran</a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

        		<form action="index.php?mod=kasir&submod=inputKasir" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            			<div class="row">
                    			<div class="form-group">
                        			<div class="col-sm-1">&nbsp;</div>
                        			<div class="col-sm-3">
                            				<label for="textfield" class="control-label">Tanggal Daftar</label>
                            				<input type="date" id="nama" name="tgl_daftar" placeholder="Nama Obat" class="form-control" value="<?php echo $_POST['tgl_daftar']?>" />
                        			</div>
                        			<div class="col-sm-3">
                            				<label for="textfield" class="control-label">Nomor MR</label>
                            				<input type="text" id="nomr" name="nomr" placeholder="Nomor MR" class="form-control" value="<?php echo $_POST['nomr']?>" />
                        			</div>
                        			<div class="col-sm-3">
                            				<label for="textfield" class="control-label">Nama Pasien</label>
                            				<input type="text" id="pasien" name="pasien" placeholder="Nama Pasien" class="form-control" value="<?php echo $_POST['pasien']?>" />
                        			</div>
                    				<div class="form-actions col-sm-1" style="margin-top: 40px;">
                        				<input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Cari..." />
                        			</div>
                    			</div>
            			</div>
        		</form>
				<div style="margin-top: 20px; margin-left: 10px; margin-right: 10px; margin-bottom: 25px;">
                                        <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width:40px">No</th>
                                                <th>Tgl Daftar</th>
                                                <th style="width:70px">NOMR</th>
                                                <th>Nama Pasien</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Poli</th>
                                                <th style="text-align: right;">Pasien</th>
                                                <th style="text-align: right;">Asuransi</th>
                                                <th style="text-align: right;">Total</th>
                                                <th>User</th>
                                                <th style="width:170px">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
						$sqlquery = "";
						if ($_POST['nomr'] != "" and $_POST['pasien'] == "") $sqlquery = " a.nomr like '%".$_POST['nomr']."%'";
						elseif ($_POST['pasien'] != "" and $_POST['nomr'] == "") $sqlquery = " a.nama like '%".$_POST['pasien']."%'";
						else $sqlquery = " a.nama like '%".$_POST['pasien']."%' and a.nomr like '%".$_POST['nomr']."%'";

						if ($_POST['nomr'] != "" or $_POST['pasien'] != "") {
                                                	$data = $db->query("select a.*, b.tgl_daftar from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where $sqlquery order by a.tgl_insert desc", 0);
						}
						else {
							$data = $db->query("select a.*, b.tgl_daftar from tbl_kasir a left join tbl_pendaftaran b on b.no_daftar=a.no_daftar where b.tgl_daftar='".$_POST['tgl_daftar']."' order by a.tgl_insert desc", 0);
						}
                                            for ($i = 0; $i < count($data); $i++) {



                                                $tst = explode("-", $data[$i]['no_daftar']);
                                                if ($tst[0] == 'JAM') {
                                                    $poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran_jamsostek a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$tst[1]."'");
                                                }
                                                else {
                                                    $poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."'");
						    if ($poli == "") $poli = $db->queryItem("select a.kd_poli from tbl_pendaftaran a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."'");
                                                }
                                                $biaya = $db->query("select payment_to, sum(bayar) as total from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' group by payment_to order by payment_to", 0);
                                                $no = $start + $i + 1;

                                                if ($data[$i]['nama'] == "") {
                                                    $data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
                                                    $data[$i]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
                                                    $poli = $db->queryItem("select kd_poli from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
                                                    $data[$i]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'");
                                                }
                                                if ($data[$i]['nama'] == "") {
                                                    $id_pl = str_replace('PL/', '', ($data[$i]['no_daftar']));
                                                    $pelayanan_lain = $db->query("select * from tbl_pelayanan_lainnya AS a WHERE a.Id = ".$id_pl." ",0);
                                                    $data[$i]['nama'] = $pelayanan_lain[0]['NamaPasien'];
                                                }

                                                ?>
                                                <tr>
                                                    <td><?php echo $no?></td>
                                                    <td><?php echo $data[$i]['tgl_daftar']?></td>
                                                    <td><?php echo $data[$i]['nomr']?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td><?php echo $data[$i]['nama_perusahaan']?></td>
                                                    <td><?php echo $poli?></td>
                                                    <td style="text-align: right;"><?php echo number_format($biaya[1]['total'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format($biaya[0]['total'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format($data[$i]['total'])?></td>
                                                    <td><?php echo $data[$i]['user_insert']?></td>
                                                    <td class="text-center">
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Pembayaran Pasien" onclick="BayarKasir('<?php echo $data[$i]['no_kwitansi']?>')" href="#">
                                                            <span class="ui-icon ui-icon-print"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Pembayaran Asuransi" onclick="BayarKasirAsuransi('<?php echo $data[$i]['no_kwitansi']?>')" href="#">
                                                            <span class="ui-icon ui-icon-print"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi Pembayaran" onclick="BayarKasirKwitansi('<?php echo $data[$i]['no_kwitansi']?>')" href="#">
                                                            <span class="ui-icon ui-icon-print"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Pembatalan Pendaftaran Pasien" href="#" onclick="return window.location = 'pages/kasir/delete_transaksi.php?id=<?php echo $data[$i]['id']?>';">
                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                        </a>
                                                        <a class="btn_no_text" title="Kirim Bukti Bayar Melalui WhatsApp" href="#" onclick="return window.location = 'pages/kasir/wa_transaksi.php?id=<?php echo md5($data[$i]['no_kwitansi'])?>';">
                                                            <img src="images/wa_logo.png" width="16" style="margin-top: 7px; margin-left: -15px;">
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

<script language="javascript">
	function BayarKasir(id) {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/kasir/print_pembayaran.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}

	function BayarKasirAsuransi(id) {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

		
		var URL = 'pages/kasir/print_pembayaran_asuransi.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
	
	function BayarKasirKwitansi(id) {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

		
		var URL = 'pages/kasir/print_kwitansi_pembayaran_input.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	
	}
</script>
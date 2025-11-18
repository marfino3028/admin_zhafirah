<?php
	date_default_timezone_set('Asia/Jakarta');
	if ($_POST['tgl_daftar'] == "")  $_POST['tgl_daftar'] = date("Y-m-d");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Jurnal Entri</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Pembuatan Jurnal Entri
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Jurnal Entri | <a href="index.php?mod=keuangan&submod=jurnal_saldo_awal_list" style="color: white;">Daftar Saldo Awal</a>
                                    </h3>
                                    <a href="index.php?mod=keuangan&submod=jurnal_saldo_awal" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Saldo Awal</a>
                                    <a href="index.php?mod=keuangan&submod=jurnal_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Jurnal</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
        		<form action="index.php?mod=keuangan&submod=jurnal_entri" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            			<div class="row">
                    			<div class="form-group">
                        			<div class="col-sm-1">&nbsp;</div>
                        			<div class="col-sm-3">
                            				<label for="textfield" class="control-label">Tanggal Posting</label>
                            				<input type="date" id="nama" name="tgl_daftar" placeholder="Nama Obat" class="form-control" value="<?php echo $_POST['tgl_daftar']?>" />
                        			</div>
                        			<div class="col-sm-3">
                            				<label for="textfield" class="control-label">Nomor Register</label>
                            				<input type="text" id="noreg" name="noreg" placeholder="Nomor Register" class="form-control" value="<?php echo $_POST['noreg']?>" />
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
				   <div style="margin-top: 20px; margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
                                    <table id="table-data" class="table table-hover table-nomargin table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Posting</th>
                                            <th>No. Dokumen</th>
                                            <th>Keterangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
						$sqlquery = "";
						if ($_POST['noreg'] != "" and $_POST['pasien'] == "") $sqlquery = " reg_no like '%".$_POST['noreg']."%'";
						elseif ($_POST['pasien'] != "" and $_POST['noreg'] == "") $sqlquery = " deskripsi like '%".$_POST['pasien']."%'";
						else $sqlquery = " deskripsi like '%".$_POST['pasien']."%' or reg_no like '%".$_POST['noreg']."%'";

                                            	$data = $db->query("select no_dokumen, count(no_dokumen) jumlah from tbl_jurnal where $sqlquery group by no_dokumen order by no_dokumen desc", 0);
						$no = 0;
                                        	for ($i = 0; $i < count($data); $i++) {
							if ($_POST['nomr'] == "" and $_POST['pasien'] == "") {
								$detail = $db->query("select tanggal, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, status_jurnal from tbl_jurnal where no_dokumen='".$data[$i]['no_dokumen']."' and tanggal='".$_POST['tgl_daftar']."'", 0);
							}
							else {
								$detail = $db->query("select tanggal, keterangan, gl_kode, gl_nama, deskripsi, debit, credit, status_jurnal from tbl_jurnal where no_dokumen='".$data[$i]['no_dokumen']."'", 0);
							}
							if ($detail[0]['tanggal'] != "") {
								$no = $no + 1;
                                        ?>
                                            <tr>
                                                <td align="center"><?php echo $no?></td>
                                                <td><?php echo date("d F Y", strtotime($detail[0]['tanggal'])).' ('.$detail[0]['status_jurnal'].')'?></td>
                                                <td><?php echo '<u>'.$data[$i]['no_dokumen'].'</u> <i class="glyphicon-search" style="float: right; cursor: pointer;" title="Lihat Detail Jurnal" onclick="Detail_Jurnal(\''.md5($data[$i]['no_dokumen']).'\')"></i>'?></td>
                                                <td><?php echo $detail[0]['keterangan']?></td>
                                            </tr>
                                            <?php
							}
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
</div>
        <script>
            // $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>
	<script language="javascript">
		function HapusDataJurnal(id, no) {
			var r = confirm("Apakan Anda Yakin akan Menghapus Jurnal ini " + no +"?");
			if (r == true) {
		  		window.location = "pages/keuangan/jurnal_delete.php?id=" + id;
			}
		}	

		function Detail_Jurnal(id) {
			var w = 850;
			var h = 500;
			var l = (screen.width - w) / 2;
			var t = (screen.height - h) / 2;
			var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
			var URL = 'pages/keuangan/jurnal_print.php?id=' + id;
			popup = window.open(URL,"",windowprops);
		}	
	</script>
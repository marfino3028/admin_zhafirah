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
                <a href="javascript:void(0)">Jurnal Entri Saldo Awal</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Pembuatan Jurnal Entri Saldo Awal
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					<a href="index.php?mod=keuangan&submod=jurnal_entri" style="color: white;">Daftar Jurnal Entri</a> | Daftar Saldo Awal
                                    </h3>
                                    <a href="index.php?mod=keuangan&submod=jurnal_saldo_awal" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Saldo Awal</a>
                                    <a href="index.php?mod=keuangan&submod=jurnal_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Jurnal</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
				   <div style="margin-top: 20px; margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
                                    <table id="table-data" class="table table-hover table-nomargin table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Posting</th>
                                            <th>Kode</th>
                                            <th>Akun</th>
                                            <th>Nilai</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
						$data = $db->query("select * from tbl_jurnal_saldo_awal order by kode_akun", 0);
						$no = 0;
                                        	for ($i = 0; $i < count($data); $i++) {
							$no = $no + 1;
                                        ?>
                                            <tr>
                                                <td align="center"><?php echo $no?></td>
                                                <td><?php echo date("d F Y", strtotime($data[$i]['tanggal']))?></td>
                                                <td><?php echo $data[$i]['kode_akun']?></td>
                                                <td><?php echo $data[$i]['nama_akun']?></td>
                                                <td style="text-align: right;">
							<div style="float: left;">Rp.</div>
							<?php echo number_format($data[$i]['nilai'])?>
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
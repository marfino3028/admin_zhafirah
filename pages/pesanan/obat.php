    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Transaksi</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Pesanan Obat</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Pemesanan Obat
                        </h3>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i> Daftar Pemesanan Obat
                                        </h3>
                                        <a href="index.php?mod=pesanan&submod=obat_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pesanan Baru</a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">
										<div style="margin-left: 10px; margin-right: 10px;">
                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Metode Bayar</th>
                                                <th>Pengiriman</th>
                                                <th>Ongkir</th>
                                                <th style="width:70px">Obat</th>
                                                <th style="width:80px">Qty</th>
                                                <th style="width:80px">Total</th>
                                                <th>Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            	$data = $db->query("select * from tbl_pesanan_obat order by id desc", 0);
                                            	for ($i = 0; $i < count($data); $i++) {
													$no = $no + 1;
													$obat = $db->query("select kode_obat from tbl_pesanan_obat_detail where pesanan_id='".$data[$i]['id']."' group by kode_obat");
													$obatqty = $db->query("select sum(qty) jml from tbl_pesanan_obat_detail where pesanan_id='".$data[$i]['id']."'");
													if ($data[$i]['nama'] == "") $data[$i]['nama'] = "-belum-";
													if ($data[$i]['pembayaran'] == "") $data[$i]['pembayaran'] = "-belum-";
													if ($data[$i]['pengiriman_by'] == "") $data[$i]['pengiriman_by'] = "-belum-";
                                            ?>
                                                <tr>
                                                    <td><?php echo $no?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td><?php echo $data[$i]['pembayaran']?></td>
                                                    <td><?php echo $data[$i]['pengiriman_by']?></td>
                                                    <td style="text-align: right;"><?php echo number_format($data[$i]['ongkir'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format(count($obat))?> macam obat</td>
                                                    <td style="text-align: right;"><?php echo number_format($obatqty[0]['jml'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format($data[$i]['total_harga'])?></td>
                                                    <td class="text-center">
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Pembayaran Pasien" onclick="return window.location = 'index.php?mod=pesanan&submod=obat_tambahan&id=<?php echo md5($data[$i]['id'])?>'" href="#">
                                                            <span class="ui-icon ui-icon-wrench"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Hapus Data" href="#" onclick="hapusPesanan('<?php echo md5($data[$i]['id'])?>')">
                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Bayar Pesanan" href="#" onclick="bayarPesanan('<?php echo md5($data[$i]['id'])?>')">
                                                            <span class="ui-icon ui-icon-search"></span>
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
    </div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
<script language="javascript">
	function hapusPesanan(id) {
		if (confirm("Apakah Anda yakin akan menghapus pesanan Obat ini") == true) {
			window.location = "pages/pesanan/obat_delete.php?id=" + id;
		}
	}

	function bayarPesanan(id) {
		window.location = "index.php?mod=pesanan&submod=obat_bayar&id=" + id;
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
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Piutang</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembuatan Invoice</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Pembuatan Invoice
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Data Pembuatan Invoice
                                    </h3>
                                    <a href="index.php?mod=piutang&submod=invoice_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Invoice</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No. Invoice</th>
                                                <th>Nama Asuransi</th>
                                                <th>Tgl Kirim</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Total</th>
                                                <th>Bayar</th>
                                                <th>Sisa</th>
                                                <th style="width:100px">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $start = $_GET['start'];
                                            $apage = $_GET['apage'];
                                            $number = $_GET['number'];
                                            if (!isset($start)) $start = 0;
                                            if (!isset($apage)) $apage = 5;

                                            if ($_POST['search'] == "")
                                                $data_nr = $db->queryItem("select count(id) from tbl_invoice", 0);
                                            else
                                                $data_nr = $db->queryItem("select count(id) from tbl_invoice where  nama like '%" . $_POST['search'] . "%'", 0);
                                            $nrdata = $data_nr;

                                            if (!isset($number)) $number = $nrdata;
                                            $page = new pages();
                                            if ($_POST['search'] == "")
                                                $page->link = "index.php?mod=piutang&submod=invoice";
                                            else
                                                $page->link = "index.php?mod=piutang&submod=invoice&search=" . $_POST['search'];

                                            $page->start = $start;
                                            $page->apage = $apage;
                                            $page->number = $number;
                                            $page->total();
                                            $pagehtml = $page->html;

                                            if ($_POST['search'] == "") {
                                                $data = $db->query("select * from tbl_invoice order by id desc", 0);
                                            } else {
                                                $data = $db->query("select * from tbl_invoice where no_inv like '%" . $_POST['search'] . "%' order by id desc", 0);
                                            }
                                            for ($i = 0; $i < count($data); $i++) {
                                                $bayar = $db->queryItem("select sum(bayar) from tbl_kasir_detail where payment_to='ASURANSI' and no_kwitansi in (select b.no_kwitansi from tbl_invoice_detail a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.status_bayar='SDH' and a.invoiceID='" . $data[$i]['id'] . "')");
                                                //print_r($bayar);
                                                $sisa = $data[$i]['total'] - $bayar;
                                            ?>
                                                <tr>
                                                    <td><?php echo $i + 1 ?></td>
                                                    <td><?php echo $data[$i]['no_inv'] ?></td>
                                                    <td><?php echo $data[$i]['nama_perusahaan'] ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_kirim'])) ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_jatuh_tempo'])) ?></td>
                                                    <td align="right">
                                                        <div align="right"><?php echo number_format($data[$i]['total']) ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php echo number_format($bayar) ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php echo number_format($sisa) ?></div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Pembayaran Invoice" href="index.php?mod=piutang&submod=invoice_bayar&id=<?php echo $data[$i]['id'] ?>">
                                                            <span class="ui-icon ui-icon-calculator"></span>
                                                        </a>
                                                    	<a class="btn_no_text btn" style="border-radius: 4px;" title="Cancel Invoice" href="#" onclick="return window.location = 'pages/piutang/invoice_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        	<span class="ui-icon ui-icon-circle-close"></span>
                                                    	</a>  
							<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Invoice" onclick="PrintInvoice2('<?php echo $data[$i]['id'] ?>')" href="#">
                                                            <span class="ui-icon ui-icon-print"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="PrintKwitansi('<?php echo $data[$i]['id'] ?>')" href="#">
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
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    })
</script>
<script language="javascript">
    function PrintInvoice(id) {
        var w = 1000;
        var h = 500;
        var l = (screen.width - w) / 2;
        var t = (screen.height - h) / 2;
        var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

        var URL = 'pages/piutang/invoice_print.php?id=' + id;
        popup = window.open(URL, "", windowprops);
    }

    function PrintInvoice2(id) {
        var w = 1000;
        var h = 500;
        var l = (screen.width - w) / 2;
        var t = (screen.height - h) / 2;
        var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

        var URL = 'pages/piutang/invoice_print2.php?id=' + id;
        popup = window.open(URL, "", windowprops);
    }

    function PrintKwitansi(id) {
        var w = 1000;
        var h = 500;
        var l = (screen.width - w) / 2;
        var t = (screen.height - h) / 2;
        var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

        var URL = 'pages/piutang/kwitansi_print.php?id=' + id;
        popup = window.open(URL, "", windowprops);
    }
</script>
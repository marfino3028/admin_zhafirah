<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
?>
    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Poli</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Poli Karyawan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Poli Karyawan
                        </h3>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i>
                                        </h3>
                                        <a href="index.php?mod=poli&submod=input_karyawan_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Poli Karyawan </a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:30px">No</th>
                                                <th style="width:70px">No. Polkar </th>
                                                <th style="width:70px">NOMR</th>
                                                <th>Nama Karyawan</th>
                                                <th style="width:70px">Status</th>
                                                <th style="width:90px">Total Harga</th>
                                                <th style="width:140px">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $start = $_GET['start'];
                                            $apage = $_GET['apage'];
                                            $number = $_GET['number'];
                                            if(!isset($start)) $start=0;
                                            if(!isset($apage)) $apage=3;

                                            if ($_POST['search'] == "")
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_polkar a where a.status_delete='UD'", 0);
                                            else
                                                $data_nr = $db->queryItem("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar from tbl_polkar a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
                                            $nrdata = $data_nr;

                                            if(!isset($number)) $number=$nrdata;
                                            $page=new pages();
                                            if ($_POST['search'] == "")
                                                $page->link="index.php?mod=poli&submod=karyawan";
                                            else
                                                $page->link="index.php?mod=poli&submod=wicara&search=".$_POST['search'];

                                            $page->start=$start;
                                            $page->apage=$apage;
                                            $page->number=$number;
                                            $page->total();
                                            $pagehtml=$page->html;

                                            if ($_POST['search'] == "")
                                                $data = $db->query("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar, a.no_daftar, a.status_bayar from tbl_polkar a where a.status_delete='UD' order by a.id desc", 0);
                                            else
                                                $data = $db->query("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar, a.no_daftar, a.status_bayar from tbl_polkar a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' and status_delete='UD' order by a.id desc", 0);
                                            for ($i = 0; $i < count($data); $i++) {
                                                $no = $start + $i + 1;
                                                $racikan = $db->queryItem("select sum(total) from tbl_polkar_detail where jenis='R' and status_delete='UD' and no_polkar='".$data[$i]['no_polkar']."'");
                                                if ($racikan > 0)	$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                else $embalase = 0;
                                                $total = $data[$i]['total_harga_polkar'] + $racikan + $embalase;
                                                ?>
                                                <tr>
                                                    <td><?php echo $no?></td>
                                                    <td><?php echo $data[$i]['no_polkar']?></td>
                                                    <td><?php echo $data[$i]['nomr']?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td><?php echo $data[$i]['status_bayar']?></td>
                                                    <td align="right"><div align="right"><?php echo number_format($total)?></div></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($data[$i]['status_bayar'] == 'LUNAS') {
                                                            ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="#">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#">
                                                                <span class="ui-icon ui-icon-circle-close"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Bayar" href="#">
                                                                <span class="ui-icon ui-icon-document"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="printWicara('<?php echo $data[$i]['no_polkar']?>')" href="#">
                                                                <span class="ui-icon ui-icon-print"></span>
                                                            </a>
                                                            <?php
                                                        }
                                                        else {
                                                            ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=poli&submod=input_polkar_tindakan&id=<?php echo $data[$i]['id']?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/karyawan_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                                <span class="ui-icon ui-icon-circle-close"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Input Pembayaran" href="index.php?mod=poli&submod=bayar_polkar&id=<?php echo $data[$i]['id'].'&total='.$total?>">
                                                                <span class="ui-icon ui-icon-document"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="printWicara('<?php echo $data[$i]['no_polkar']?>')" href="#">
                                                                <span class="ui-icon ui-icon-print"></span>
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
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
	function printWicara(id) {
		var w = 650;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/poli/polkar_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
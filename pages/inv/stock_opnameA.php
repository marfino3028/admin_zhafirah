<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">STOCK OPNAME APOTIK</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        STOCK OPNAME APOTIK
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
                                        List / Daftar STOCK OPNAME APOTIK
                                    </h3>
                                    <a href="index.php?mod=inv&submod=stock_opname_apotik" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Detail</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>No Opname</th>
                                            <th style="width:120px">Tanggal Opname</th>
                                            <th style="width:100px">Obat Opname</th>
                                            <th style="width:100px">Jml QTY Obat</th>
                                            <th style="width:100px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $start = $_GET['start'];
                                        $apage = $_GET['apage'];
                                        $number = $_GET['number'];
                                        if(!isset($start)) $start=0;
                                        if(!isset($apage)) $apage=5;

                                        if ($_POST['search'] == "")
                                            $data_nr = $db->queryItem("select count(id) from tbl_opname_apotik where input_by='".$_SESSION['rg_user']."'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_opname_apotik where input_by='".$_SESSION['rg_user']."' and no_opn_apotik like '%".$_POST['search']."%'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=inv&submod=stock_opnameG";
                                        else
                                            $page->link="index.php?mod=inv&submod=stock_opnameG&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from  tbl_opname_apotik where input_by='".$_SESSION['rg_user']."' order by tgl_input_opn_apotik desc", 0);
                                        else
                                            $data = $db->query("select * from  tbl_opname_apotik where input_by='".$_SESSION['rg_user']."' and no_opn_apotik like '%".$_POST['search']."%' order by tgl_input_opn_apotik desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $i + 1;
                                            ?>
                                            <tr>
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['no_opn_apotik']?></td>
                                                <td class="center"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_opn_apotik']))?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['jml_obat'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['qty_obat'])?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=input_stock_opnameApotik_detail&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ro_gudang_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Copy Resep" onclick="copyResep('<?php echo md5($data[$i]['no_opn_apotik'])?>')" href="#">
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
            $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>
<script language="javascript">
	function BayarKasir(id) {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/kasir/print_pembayaran.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
	
	function copyResep(id) {
		var w = 950;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/inv/opn_apotik_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
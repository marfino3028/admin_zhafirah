<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">PEMBELIAN OBAT LANGSUNG</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Pembelian Obat Langsung (Cito)
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
                                    <a href="index.php?mod=inv&submod=cito_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Detail</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>No CITO</th>
                                            <th style="width:200px">Supplier</th>
                                            <th style="width:100px">Jumlah Obat</th>
                                            <th style="width:100px">Total Pembelian</th>
                                            <th style="width:70px">Option</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_cito where input_by='".$_SESSION['rg_user']."'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_cito where input_by='".$_SESSION['rg_user']."' and no_cito like '%".$_POST['search']."%'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=inv&submod=cito";
                                        else
                                            $page->link="index.php?mod=inv&submod=cito&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from  tbl_cito where input_by='".$_SESSION['rg_user']."' and status_delete='UD' order by tgl_input_cito desc", 0);
                                        else
                                            $data = $db->query("select * from  tbl_cito where input_by='".$_SESSION['rg_user']."' and no_cito like '%".$_POST['search']."%' and status_delete='UD' order by tgl_input_cito desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $i + 1;
                                            if ($data[$i]['status_move'] == 'NM') $data[$i]['status_movetxt'] = 'No Move';
                                            elseif ($data[$i]['status_move'] == 'M') $data[$i]['status_movetxt'] = 'Move';
                                            ?>
                                            <tr>
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['no_cito']?></td>
                                                <td class="center"><?php echo $data[$i]['nama_suplier']?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['qty_obat'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['total_harga_beli'])?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=cito_detail&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/cito_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
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
		
		var URL = 'pages/inv/ro_gudang_print.php?id=' + id;
		location.reload(true);
		popup = window.open(URL,"",windowprops);
	}
</script>
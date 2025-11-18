<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Transfer Obat: dari Gudang ke Apotik</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Transfer Obat dari Gudang ke Apotik
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Data Transfer Obat dari Gudang ke Apotik
                                    </h3>
                                    <a href="index.php?mod=inv&submod=transfer_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transfer Obat dari Gudang ke Depo</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>No Transfer</th>
                                            <th>No Request</th>
                                            <th style="width:120px">Tanggal Transfer</th>
                                            <th style="width:100px">Jumlah Obat</th>
                                            <th style="width:100px">Jumlah QTY</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_transfer where input_by='".$_SESSION['rg_user']."'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_transfer where input_by='".$_SESSION['rg_user']."' and no_transfer like '%".$_POST['search']."%'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=inv&submod=transfer";
                                        else
                                            $page->link="index.php?mod=inv&submod=transfer&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from  tbl_transfer where input_by='".$_SESSION['rg_user']."' order by tgl_input_transfer desc", 0);
                                        else
                                            $data = $db->query("select * from  tbl_transfer where input_by='".$_SESSION['rg_user']."' and no_transfer like '%".$_POST['search']."%' order by tgl_input_transfer desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $i + 1;
                                            ?>
                                            <tr>
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['no_transfer']?></td>
                                                <td><a class="btn_no_text btn" style="border-radius: 4px;" title="Lihat Request" onclick="copyResep1('<?php echo $data[$i]['no_ro_gudang']?>')" href="#"><?php echo $data[$i]['no_ro_gudang']?></a></td>
                                                <td class="center"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_transfer']))?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['jml_obat'])?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['qty_obat'])?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/transfer_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Copy Resep" onclick="copyResep('<?php echo $data[$i]['id']?>')" href="#">
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
	function copyResep(id) {
		var w = 950;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/inv/transfer_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
	function copyResep1(id) {
		var w = 950;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/inv/ro_gudang_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
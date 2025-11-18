    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Purchasing</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Permintaan Obat Dari Apotik Ke Gudang</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        PERMINTAAN OBAT DARI DEPO KE GUDANG
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Permintaan Obat dari Depo ke Gudang
                                    </h3>
                                    <a href="index.php?mod=inv&submod=input_ApotikGudang_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Detail</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:2px">No</th>
                                            <th style="width:70px">No Request</th>
                                            <th style="width:10px">Tanggal Request</th>
                                            <th style="width:10px">Jumlah Permintaan</th>
                                            <th style="width:20px">Unit Peminta</th>
					    <th style="width:20px">Unit diminta</th>
					    <th style="width:20px">Jenis Permintaan</th>
                                            <th style="width:50px">Option</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' and no_ro like '%".$_POST['search']."%'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=inv&submod=ApotikGudang";
                                        else
                                            $page->link="index.php?mod=inv&submod=ApotikGudang&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from  tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' order by tgl_input_ro_gudang desc", 0);
                                        else
                                            $data = $db->query("select * from  tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' and no_ro like '%".$_POST['search']."%' order by tgl_input_ro_gudang desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $i + 1;
                                            if ($data[$i]['status_move'] == 'NM') $data[$i]['status_movetxt'] = 'No Move';
                                            elseif ($data[$i]['status_move'] == 'M') $data[$i]['status_movetxt'] = 'Move';
                                            ?>
                                            <tr>
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['no_ro_gudang']?></td>
                                                <td class="center"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_ro_gudang']))?></td>
                                                <td style="text-align: right;"><?php echo number_format($data[$i]['total_permintaan'])?></td>
                                                <td style="text-align: center;"><?php echo $data[$i]['unit']?></td>
						<td style="text-align: center;"><?php echo $data[$i]['unit_diminta']?></td>
						<td style="text-align: center;"><?php echo $data[$i]['jenis']?></td>                                              
						<td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=input_ApotikGudang_detail&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ro_gudang_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Copy Resep" onclick="copyResep('<?php echo $data[$i]['no_ro_gudang']?>')" href="#">
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

<script language="javascript">
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
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
		// location.reload(true);
		popup = window.open(URL,"",windowprops);
	}
</script>
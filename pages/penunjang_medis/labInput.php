<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
?>
    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Penunjang Medis</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Laboratorium</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Laboratorium
                        </h3>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i> Data Pasien Lab
                                        </h3>
                                        <a href="index.php?mod=penunjang_medis&submod=input_lab_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Laboratorium </a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20px">No</th>
                                                <th style="width:110px">No. Lab </th>
                                                <th style="width:70px">NOMR</th>
                                                <th>Nama Pasien</th>
                                                <th style="width:80px">Total Harga</th>
                                                <th style="width:50px">Status</th>
                                                <th style="width:70px">Option</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $start = $_GET['start'];
                                            $apage = $_GET['apage'];
                                            $number = $_GET['number'];
                                            if(!isset($start)) $start=0;
                                            if(!isset($apage)) $apage=10;

                                            if ($_POST['search'] == "")
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_lab a where a.status_delete='UD'", 0);
                                            else
                                                $data_nr = $db->queryItem("select a.no_lab, a.nomr, a.nama, a.id, a.total_harga_lab from tbl_lab a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
                                            $nrdata = $data_nr;

                                            if(!isset($number)) $number=$nrdata;
                                            $page=new pages();
                                            if ($_POST['search'] == "")
                                                $page->link="index.php?mod=penunjang_medis&submod=labInput";
                                            else
                                                $page->link="index.php?mod=penunjang&submod=labInput&search=".$_POST['search'];

                                            $page->start=$start;
                                            $page->apage=$apage;
                                            $page->number=$number;
                                            $page->total();
                                            $pagehtml=$page->html;

                                            if ($_POST['search'] == "")
                                                $data = $db->query("select a.no_lab, a.nomr, a.nama, a.id, a.total_harga_lab, a.no_daftar from tbl_lab a where a.status_delete='UD' order by id desc", 0);
                                            else
                                                $data = $db->query("select a.no_lab, a.nomr, a.nama, a.id, a.total_harga_lab, a.no_daftar from tbl_lab a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' and status_delete='UD' order by id desc", 0);
                                            for ($i = 0; $i < count($data); $i++) {
                                                $no = $start + $i + 1;

                                                $cekKasir = $db->queryItem("select id from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
                                                if ($cekKasir > 0) {
                                                    $status = 'CLOSED';
                                                    $status_tombol = '1';
                                                }
                                                else {
                                                    $status = 'OPEN';
                                                    $status_tombol = '0';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $no?></td>
                                                    <td><?php echo $data[$i]['no_lab']?></td>
                                                    <td><?php echo $data[$i]['nomr']?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['total_harga_lab'])?></div></td>
                                                    <td align="right"><div align="center"><?php echo $status?></div></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($status_tombol == '1') {
                                                            echo '&nbsp;';
                                                        }
                                                        else {
                                                        ?>
                                                            <a title="Input Lab" href="index.php?mod=penunjang_medis&submod=input_lab_tindakan&id=<?php echo $data[$i]['id']?>">
                                                              <i class="glyphicon-edit" style="padding-top: 9px; padding-right: 1px;"></i>
                                                            </a>
                                                            <a title="Delete Data Lab" href="#" onclick="return window.location = 'pages/penunjang_medis/lab_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                              <i class="glyphicon-bin" style="padding-top: 9px; padding-right: 1px; color: red;"></i>
                                                            </a>
                                                      		<a title="Input Hasil Lab" href="index.php?mod=penunjang_medis&submod=input_lab_hasil&id=<?php echo md5($data[$i]['id'])?>">
                                                              <i class="glyphicon-hospital" style="padding-top: 9px; padding-right: 1px;"></i>
                                                            </a>
                                                          	<a title="Upload Hasil Lab" href="index.php?mod=penunjang_medis&submod=lab_hasil_upload&id=<?php echo md5($data[$i]['id'])?>">
                                                            	<i class="glyphicon-upload" style="padding-top: 9px; cursor: pointer; color: blue;"></i>
                                                          	</a>
                                                        <?php
                                                        }
                                                        ?>
                                                      	<a title="Print/Cetak Hasil Lab" href="#" onclick="PrintLab('<?php echo md5($data[$i]['no_lab'])?>')">
                                                        	<i class="glyphicon-print" style="padding-top: 9px; cursor: pointer; color: blue;"></i>
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
	function PrintLab(id) {
		var w = 850;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/penunjang_medis/hasil_lab_print.php?d1=' + id;
        popup = window.open(URL,"",windowprops);
	}
</script>
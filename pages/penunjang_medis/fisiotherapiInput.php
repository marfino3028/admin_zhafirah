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
                    <a href="javascript:void(0)">Fisiotherapi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Fisiotherapi
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
                                        <a href="index.php?mod=penunjang_medis&submod=input_fisio_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Fisiotherapi </a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:30px">No</th>
                                                <th style="width:90px">No. Fisiotherapi </th>
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
                                            if(!isset($apage)) $apage=5;

                                            if ($_POST['search'] == "")
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_fisio a where a.status_delete='UD'", 0);
                                            else
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_fisio a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
                                            $nrdata = $data_nr;

                                            if(!isset($number)) $number=$nrdata;
                                            $page=new pages();
                                            if ($_POST['search'] == "")
                                                $page->link="index.php?mod=penunjang_medis&submod=fisiotherapiInput";
                                            else
                                                $page->link="index.php?mod=penunjang_medis&submod=fisiotherapiInput&search=".$_POST['search'];

                                            $page->start=$start;
                                            $page->apage=$apage;
                                            $page->number=$number;
                                            $page->total();
                                            $pagehtml=$page->html;

                                            if ($_POST['search'] == "")
                                                $data = $db->query("select a.no_fisio, a.nomr, a.nama, a.id, a.total_harga_fisio, a.no_daftar from tbl_fisio a where a.status_delete='UD' order by a.id desc", 0);
                                            else
                                                $data = $db->query("select a.no_fisio, a.nomr, a.nama, a.id, a.total_harga_fisio, a.no_daftar from tbl_fisio a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' order by a.id desc", 0);
                                            for ($i = 0; $i < count($data); $i++) {
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
                                                    <td><?php echo $i+1?></td>
                                                    <td><?php echo $data[$i]['no_fisio']?></td>
                                                    <td><?php echo $data[$i]['nomr']?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['total_harga_fisio'])?></div></td>
                                                    <td align="right"><div align="center"><?php echo $status?></div></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($status_tombol == '1') {
                                                            echo '-';
                                                        }
                                                        else {
                                                            ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=penunjang_medis&submod=input_fisio_tindakan&id=<?php echo $data[$i]['id']?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/fis_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                                <span class="ui-icon ui-icon-circle-close"></span>
                                                            </a>
                                                            </a>
 								<a class="btn_no_text btn" style="border-radius: 4px;" title="SOAP" href="index.php?mod=penunjang_medis&submod=fisio_soap&id=<?php echo $data[$i]['nomr'] ?>&ids=<?php echo $data[$i]['no_daftar']; ?>&fisio=<?php echo $data[$i]['id']; ?>">
                                                                <span class="ui-icon ui-icon-plus"></span>
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
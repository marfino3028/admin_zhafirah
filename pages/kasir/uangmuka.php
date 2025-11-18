<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
?>
    <div>
        <div class="breadcrumbs">
            <ul>
                <li>
                    <a href="javascript:void(0)">Uang Muka Pasien</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="javascript:void(0)">Deposit</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-title">
                        <h3>
                            <i class="fa fa-bars"></i>
                            Uang Muka/ Deposit Pasien
                        </h3>
                    </div>
                    <div class="box-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-table"></i>
                                          	Daftar Uang Muka/ Deposit Pasien
                                        </h3>
                                        <a href="index.php?mod=kasir&submod=input_um_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Uang Muka Pasien </a>
                                    </div>
                                    <div class="box-content nopadding" style="overflow-x:auto;">

                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width:20px; text-align: center;">No</th>
                                                <th>Tgl.Transaksi </th>
                                                <th>NO.UM</th>
                                                <th style="width:70px">NOMR</th>
                                                <th>Nama Pasien</th>
                                                <th style="width:100px">Jumlah</th>
                                                <th style="width:50px">Option</th>
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
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_um a", 0);
                                            else
                                                $data_nr = $db->queryItem("select count(a.id) from tbl_um a where a.nama like '%".$_POST['search']."%'", 0);
                                            $nrdata = $data_nr;

                                            if(!isset($number)) $number=$nrdata;
                                            $page=new pages();
                                            if ($_POST['search'] == "")
                                                $page->link="index.php?mod=kasir&submod=uangmuka";
                                            else
                                                $page->link="index.php?mod=kasir&submod=uangmuka&search=".$_POST['search'];

                                            $page->start=$start;
                                            $page->apage=$apage;
                                            $page->number=$number;
                                            $page->total();
                                            $pagehtml=$page->html;
 
                                            if ($_POST['search'] == "")
                                                $data = $db->query("select id, no_um, nomr, nama, tgl_input_um, sum(total_harga_um) total_harga_um, no_daftar from tbl_um group by no_daftar order by id desc", 0);
                                            else
                                                $data = $db->query("select id, no_um, nomr, nama, tgl_input_um, sum(total_harga_um) total_harga_um, no_daftar from tbl_um group by no_daftar where nama like '%".$_POST['search']."%' order by id desc", 0);
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
                                                    <td style="text-align: center;"><?php echo $i+1?></td>
                                                    <td><?php echo $data[$i]['tgl_input_um']?></td>
                                                    <td><?php echo $data[$i]['no_um']?></td>
                                                    <td><?php echo $data[$i]['nomr']?></td>
                                                    <td><?php echo $data[$i]['nama']?></td>
                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['total_harga_um'])?></div></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($status_tombol == '1') {
                                                            echo '-';
                                                        }
                                                        else {
                                                            ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=kasir&submod=input_um_tindakan&id=<?php echo md5($data[$i]['id'])?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
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
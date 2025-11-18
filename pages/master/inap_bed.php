<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Bed di Kamar Inap</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Bed di Kelas / Kamar Inap
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i> Daftar Bedi di Kelas / Kamar Inap
                                    </h3>
                                    <a href="index.php?mod=master&submod=inap_bed_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data </a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Tarif</th>
                                            <th>Nama Ruangan</th>
                                            <th>Nama Bed</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_kelas_ruang", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_kelas_ruang_bed where nama like '%".$_POST['search']."%'", 0);                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=master&submod=inap_bed";
                                        else
                                            $page->link="index.php?mod=master&submod=inap_bed&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from tbl_kelas_ruang_bed order by id", 0);
                                        else
                                            $data = $db->query("select * from tbl_kelas_ruang_bed where nama like '%".$_POST['search']."%' order by id", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $start + $i + 1;
                                          	$kelas = $db->query("select * from tbl_kelas where id='".$data[$i]['kelas_id']."'");
                                          	$ruang = $db->query("select * from tbl_kelas_ruang where id='".$data[$i]['kelas_ruang_id']."'");
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $no?></td>
                                                <td><?php echo $data[$i]['kelas_id']?></td>
                                                <td><?php echo $kelas[0]['nama']?></td>
                                              <td style="text-align: right;"><div style="float: left;">Rp.</div><?php echo number_format($kelas[0]['tarif'])?></td>
                                                <td><?php echo $ruang[0]['nama']?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=inap_bed_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/inap_bed_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
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
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Ruang Inap Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Daftar</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Daftar Ruang Inap Pasien
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
										Daftar Ruang Inap Pasien
                                    </h3>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Jumlah Ruangan</th>
                                            <th>Jumlah Jumlah Bed</th>
                                            <th>Tarif</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $start = $_GET['start'];
                                        $apage = $_GET['apage'];
                                        $number = $_GET['number'];
                                        if(!isset($start)) $start=0;
                                        if(!isset($apage)) $apage=25;

                                        if ($_POST['search'] == "")
                                            $data_nr = $db->query("select count(id) jml from tbl_kelas");
                                        else
                                            $data_nr = $db->query("select count(id) jml from tbl_kelas where nama like '%".$_POST['search']."%'");
                                        $nrdata = $data_nr[0]['jml'];

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=master&submod=ruang_inap";
                                        else
                                            $page->link="index.php?mod=master&submod=ruang_inap&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("SELECT * FROM tbl_kelas order by nama");
                                        else
                                            $data = $db->query("SELECT * FROM tbl_kelas where nama like '%".$_POST['search']."%' order by nama");
                                        for ($i = 0; $i < count($data); $i++) {
                                          $jml_kelas = $db->queryItem("select count(id) from tbl_kelas_ruang where kelas_id='".$data[$i]['id']."'", 0);
                                          $jml_bed = $db->queryItem("select count(id) from tbl_kelas_ruang_bed where kelas_id='".$data[$i]['id']."'", 0);
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kode']?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td style="text-align: center;"><?php echo number_format($jml_kelas)?></td>
                                                <td style="text-align: center;"><?php echo number_format($jml_bed)?></td>
                                              	<td style="text-align: right;"><div style="float: left">Rp.</div><?php echo number_format($data[$i]['tarif'])?></td>
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
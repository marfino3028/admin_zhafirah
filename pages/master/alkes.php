<div class="row">
    <div class="col-sm-12">
         <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
            <div class="box-title">
                <h3>
                    <i class="fa fa-table"></i>
                     <span class="label-primary"> Alat Kesehatan</span>
                </h3>
                <a href="index.php?mod=master&submod=alkes_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Alat Kesehatan</a>
            </div>
            <div class="box-content nopadding" style="overflow-x:auto;">

                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                        <thead>
                        <tr>
                            <th style="width:40px">No</th>
                            <th>Nama Alat Kesahatan</th>
                            <th>Tarif</th>
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
                                $data_nr = $db->queryItem("select count(a.id) from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' order by a.id", 0);
                            else
                                $data_nr = $db->queryItem("select count(id) from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where nama_dokter like '%".$_POST['search']."%' and a.status_delete='UD' and b.status_delete='UD'", 0);
                            $nrdata = $data_nr;

                            if(!isset($number)) $number=$nrdata;
                            $page=new pages();
                            if ($_POST['search'] == "")
                                $page->link="index.php?mod=master&submod=dokter";
                            else
                                $page->link="index.php?mod=master&submod=dokter&search=".$_POST['search'];

                            $page->start=$start;
                            $page->apage=$apage;
                            $page->number=$number;
                            $page->total();
                            $pagehtml=$page->html;

                            if ($_POST['search'] == "")
                                $data = $db->query("select a.*, b.nama_poli from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' order by a.id", 0);
                            else
                                $data = $db->query("select a.*, b.nama_poli from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where nama_dokter like '%".$_POST['search']."%' and status_delete='UD' order by id", 0);
                            //$data = $db->query("select a.*, b.nama_poli from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' order by a.id", 0);
                            for ($i = 0; $i < count($data); $i++) {
                                $no = $start + $i + 1;
                        ?>
                        <tr>
                            <td class="center"><?php echo $no?></td>
                            <td><?php echo $data[$i]['nama_dokter']?></td>
                            <td><?php echo number_format($data[$i]['tarif'])?></td>
                            <td class="text-center">
                                <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=dokter_edit&id=<?php echo $data[$i]['id']?>">
                                    <span class="ui-icon ui-icon-wrench"></span>
                                </a>
                                <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/dokter_delete.php?id=<?php echo $data[$i]['id']?>';">
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
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
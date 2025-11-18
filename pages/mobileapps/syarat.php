<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Travel HD</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Syarat dan Ketentuan Travel HD</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Syarat dan Ketentuan Travel HD
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
                                    <a href="index.php?mod=mobileapps&submod=syarat_new&id=<?php echo $data[$i]['id']?>"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Syarat dan Ketentuan Travel HD</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_syarat where status_delete='UD'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_syarat where content like '%".$_POST['search']."%' s", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=mobileapps&submod=syarat";
                                        else
                                            $page->link="index.php?mod=mobileapps&submod=syarat&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from tbl_syarat where status_delete='UD' order by id", 0);
                                        else
                                            $data = $db->query("select * from tbl_syarat where  status_delete='UD' order by id", 0);

                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['content']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=mobileapps&submod=syarat_edit&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/mobileapps/syarat_delete.php?id=<?php echo $data[$i]['id']?>';">
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
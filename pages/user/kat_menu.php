<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
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
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kategori Menu</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Master Kategori Menu
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Kategori Menu
                                    </h3>
                                    <a href="index.php?mod=user&submod=kat_menu_new&id=<?php echo $data[$i]['id']?>"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Kategori Menu </a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Nama Kategori </th>
                                            <th>Keterangan</th>
                                            <th style="width:70px">Option</th>
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
                                            $data_nr = $db->queryItem("select count(id) from tbl_kat_menu where status_delete='UD'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_kat_menu where nm_ka_menu like '%".$_POST['search']."%' and status_delete='UD'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=user&submod=kat_menu";
                                        else
                                            $page->link="index.php?mod=user&submod=kat_menu&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from tbl_kat_menu where status_delete='UD' order by id", 0);
                                        else
                                            $data = $db->query("select * from tbl_kat_menu where nm_ka_menu like '%".$_POST['search']."%' and status_delete='UD' order by id", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['nm_ka_menu']?></td>
                                                <td><?php echo $data[$i]['ket_kategori']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=user&submod=kat_menu_edit&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/user/kat_menu_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>                                    </a>                                </td>
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
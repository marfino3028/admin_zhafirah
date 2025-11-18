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
                        Data Master Sub Kategori Menu
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Sub Kategori Menu
                                    </h3>
                                    <a href="index.php?mod=user&submod=submenu_kategori_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Sub Kategori Menu </a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori Menu</th>
                                            <th>Nama Sub Kategori Menu</th>
                                            <th>Keterangan</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            	$data = $db->query("select a.id, a.nm_ka_menu, a.ket_kategori, b.nm_ka_menu nama from tbl_kat_sub_menu a left join tbl_kat_menu b on b.id=a.kategori_id where a.status_delete='UD' order by a.kategori_id", 0);
                                        	for ($i = 0; $i < count($data); $i++) {
                                        ?>
                                            <tr>
                                                <td class="center"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td><?php echo $data[$i]['nm_ka_menu']?></td>
                                                <td><?php echo $data[$i]['ket_kategori']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=user&submod=submenu_kategori_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
						    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/user/submenu_kategori_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
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
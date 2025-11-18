<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Master: <b>Menu </b></h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Master Menu </div>
						<div class="button float-right">

							<a href="index.php?mod=user&submod=menu_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Menu </a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                    <h3>
                         <i class="fa fa-table"></i>

                    </h3>

                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                        
                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered"> 
                            <thead> 
                            <tr>
                                <th style="width:40px">No</th> 
                                <th>Nama Menu</th> 
                                <th>Kategori</th> 
                                <th>Link</th>
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
									$data_nr = $db->queryItem("select count(id) from tbl_menu where status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_menu where nama_menu like '%".$_POST['search']."%' and status_delete='UD'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=user&submod=menu";
								else 
									$page->link="index.php?mod=user&submod=menu&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.id, a.nama_menu, a.link, b.nm_ka_menu as kategori, a.kategori_sub_id from tbl_menu a left join tbl_kat_menu b on b.kategori_id=a.kategori_id where a.status_delete='UD' and b.status_delete='UD' order by a.kategori_id, a.id", 0);
								else
									$data = $db->query("select a.id, a.nama_menu, a.link, b.nm_ka_menu as kategori, a.kategori_sub_id from tbl_menu a left join tbl_kat_menu b on b.kategori_id=a.kategori_id where a.nama_menu like '%".$_POST['search']."%' and a.status_delete='UD' and b.status_delete='UD' order by a.kategori_id, a.id", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$submenu = $db->queryItem("select nm_ka_menu from tbl_kat_sub_menu where kategori_id='".$data[$i]['kategori_sub_id']."'", 0);
									if ($submenu != "") $submenu = '/ '.$submenu;
									else $submenu = '';
                            ?>
                            <tr>
                                <td class="center"><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['nama_menu']?></td> 
                                <td><?php echo $data[$i]['kategori'].$submenu?></td> 
                                <td><?php echo $data[$i]['link']?></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=user&submod=menu_edit&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/user/menu_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>                                    </a>                                </td> 
                            </tr> 
                            <?php
                                }
                            ?>
							<tr>
								<td colspan="7">
									<?php echo $pagehtml?>								</td>
							</tr>
                            </tbody>
                        </table>
                    </div>
                </td>
           </tr>
           <tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    
                </div>
                </td>
            </tr>
        </table>
    </div>
    


</form>
</div>
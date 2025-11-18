<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Master:<b> Hubungan Pasien</b></h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Master Pasien.</div>
						<div class="button float-right">

							<a href="index.php?mod=pendaftaran&submod=hubungan_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=master&submod=pasien">
						<input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
					</form>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/master/pasien_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                                <th>Nama</th> 
                                <th>Hubungan</th> 
                                <th>Dari</th> 
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
									$data_nr = $db->queryItem("select count(id) from tbl_hubungan_keluarga where status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_hubungan_keluarga where (nama like '%".$_POST['search']."%' or nomr_nama like '%".$_POST['search']."%') and status_delete='UD'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=pendaftaran&submod=hubungan";
								else 
									$page->link="index.php?mod=pendaftaran&submod=hubungan&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select * from tbl_hubungan_keluarga where status_delete='UD' order by id", 0);
								else
									$data = $db->query("select * from tbl_hubungan_keluarga where (nama like '%".$_POST['search']."%' or nomr_nama like '%".$_POST['search']."%') and status_delete='UD' order by id", 0);
                                for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['nama']?></td> 
                                <td><?php echo $data[$i]['hubungan']?></td> 
                                <td><?php echo $data[$i]['nomr'].' - '.$data[$i]['nomr_nama']?></td>
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=pendaftaran&submod=hubungan_edit&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/pendaftaran/hubungan_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
                                </td> 
                            </tr> 
                            <?php
                                }
                            ?>
							                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <?php echo $pagehtml?>
                                </td>
                            </tr>
                            </tfoot>
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
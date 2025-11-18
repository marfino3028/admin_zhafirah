<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Dokter: Kehadiran Dokter</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Kehadiran Dokter.</div>
						<div class="button float-right">

							<a href="index.php?mod=farmasi&submod=kehadiran_dokter_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Kehadiran Dokter</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=farmasi&submod=kehadiran_dokter">
						<input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
					</form>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/input_resep_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                                <th width="30" style="width:8px">No</th> 
                                <th style="width:120px">Tanggal Input</th> 
                                <th>Dokter</th> 
                                <th width="120">Biaya Kehadiran</th> 
                                <th width="68">Option</th> 
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
									$data_nr = $db->queryItem("select count(a.id) from tbl_kehadiran_dokter a where a.status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(a.id) from tbl_kehadiran_dokter a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=farmasi&submod=kehadiran_dokter";
								else 
									$page->link="index.php?mod=farmasi&submod=kehadiran_dokter&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.* from tbl_kehadiran_dokter a where a.status_delete='UD' order by a.id desc", 0);
								else
									$data = $db->query("select a.* from tbl_kehadiran_dokter a where a.status_delete='UD' and a.nama_dokter like '%".$_POST['search']."%' order by id desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_hadir']))?></td> 
                                <td><?php echo $data[$i]['nama_dokter']?></td> 
                                <td><?php echo number_format($data[$i]['biaya'])?></td>
                                <td class="text-center">
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=kehadiran_dokter_edit&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/kehadiran_dokter_delete.php?id=<?php echo $data[$i]['id']?>';">
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
								<td colspan="4">
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
<script language="javascript">
	function copyResep(id) {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/farmasi/copy_resep.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Resep: Pasien Jamsostek</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Resep Pasien.</div>
						<div class="button float-right">

							<a href="index.php?mod=farmasi&submod=input_resepJams_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Resep Jamsostek</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=farmasi&submod=input_resepJamsostek">
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
                                <th style="width:30px">No</th> 
                                <th style="width:70px">No. Resep</th> 
                                <th style="width:70px">NOMR</th> 
                                <th>Nama Pasien</th> 
                                <th style="width:80px">Total Harga</th> 
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
									$data_nr = $db->queryItem("select count(a.id) from tbl_resepjams a where a.status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(a.id) from tbl_resepjams a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' and status_delete='UD'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=farmasi&submod=input_resepJamsostek";
								else 
									$page->link="index.php?mod=farmasi&submod=input_resepJamsostek&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.no_resep, a.nomr, a.nama, a.id from tbl_resepjams a where a.status_delete='UD'", 0);
								else
									$data = $db->query("select a.no_resep, a.nomr, a.nama, a.id from tbl_resepjams a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' order by id", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$total = $db->queryItem("select sum(total) from  tbl_resepjams_detail where no_resep='".$data[$i]['no_resep']."' and status_delete='UD' group by no_resep");
									$totalRacikan = $db->queryItem("select sum(a.total) from tbl_racikanjams_detail a left join  tbl_racikanjams b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by a.racikanId", 0);
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
									if ($totalRacikan == 0) $embalase = 0;
									$ttl = $total + $totalRacikan + $embalase;
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['no_resep']?></td> 
                                <td><?php echo $data[$i]['nomr']?></td> 
                                <td><?php echo $data[$i]['nama']?></td>
                                <td align="right"><div align="right"><?php echo number_format($ttl)?></div></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=input_resepjams_obat&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_delete.php?id=<?php echo $data[$i]['id']?>';">
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
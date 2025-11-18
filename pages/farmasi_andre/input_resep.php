<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Resep: Pasien</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Resep Pasien.</div>
						<div class="button float-right">

							<a href="index.php?mod=farmasi&submod=input_resep_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Resep</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=farmasi&submod=input_resep">
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
                                <th width="70" style="width:70px">No. Resep</th> 
                                <th width="70" style="width:70px">NOMR</th> 
                                <th width="80">Nama Pasien</th> 
                                <th width="82" style="width:80px">Total Harga</th> 
                                <th width="82" style="width:40px">Status</th> 
                                <th width="68" style="width:50px">Option</th> 
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
									$data_nr = $db->queryItem("select count(a.id) from tbl_resep a where a.status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(a.id) from tbl_resep a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=farmasi&submod=input_resep";
								else 
									$page->link="index.php?mod=farmasi&submod=input_resep&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.no_resep, a.nomr, a.nama, a.id, a.no_daftar from tbl_resep a where a.status_delete='UD' order by a.id desc", 0);
								else
									$data = $db->query("select a.no_resep, a.nomr, a.nama, a.id, a.no_daftar from tbl_resep a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' order by id desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$total = $db->queryItem("select sum(total) from tbl_resep_detail where no_resep='".$data[$i]['no_resep']."' and status_delete='UD' group by no_resep");
									$totalRacikan = $db->queryItem("select sum(a.total) from tbl_racikan_detail a left join  tbl_racikan b on b.id=a.racikanId where b.no_resep='".$data[$i]['no_resep']."' and a.status_delete='UD' and b.status_delete='UD' group by a.racikanId", 0);
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
									if ($totalRacikan == 0) $embalase = 0;
									//menghitung tindakan dan alkes
									$tindakan = $db->queryItem("select sum(tarif) from tbl_tindakan where no_daftar='".$data[$i]['no_daftar']."'");
									$alkes = $db->queryItem("select sum(tarif) from tbl_alkes where no_daftar='".$data[$i]['no_daftar']."'");
									
									$ttl = $total + $totalRacikan + $embalase + $tindakan + $alkes;
									
									$cekKasir = $db->queryItem("select id from tbl_kasir where no_daftar='".$data[$i]['no_daftar']."'");
									if ($cekKasir > 0) {
										$status = 'CLOSED';
										$status_tombol = '1';
									}
									else {
										$status = 'OPEN';
										$status_tombol = '0';
									}
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['no_resep']?></td> 
                                <td><?php echo $data[$i]['nomr']?></td> 
                                <td><?php echo $data[$i]['nama']?></td>
                                <td align="right"><div align="right"><?php echo number_format($ttl)?></div></td> 
                                <td align="right"><div align="center"><?php echo $status?></div></td> 
                                <td class="text-center">
                                    <?php
										if ($status_tombol == '1') {
											echo '&nbsp;';
										}
										else {
									?>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=input_resep_obat&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/resep_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
                                    <?php
										}
									?>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Copy Resep" onclick="copyResep('<?php echo $data[$i]['no_resep']?>')" href="#">
                                        <span class="ui-icon ui-icon-print"></span>
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
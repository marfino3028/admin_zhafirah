<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Master:<b> Obat</b></h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Master Obat.</div>
						<div class="button float-right">

							<a href="index.php?mod=farmasi&submod=obat_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Obat</a>
						</div>
						<div class="button float-right" style="margin-right: 75px;" onclick="ExportExcelObat()">
                            <a href="#"  class="btn btn-sm btn-small btn-success"><span class="fa fa-share"></span>Export Data to Excel &nbsp;</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=farmasi&submod=obat">
						<input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
					</form>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/master/obat_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                                <th>Nama Obat (Kode)</th> 
                                <th>Vendor</th> 
                                <th>Suplier</th> 
                                <th style="width:50px">Beli</th> 
                                <th style="width:50px">Jual</th> 
                                <th style="width:70px">Expired</th> 
                                <th style="width:70px">Option</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$start = $_GET['start'];
								$apage = $_GET['apage'];
								$number = $_GET['number'];
								if(!isset($start)) $start=0;
								if(!isset($apage)) $apage=15;
							
								if ($_POST['search'] == "") 
									$data_nr = $db->queryItem("select count(id) from tbl_obat where status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['search']."%' and status_delete='UD'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=farmasi&submod=obat";
								else 
									$page->link="index.php?mod=farmasi&submod=obat&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' order by id", 0);
								else
									$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['search']."%' and status_delete='UD' order by id", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$bedaB = $db->queryItem("select nilai from tbl_config where kode='EXOBAT'");
									if ($data[$i]['beda'] <= $bedaB) $warna = "#F99B9B";
									else $warna = "";
									$no = $start + $i + 1;
                            ?>
                            <tr bgcolor="<?php echo $warna?>">
                                <td><?php echo $no?></td> 
                                <td><?php echo $data[$i]['nama_obat'].' ['.$data[$i]['kode_obat'].']'?></td> 
                                <td><?php echo $data[$i]['vendor']?></td>
                                <td><?php echo $data[$i]['suplier']?></td>
                                <td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td> 
                                <td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td> 
                                <td style="text-align: right"><?php echo date("d-m-Y", strtotime($data[$i]['expire_date']))?></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=obat_edit&id=<?php echo $data[$i]['id']?>">
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
							<tr>
								<td colspan="8">
									<?php echo $pagehtml?>
								</td>
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

<script language="javascript">
	function ExportExcelObat() {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/farmasi/obat_excell.php';
		popup = window.open(URL,"",windowprops);
	}
</script>
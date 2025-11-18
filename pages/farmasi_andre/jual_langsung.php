<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Penjualan: Obat Farmasi</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Obat Customer.</div>
						<div class="button float-right">

							<a href="index.php?mod=farmasi&submod=input_jual_langsung_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi</a>
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
                                <th width="30" style="text-align: center">No</th> 
                                <th width="120">No. Penjualan</th> 
                                <th>Nama Customer</th> 
                                <th width="120">Total Harga</th> 
                                <th width="100">Status</th> 
                                <th width="100">Option</th> 
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
									$data_nr = $db->queryItem("select count(id) from  tbl_penjualan_obat where status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from  tbl_penjualan_obat where status_delete='UD' and nama like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=farmasi&submod=jual_langsung";
								else 
									$page->link="index.php?mod=farmasi&submod=jual_langsung&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select * from tbl_penjualan_obat where status_delete='UD' order by id desc", 0);
								else
									$data = $db->query("select * from tbl_penjualan_obat where status_delete='UD' and nama like '%".$_POST['search']."%' order by id desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$totalRacikan = $db->queryItem("select sum(total) from tbl_penjualan_obat_detail where jenis='R' and status_delete='UD' and penjualan_id='".$data[$i]['id']."'", 0);
									$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'", 0);
									if ($totalRacikan > 0) $total_jual = $data[$i]['total_harga'] + $totalRacikan + $embalase;
									else  $total_jual = $data[$i]['total_harga'] + $totalRacikan;
									
									if ($data[$i]['status_kwitansi'] == 'CLOSED') $status_tombol = 1;
									else $status_tombol = 0;
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['no_penjualan']?></td> 
                                <td><?php echo $data[$i]['nama'].' ('.$data[$i]['telp'].')'?></td>
                                <td align="right"><div align="right"><?php echo number_format($total_jual)?></div></td> 
                                <td align="right"><div align="right"><?php echo $data[$i]['status_kwitansi']?></div></td> 
                                <td class="text-center">
                                    <?php
										if ($status_tombol == '1') {
											echo '&nbsp;';
										}
										else {
									?>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=input_jual_langsung_obat&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/jual_langsung_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
                                    <?php
										}
									?>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="printResep('<?php echo $data[$i]['no_penjualan']?>')" href="#">
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
	function printResep(id) {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/farmasi/print_resep_langsung.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
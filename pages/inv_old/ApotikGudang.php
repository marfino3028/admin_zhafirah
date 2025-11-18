<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>PERMINTAAN OBAT DARI APOTIK KE GUDANG
</h1>
					<div class="other">
						<div class="float-left">Permintaan Obat dari Apotik ke Gudang.</div>
						<div class="button float-right">
							<a href="index.php?mod=inv&submod=input_ApotikGudang_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Permintaan Obat</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=kasir&submod=inputKasir">
						<input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
					</form>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" colspan="2">
                    <div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
                        
                        <table id="sort-table" class="table table-responsive table-condensed table-hover table-nomargin table-striped dataTable dataTable-noheader dataTable-nofooter">
                            <thead> 
                            <tr>
                                <th style="width:40px">No</th> 
                                <th>No Request</th> 
                                <th style="width:120px">Tanggal Request</th> 
                                <th style="width:100px">Jumlah Pesanan</th> 
                                <th style="width:100px">Option</th> 
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
									$data_nr = $db->queryItem("select count(id) from tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' and no_ro like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=inv&submod=ApotikGudang";
								else 
									$page->link="index.php?mod=inv&submod=ApotikGudang&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select * from  tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' order by tgl_input_ro_gudang desc", 0);
								else
									$data = $db->query("select * from  tbl_ro_to_gudang where input_by='".$_SESSION['rg_user']."' and no_ro like '%".$_POST['search']."%' order by tgl_input_ro_gudang desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$no = $i + 1;
                            ?>
                            <tr>
                                <td><?php echo $no?></td> 
                                <td><?php echo $data[$i]['no_ro_gudang']?></td> 
                                <td class="center"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_ro_gudang']))?></td>
                                <td style="text-align: right;"><?php echo number_format($data[$i]['total_permintaan'])?></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=input_ApotikGudang_detail&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/ro_gudang_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Copy Resep" onclick="copyResep('<?php echo $data[$i]['no_ro_gudang']?>')" href="#">
                                        <span class="ui-icon ui-icon-print"></span>
                                    </a>
								</td> 
                            </tr> 
                            <?php
                                }
                            ?>
							<tr>
								<td colspan="9">
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
	function BayarKasir(id) {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/kasir/print_pembayaran.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
	
	function copyResep(id) {
		var w = 950;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/inv/ro_gudang_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
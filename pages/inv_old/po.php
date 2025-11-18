<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Purchase Order Pusat
</h1>
					<div class="other">
						<div class="float-left">Purchase Order dari pusat ke vendor/supplier.</div>
						<div class="button float-right">
							<a href="index.php?mod=inv&submod=input_po_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Purchase Order</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=kasir&submod=inputKasir">
						<input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search']?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
					</form>
				</div>  
	<form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                                <th>No PO</th> 
                                <th>No Request</th> 
                                <th>Vendor</th> 
                                <th>Suplier</th> 
                                <th style="width:80px">Tanggal PO</th> 
                                <th style="width:60px">Jml RO</th> 
                                <th style="width:60px">Jml PO</th> 
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
									$data_nr = $db->queryItem("select count(id) from tbl_ro where input_by='".$_SESSION['rg_user']."'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_ro where input_by='".$_SESSION['rg_user']."' and no_ro like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=inv&submod=ro";
								else 
									$page->link="index.php?mod=inv&submod=ro&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select b.*, a.no_po, a.total_po, a.nama_vendor, a.nama_suplier from  tbl_po a left join tbl_ro b on b.no_ro=a.no_ro where a.input_by='".$_SESSION['rg_user']."' order by a.tgl_input_po desc", 0);
								else
									$data = $db->query("select b.*, a.no_po, a.total_po, a.nama_vendor, a.nama_suplier from  tbl_po a left join tbl_ro b on b.no_ro=a.no_ro where a.input_by='".$_SESSION['rg_user']."' and a.no_po like '%".$_POST['search']."%' order by a.tgl_input_po desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$no = $i + 1;
                            ?>
                            <tr>
                                <td><?php echo $no?></td> 
                                <td><?php echo $data[$i]['no_po']?></td> 
                                <td><?php echo $data[$i]['no_ro']?></td> 
                                <td><?php echo $data[$i]['nama_vendor']?></td> 
                                <td><?php echo $data[$i]['nama_suplier']?></td> 
                                <td class="center"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_ro']))?></td>
                                <td style="text-align: right;"><?php echo number_format($data[$i]['total_permintaan'])?></td> 
                                <td style="text-align: right;"><?php echo number_format($data[$i]['total_po'])?></td> 
                                <td class="text-center">
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=input_po_detail&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/po_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print PO" onclick="printPO('<?php echo $data[$i]['no_po']?>')" href="#">
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
	function printPO(id) {
		var w = 950;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/inv/po_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
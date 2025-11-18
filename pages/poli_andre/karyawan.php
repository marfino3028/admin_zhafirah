<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Transaksi: Poli Karyawan</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Poli Karyawan.</div>
						<div class="button float-right">

							<a href="index.php?mod=poli&submod=input_karyawan_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Transaksi Poli Karyawan </a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=poli&submod=bedah">
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
                                <th style="width:70px">No. Polkar </th> 
                                <th style="width:70px">NOMR</th> 
                                <th>Nama Karyawan</th> 
                                <th style="width:70px">Status</th> 
                                <th style="width:90px">Total Harga</th> 
                                <th style="width:140px">Option</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$start = $_GET['start'];
								$apage = $_GET['apage'];
								$number = $_GET['number'];
								if(!isset($start)) $start=0;
								if(!isset($apage)) $apage=3;
							
								if ($_POST['search'] == "") 
									$data_nr = $db->queryItem("select count(a.id) from tbl_polkar a where a.status_delete='UD'", 0);
								else 
									$data_nr = $db->queryItem("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar from tbl_polkar a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=poli&submod=karyawan";
								else 
									$page->link="index.php?mod=poli&submod=wicara&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar, a.no_daftar, a.status_bayar from tbl_polkar a where a.status_delete='UD' order by a.id desc", 0);
								else
									$data = $db->query("select a.no_polkar, a.nomr, a.nama, a.id, a.total_harga_polkar, a.no_daftar, a.status_bayar from tbl_polkar a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%' and status_delete='UD' order by a.id desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$no = $start + $i + 1;
									$racikan = $db->queryItem("select sum(total) from tbl_polkar_detail where jenis='R' and status_delete='UD' and no_polkar='".$data[$i]['no_polkar']."'");
									if ($racikan > 0)	$embalase = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
									else $embalase = 0;
									$total = $data[$i]['total_harga_polkar'] + $racikan + $embalase;
                            ?>
                            <tr>
                                <td><?php echo $no?></td> 
                                <td><?php echo $data[$i]['no_polkar']?></td> 
                                <td><?php echo $data[$i]['nomr']?></td> 
                                <td><?php echo $data[$i]['nama']?></td>
                                <td><?php echo $data[$i]['status_bayar']?></td>
                                <td align="right"><div align="right"><?php echo number_format($total)?></div></td> 
                                <td class="text-center">
                                    <?php
										if ($data[$i]['status_bayar'] == 'CASH') {
									?>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="#">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Bayar" href="#">
                                        <span class="ui-icon ui-icon-document"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="printWicara('<?php echo $data[$i]['no_polkar']?>')" href="#">
                                        <span class="ui-icon ui-icon-print"></span>
                                    </a>
									<?php
										}
										else {
									?>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=poli&submod=input_polkar_tindakan&id=<?php echo $data[$i]['id']?>">
                                        <span class="ui-icon ui-icon-wrench"></span>
                                    </a>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/karyawan_delete.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Input Pembayaran" href="index.php?mod=poli&submod=bayar_polkar&id=<?php echo $data[$i]['id'].'&total='.$total?>">
                                        <span class="ui-icon ui-icon-document"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Kwitansi" onclick="printWicara('<?php echo $data[$i]['no_polkar']?>')" href="#">
                                        <span class="ui-icon ui-icon-print"></span>
                                    </a>
									<?php
										}
									?>
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
	function printWicara(id) {
		var w = 650;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/poli/polkar_print.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
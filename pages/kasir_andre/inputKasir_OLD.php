<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Pembayaran: Pasien</h1>
					<div class="other">
						<div class="float-left">Pembayaran Kasir.</div>
						<div class="button float-right">
							<a href="index.php?mod=kasir&submod=input_kasir_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pembayaran</a>
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
                                <th style="width:70px">NOMR</th> 
                                <th>Nama Pasien</th> 
                                <th>Nama Perusahaan</th> 
                                <th style="width:70px">Poli</th> 
                                <th style="width:80px">Pasien</th> 
                                <th style="width:80px">Asuransi</th> 
                                <th style="width:80px">Total</th> 
                                <th style="width:70px">Option</th> 
                            </tr> 
                            </thead> 
                            <tbody> 
                            <?php
								$start = $_GET['start'];
								$apage = $_GET['apage'];
								$number = $_GET['number'];
								if(!isset($start)) $start=0;
								if(!isset($apage)) $apage=10;
							
								if ($_POST['search'] == "") 
									$data_nr = $db->queryItem("select count(id) from tbl_kasir where user_insert='".$_SESSION['rg_user']."'", 0);
								else 
									$data_nr = $db->queryItem("select count(id) from tbl_kasir where user_insert='".$_SESSION['rg_user']."' and nama like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=kasir&submod=inputKasir";
								else 
									$page->link="index.php?mod=kasir&submod=inputKasir&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select * from  tbl_kasir where user_insert='".$_SESSION['rg_user']."' order by tgl_insert desc", 0);
								else
									$data = $db->query("select * from  tbl_kasir where user_insert='".$_SESSION['rg_user']."' and nama like '%".$_POST['search']."%' order by tgl_insert desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$tst = explode("-", $data[$i]['no_daftar']);
									if ($tst[0] == 'JAM') {
										$poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran_jamsostek a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$tst[1]."'");
									}
									else {
										$poli = $db->queryItem("select b.nama_poli from tbl_pendaftaran a left join tbl_poli b on b.kd_poli=a.kd_poli where a.no_daftar='".$data[$i]['no_daftar']."'");
									}
									$biaya = $db->query("select payment_to, sum(bayar) as total from tbl_kasir_detail where no_kwitansi='".$data[$i]['no_kwitansi']."' group by payment_to order by payment_to", 0);
									$no = $start + $i + 1;
									
									if ($data[$i]['nama'] == "") {
										$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$data[$i]['nomr'] = $db->queryItem("select nomr from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$poli = $db->queryItem("select kd_poli from tbl_pendaftaran where no_daftar='".$data[$i]['no_daftar']."'");
										$data[$i]['nama'] = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$data[$i]['nomr']."'");
									}
                            ?>
                            <tr>
                                <td><?php echo $no?></td> 
                                <td><?php echo $data[$i]['nomr']?></td> 
                                <td><?php echo $data[$i]['nama']?></td>
                                <td><?php echo $data[$i]['nama_perusahaan']?></td>
                                <td><?php echo $poli?></td>
                                <td style="text-align: right;"><?php echo number_format($biaya[1]['total'])?></td> 
                                <td style="text-align: right;"><?php echo number_format($biaya[0]['total'])?></td> 
                                <td style="text-align: right;"><?php echo number_format($biaya[2]['total'])?></td> 
                                <td class="text-center">
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Pembayaran Pasien" onclick="BayarKasir('<?php echo $data[$i]['no_kwitansi']?>')" href="#">
                                        <span class="ui-icon ui-icon-print"></span>
                                    </a>
									<a class="btn_no_text btn" style="border-radius: 4px;" title="Print Pembayaran Asuransi" onclick="BayarKasirAsuransi('<?php echo $data[$i]['no_kwitansi']?>')" href="#">
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
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/kasir/print_pembayaran.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}

	function BayarKasirAsuransi(id) {
		var w = 1100;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/kasir/print_pembayaran_asuransi.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
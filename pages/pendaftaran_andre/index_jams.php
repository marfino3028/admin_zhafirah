<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

<div class="page-title ui-widget-content ui-corner-all">
					<h1>Data Pendaftaran: Pasien Jamsostek</h1>
					<div class="other">
						<div class="float-left">Insert, Update, Delete Data Pendaftaran Pasien Jamsostek.</div>
						<div class="button float-right">

							<a href="index.php?mod=pendaftaran&submod=daftarJams" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Pendaftaran</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<form method="post" action="index.php?mod=pendaftaran&submod=index_jams">
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
                                <th>Dokter</th> 
                                <th style="width:70px">Poli</th> 
                                <th style="width:70px">Biaya Dokter</th> 
                                <th style="width:70px">Status</th> 
                                <th style="width:40px">Option</th> 
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
									$data_nr = $db->queryItem("select count(a.id) from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD' order by tgl_daftar desc", 0);
								else 
									$data_nr = $db->queryItem("select count(a.id) from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD' and b.nm_pasien like '%".$_POST['search']."%'", 0);
								$nrdata = $data_nr;
						
								if(!isset($number)) $number=$nrdata;
								$page=new pages();
								if ($_POST['search'] == "")
									$page->link="index.php?mod=pendaftaran&submod=index_jams";
								else 
									$page->link="index.php?mod=pendaftaran&submod=index_jams&search=".$_POST['search'];
									
								$page->start=$start;
								$page->apage=$apage;
								$page->number=$number;
								$page->total();
								$pagehtml=$page->html;

                                if ($_POST['search'] == "") 
									$data = $db->query("select a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, b.nm_pasien as nama, c.nama_poli, c.tarif, a.biayaAdmin from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD' order by tgl_daftar desc", 0);
								else
									$data = $db->query("select a.nomr, a.kode_dokter, a.id, a.status_pasien, a.nama_perusahaan, b.nm_pasien as nama, c.nama_poli, c.tarif, a.biayaAdmin from tbl_pendaftaran_jamsostek a left join tbl_pasien_jamsostek b on b.id=a.idNomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD' and b.nm_pasien like '%".$_POST['search']."%' order by tgl_daftar desc", 0);
                                for ($i = 0; $i < count($data); $i++) {
									$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
									$tarif = $db->queryItem("select tarif_jamsostek from tbl_dokter where kode_dokter='".$data[$i]['kode_dokter']."'");
                            ?>
                            <tr>
                                <td><?php echo $i+1?></td> 
                                <td><?php echo $data[$i]['nomr']?></td> 
                                <td><?php echo $data[$i]['nama']?></td>
                                <td><?php echo $data[$i]['nama_perusahaan']?></td>
                                <td><?php echo $dokter?></td>
                                <td><?php echo $data[$i]['nama_poli']?></td>
                                <td><?php echo number_format($tarif)?></td>
                                <td><?php echo $data[$i]['status_pasien']?></td> 
                                <td class="text-center">
                                	<?php
										if ($data[$i]['status_pasien'] == 'OPEN') {
									?>
                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Pembatalan Pendaftaran Pasien" href="#" onclick="return window.location = 'pages/pendaftaran/daftar_batal.php?id=<?php echo $data[$i]['id']?>';">
                                        <span class="ui-icon ui-icon-circle-close"></span>
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
								<td colspan="10">
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
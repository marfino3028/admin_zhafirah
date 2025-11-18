<?php
	ini_set("display_errors", 0);
    $daftar =  $db->query("select no_daftar, nomr from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'", 0);
    $pasien =  $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'", 0);
	$data = $db->query("select * from tbl_travel where md5(no_daftar)='".$_GET['id']."'");
	if ($data[0]['id'] < 1) {
    	$ceknmr = $db->queryItem("select max(right(no_travel, 3)*1) from tbl_travel where left(right(no_travel, 11), 8)='".date("dmY")."'", 0);
    	$ceknmr = $ceknmr + 1;
    	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
    	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
    	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
    	$nomr = 'TRV-'.date("dmY").$ceknmr;
    	//$nama = $db->queryItem("select nm_pasien from tbl_pasien where nomr='".$_GET['id01']."'", 0);
		$insert = $db->query("insert into  tbl_travel (no_travel, nomr, nama, no_daftar) values ('".$nomr."', '".$daftar[0]['nomr']."', '".$pasien[0]['nm_pasien']."', '".$daftar[0]['no_daftar']."')", 0);
		//echo '<br><br>ini hanya test<br><br>';
		$id = $db->queryItem("select id from tbl_travel order by id desc", 0);
		//echo $id;
		//$_GET['id'] = $id;
		$data = $db->query("select * from tbl_travel where id='".$id."'");
    }
    else {
        $id = $data[0]['id'];
    }
	$dataSrc = $db->query("select * from tbl_travel where id='".$id."'");
	$dataTdk = $db->query("select no_daftar, nomr from tbl_travel where id='".$id."'", 0);
	//$_GET['id'] = $data[0]['id'];
?>
<script language="javascript">

	function pilihBHP(id) {
		var url = "pages/hd/medication_bhp.php";
		var data = {id:id};
		
		$('#data_pasien').load(url,data, function(){
			$('#data_pasien').fadeIn('fast');
		});
	}
	
</script>
<!---- JS SELECT2 --->
<script language="javascript">
	$(document).ready(function() {
		$("#obat").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/obat.php",
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 50,
		        data: function (term) {
		            return {
		                term: term
		            };
		        },
		        results: function (data) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        text: item.itemName,
		                        id: item.id
		                    }
		                })
		            };
		        }, 
		    }
		});
	});

</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Layanan Hemodialisa</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Travel HD</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Input Trave HD</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Travel HD Pasien</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Detail Travel HD Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/hd/travel_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Travel HD</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_travel']?>
                                                        <input type="hidden" id="no_resep" name="no_resep" class="form-control"  value="<?php echo $data[0]['no_travel']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nomr']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nama']?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Provider Group AIM</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="klinik_provider" name="klinik_provider" required="required">
                                                            <option value="">--Pilih Provider Group AIM--</option>
                                        					<?php
                                        					    $sub = $db->query("select kode_perusahaan, nama_perusahaan from tbl_perusahaan where group_aim= 'YA';");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kode_perusahaan'].'">'.$sub[$i]['nama_perusahaan'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Keberangkatan</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="tgl_lahirs" name="tgl_lahir" value="<?php echo date("Y-m-d")?>" class="form-control" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Dokter Perujuk</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="dokter_perujuk" name="dokter_perujuk" required="required">
                                                            <option value="">--Pilih Dokter Perujuk--</option>
                                        					<?php
                                        					    $sub = $db->query("select kode_dokter, nama_dokter from tbl_dokter where status_delete='UD' ");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['kode_dokter'].'">'.$sub[$i]['nama_dokter'].'</option>';
                                        					    }
                                        					?>
							</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal HD</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" id="mulais" name="mulai" value="<?php echo date("Y-m-d")?>" class="form-control" required="required" />
                                                    </div>
                                                </div>
                        				<div class="form-group">
                        					<label for="textfield" class="control-label col-sm-4" style="text-align: left;">Upload Catatan HD</label>
                        					<div class="col-sm-8">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-file btn-success">
                                                        <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                    <span class="fileinput-exists">Ganti</span>
                                                    <input type="file" name="dokumen" accept="image/*">
                                                    </span>
                                                    <span class="fileinput-filename"></span>
                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                        					</div>
                        				</div>
                                                <div class="form-actions">
                                                    <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Travel HD" />
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-success rounded" value="List/Daftar Layanan HD" onclick="simpanData(this.form, 'index.php?mod=hd&submod=hd')" />
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="col-sm-7">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th style="text-align: center;">Klinik Tujuan Travel HD</th>
                                                            <th style="text-align: center;">Tanggal Keberangkatan</th>
                                                            <th style="text-align: center;">Tanggal HD</th>
                                                            <th style="text-align: center;">Dokter Perujuk</th>
                                                            <th style="text-align: center;">Dokuen</th>
                                                            <th style="width:30px; text-align: center;">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from tbl_travel_detail where status_delete='UD' and travel_id='".$dataSrc[0]['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['klinik_provider']?></td>
                                                                <td><?php echo date("d-M-Y", strtotime($data[$i]['tgl_berangkat']))?></td>
                                                                <td><?php echo date("d-M-Y", strtotime($data[$i]['tgl_hd']))?></td>
                                                                <td><?php echo $data[$i]['dokter_nama']?></td>
                                                                <td style="text-align: center">
																	<?php 
																		echo '<a href="dokumen/'.$data[$i]['dokumen'].'" target="_blank"><i class="glyphicon-log_book"></i></a>';
																		//echo '<a href="index.php" target="_blank"><i class="glyphicon-file"></i></a>';
																	?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/hd/travel_detail_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $sbttl = $sbttl + $data[$i]['total'];
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
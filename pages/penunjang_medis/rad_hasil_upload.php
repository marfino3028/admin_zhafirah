<?php

	$data = $db->query("select * from tbl_rad where md5(id)='".$_GET['id']."'");
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
	
	function TampilHarga(kode) {
		document.getElementById('TarifTindakan').innerHTML = 'Tunggu....';
		var url = "pages/penunjang_medis/info_Tarif.php";
		var data = {kode:kode};
		$('#TarifTindakan').load(url,data, function(){
			$('#TarifTindakan').fadeIn('fast');
		});
	
	}
	
	function simpanTindakanRad() {
		var id = document.getElementById('idRad').value;
		var no_rad = document.getElementById('no_rad').value;
		var nomr = document.getElementById('nomr').value;
		var nama = document.getElementById('nama_pasien').value;
		var rad = document.getElementById('rad').value;
		var tarif = document.getElementById('tarifNo').value;
		var qty = document.getElementById('qty').value;
		var analisis = document.getElementById('analisis').value;
		var url = "pages/penunjang_medis/simpanRadTindakan.php";
		var data = {id:id, no_rad:no_rad, nomr:nomr, nama:nama, rad:rad, tarif:tarif, qty:qty, analisis: analisis};
		
		if (tarif > 0) {
			document.getElementById('data_pasien').innerHTML = 'Tunggu....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
		else {
			alert("Silahkan Pilih Tindakan Radiologi terlebih dahulu-" + tarif);
		}
	}
	
</script>
<script language="javascript">
	$(document).ready(function() {
		$("#lab").select2({
		    minimumInputLength: 1,
		    ajax: {
				url : "pages/functions/laboratorium.php",
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
                <a href="javascript:void(0)">Penunjang Medis</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Radiologi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Upload</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Hasil Radiologi</a>
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
                                        <i class="fa fa-edit"></i> Upload Hasil Radiologi
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/penunjang_medis/rad_hasil_upload_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Rad </label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_rad']?>
                                                        <input type="hidden" id="no_lab" name="no_rad" value="<?php echo $data[0]['no_rad']?>" />
                                                        <input type="hidden" id="idRad" name="idRad" value="<?php echo $data[0]['id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nomr']?>
                                                        <input type="hidden" id="nomr" name="nomr" value="<?php echo $data[0]['nomr']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nama Pasien</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['nama']?>
                                                        <input type="hidden" id="nama_pasien" name="nama_pasien" value="<?php echo $data[0]['nama']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d F Y", strtotime($data[0]['tgl_insert']))?>
                                                    </div>
                                                </div>
						<div class="form-group">
						      <label for="textfield" class="control-label col-sm-4" style="text-align: left;">Upload Dokumen</label>
                				      <div class="col-sm-8">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn btn-default btn-file btn-success">
                                                                <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                            <span class="fileinput-exists">Ganti</span>
                                                            <input type="file" name="dokumen" id="dokumen" accept="image/*" required="required" onchange="changeimage()">
                                                            </span>
                                                            <span class="fileinput-filename"></span>
                                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                        </div>
                                		     </div>
                                		</div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Ekspertise</label>
                                                    <div class="col-sm-8">
							<?php
								$expert = $db->query("select keterangan from tbl_rad_dokumen where status_delete='UD' and no_rad='".$data[0]['no_rad']."'", 0);
							?>
                                                        <textarea tabindex="2" rows="10" class="form-control" id="keterangan" name="keterangan"><?php echo $expert[0]['keterangan']?></textarea>
                                                    </div>
                                                </div>
                                                <div id="DataAdd">
                                                    <div class="form-actions">
                                                        <input type="submit" value="Simpan Dokumen" class="btn btn-sm btn-small btn-primary rounded" />
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Radiologi" onclick="simpanData(this.form, 'index.php?mod=penunjang_medis&submod=radiologiInput')" />
                                                    </div>
                                                </div>
                                            </div><P></P>
                                            <div class="col-sm-7">
						    <img id="previewGambar" src="" alt="Preview akan muncul di sini" style="max-width: 100%; display: none;"/>
                                                    <div id="data_pasien">
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Ekspertise</th>
                                                                <th>Dokumen</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
							    $no = 1;
                                                            $data = $db->query("select * from tbl_rad_dokumen where status_delete='UD' and no_rad='".$data[0]['no_rad']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
								if ($i > 0) {
									$data[$i]['keterangan'] = "";
									$no = "";
								}
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $no?></td>
                                                                    <td><?php echo nl2br($data[$i]['keterangan']);?></td>
                                                                    <td width="200">
									<?php 
										echo '<img src="dokumen/'.$data[$i]['dokumen'].'" style="max-width: 200px;">';
									?>
								    </td>
                                                                    <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/rad_hasilUploaddelete.php?id=<?php echo md5($data[$i]['id']).'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                                                                </tr>
                                                                <?php
                                                                $sbttl = $sbttl + $data[$i]['tarif'];
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
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

<script>
document.getElementById('dokumen').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file && file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const imgPreview = document.getElementById('previewGambar');
      imgPreview.src = e.target.result;
      imgPreview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
});
</script>
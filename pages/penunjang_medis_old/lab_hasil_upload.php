<?php

	$data = $db->query("select * from tbl_lab where md5(id)='".$_GET['id']."'");
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
	
	function simpanTindakanLab() {
		var id = document.getElementById('idLab').value;
		var no_lab = document.getElementById('no_lab').value;
		var nomr = document.getElementById('nomr').value;
		var nama = document.getElementById('nama_pasien').value;
		var lab = document.getElementById('lab').value;
		var tarif = document.getElementById('tarifNo').value;
		var qty = document.getElementById('qty').value;
		var analisis = document.getElementById('analisis').value;
		var url = "pages/penunjang_medis/simpanLabTindakan.php";
		var data = {id:id, no_lab:no_lab, nomr:nomr, nama:nama, lab:lab, tarif:tarif, qty:qty, analisis: analisis};
		
		if (tarif > 0) {
			document.getElementById('data_pasien').innerHTML = 'Tunggu....';
			$('#data_pasien').load(url,data, function(){
				$('#data_pasien').fadeIn('fast');
			});
		}
		else {
			alert("Silahkan Pilih Tindakan Laboratorium terlebih dahulu-" + tarif);
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
                <a href="javascript:void(0)">Labolatorium</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Tindakan</a>
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
                                        <i class="fa fa-edit"></i> Input Tindakan Lab
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/penunjang_medis/lab_hasil_upload_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Lab </label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_lab']?>
                                                        <input type="hidden" id="no_lab" name="no_lab" value="<?php echo $data[0]['no_lab']?>" />
                                                        <input type="hidden" id="idLab" name="idLab" value="<?php echo $data[0]['id']?>" />
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
                                                    <label for="textfield" class="control-label col-sm-4">Keterangan</label>
                                                    <div class="col-sm-8">
                                                        <textarea tabindex="2" rows="3" class="form-control" id="keterangan" name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                				<div class="form-group">
                                					<label for="textfield" class="control-label col-sm-4" style="text-align: left;">Upload Dokumen</label>
                                					<div class="col-sm-8">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <span class="btn btn-default btn-file btn-success">
                                                                <span class="fileinput-new">&nbsp;Pilih/Ambil file&nbsp;</span>
                                                            <span class="fileinput-exists">Ganti</span>
                                                            <input type="file" name="dokumen" accept="application/pdf" required="required">
                                                            </span>
                                                            <span class="fileinput-filename"></span>
                                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                        </div>
                                					</div>
                                				</div>
                                                <div id="DataAdd">
                                                    <div class="form-actions">
                                                        <input type="submit" value="Simpan Dokumen" class="btn btn-sm btn-small btn-primary rounded" />
                                                        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List Laboratorium" onclick="simpanData(this.form, 'index.php?mod=penunjang_medis&submod=labInput')" />
                                                    </div>
                                                </div>
                                            </div><P></P>
                                            <div class="col-sm-7">
                                                    <div id="data_pasien">
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Keterangan</th>
                                                                <th>Dokumen</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_lab_dokumen where status_delete='UD' and no_lab='".$data[0]['no_lab']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['keterangan'];?></td>
                                                                    <td><?php echo '<a href="dokumen/'.$data[$i]['dokumen'].'">'.$data[$i]['dokumen'].'</a>'?></td>
                                                                    <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/penunjang_medis/lab_hasilUploaddelete.php?id=<?php echo md5($data[$i]['id']).'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
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
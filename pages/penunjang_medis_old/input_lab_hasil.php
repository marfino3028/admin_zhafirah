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
		var url = "pages/penunjang_medis/simpanLabTindakan.php";
		var data = {id:id, no_lab:no_lab, nomr:nomr, nama:nama, lab:lab, tarif:tarif, qty:qty};
		
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
                                        <i class="fa fa-edit"></i> Input Hasil Tindakan Lab
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/penunjang_medis/hasil_lab_insertUpdate.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-12">
                                                    <div id="data_pasien" style="margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">
                                                        <p style="margin-left: 10px; font-size: 20px;">
                                                        	Formulir Input Hasil Lab  
                                                      	</p>
                                                      	<table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Description</th>
                                                                <th>Nilai Normal</th>
                                                                <th>Satuan</th>
                                                                <th>Hasil Lab</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $data = $db->query("select * from tbl_lab_detail where status_delete='UD' and no_lab='".$data[0]['no_lab']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='".$data[$i]['kode_tarif']."'");
                                                                $sat = $db->query("select a.normal, a.satuan from tbl_tarif a where a.kode_tarif='".$data[$i]['kode_tarif']."'", 0);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['nama_tindakan'].' - '.$kategori?></td>
                                                                    <td><?php echo $sat[0]['normal']?></td>
                                                                    <td><?php echo $sat[0]['satuan']?></td>
                                                                    <td>
                                                                  		<input type="hidden" name="normal<?php echo $data[$i]['id']?>" value="<?php echo $sat[0]['normal']?>" />
                                                                  		<input type="hidden" name="satuan<?php echo $data[$i]['id']?>" value="<?php echo $sat[0]['satuan']?>" />
                                                                  		<input type="text" id="hasil<?php echo $data[$i]['id']?>" name="hasil<?php echo $data[$i]['id']?>" class="form-control" value="<?php echo $data[$i]['hasil']?>" required="required" />
                                                                  	</td>
                                                                </tr>
                                                                <?php
                                                                $sbttl = $sbttl + $data[$i]['tarif'];
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                      <p style="margin-top: 15px;">
                                                        <input type="hidden" name="no_lab" value="<?php echo md5($data[0]['no_lab'])?>">
                                                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-normal btn-primary rounded" value="Simpan Hasil Lab" />
                                                      </p>
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
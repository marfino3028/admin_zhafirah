<?php
	$um_no = $db->query("select * from tbl_um where md5(id)='".$_GET['id']."'", 0);
	$um_data = $db->query("select * from tbl_um where md5(id)='".$_GET['id']."'", 0);
?>
<script language="javascript">
	function CariPasien(id) {
      	//alert(id);
		var url = "pages/pendaftaran/view_pasien.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
  
  	function pilih_hubungan(id) {}
  
  	function TotalAllBayar() {
		var url = "pages/kasir/metode_bayar.php";
		var metode = document.getElementById('metode').value;
		var data = {metode:metode};

		if (metode == "") {
			document.getElementById('totalAll').innerHTML = '';
		}
		else {
			document.getElementById('totalAll').innerHTML = 'Tunggu sebentar ....';
			$('#totalAll').load(url,data, function(){
				$('#totalAll').fadeIn('fast');
			});
		}
    }
  
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Uang Muka</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-bordered box-color">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Input Uang Muka Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/kasir/um_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. Uang Muka</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_daftar_view" name="no_daftar_view" class="form-control" value="<?php echo $um_no[0]['no_um']?>" disabled/>
                                                        <input type="hidden" name="no_daftar" value="<?php echo $um_no[0]['no_um']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <input type="hidden" name="nodaftar" value="<?php echo $um_no[0]['no_daftar']?>" />
                                                        <input type="hidden" name="nomr" value="<?php echo $um_no[0]['nomr']?>" />
                                                        <input type="text" id="no_daftarss" name="no_daftarss" class="form-control" value="<?php echo $um_no[0]['nomr'].' - '.$um_no[0]['nama']?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor MR</label>
                                                    <div class="col-sm-8">
                                                        <select id="metode" name="metode" size="1" onchange="TotalAllBayar()" class="form-control" required="required">
                                                            <option value="">--Metode Bayar--</option>
                                                            <option value="CASH">Cash</option>
                                                            <option value="ASS">Asuransi Perusahaan</option>
                                                            <option value="CC">Kartu Kredit</option>
                                                            <option value="DEBIT">Debit</option>
                                                        </select>
                                                    </div>
                                                  	<div id="totalAll"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nilai Uang Muka</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="nilai" name="nilai" class="form-control" required="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Uang Muka" />
                                                    <input type="button" name="daftar" id="daftar" class="btn btn-sm btn-small btn-primary rounded" value="Daftar Uang Muka" onclick="return window.location = 'index.php?mod=kasir&submod=uangmuka'" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative; margin-top: 10px; margin-left: 10px; margin-right: 10px; margin-bottom: 10px;"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div id="data_pasien">
                                                  <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                                      <thead>
                                                      <tr>
                                                          <th width="30" style="width:8px">No</th>
                                                          <th>Tanggal Bayar</th>
                                                          <th>Metode Bayar</th>
                                                          <th>Nominal</th>
                                                          <th>Option</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php
                                                      
                                                          $data = $db->query("select * from tbl_um where no_um='".$um_no[0]['no_um']."'", 0);
                                                          for ($i = 0; $i < count($data); $i++) {
                                                              ?>
                                                              <tr>
                                                                  <td><?php echo $i+1?></td>
                                                                  <td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_um']))?></td>
                                                                  <td><?php echo $data[$i]['metode']?></td>
                                                                  <td><?php echo number_format($data[$i]['total_harga_um'])?></td>
                                                                  <td class="text-center" style="text-align: center;">
                                                                      <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/kasir/uangmuka_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
                                                                          <span class="ui-icon ui-icon-circle-close"></span>
                                                                      </a>
                                                                  </td>
                                                              </tr>
                                                              <?php
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

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Data Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Scan Konfirmasi Pengambilan Hasil Rad
                </h3>
              </div>
              <div class="box-content">
        <form action="pages/qrcode/rad_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                    <div class="form-group">
                        <div class="col-sm-4">&nbsp;</div>
                        <div class="col-sm-3">
                            <label for="textfield" class="control-label">Scan QRCode</label>
                            <input type="text" id="no_wa" name="no_wa" placeholder="Scan/Ketik Kode" class="form-control" />
                        </div>
                    	<div class="form-actions col-sm-1" style="margin-top: 40px;">
                        	<input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="submit" />
                        </div>
                    </div>
            </div>
        </form>
              </div>
            </div>
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Hasil Scan QRCode
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th style="width:40px">No</th>
                      <th>No. WhatsApp Pasien</th>
                      <th>Waktu Ambil Antrian</th>
                      <th>Waktu Kedatangan ke Poli</th>
                      <th>Waktu Konfirmasi Pengambilan Hasil Lab</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $today = date("Y-m-d");
			$data = $db->query("select * from tbl_kiosk_rad order by id desc", 0);
	                  for ($i = 0; $i < count($data); $i++) {
				$sub = $db->query("select * from tbl_kiosk_antrian where id='".$data[$i]['antrian_id']."'");
				$sub1 = $db->query("select * from tbl_kiosk_antrian where no_wa='".$data[$i]['no_wa']."' and kode not in ('R', 'SL', 'SR')");
                    ?>
                    <tr>
                        <td><?php echo $i+1?></td>
                        <td><?php echo $data[$i]['no_wa']?></td>
                        <td><?php echo date("d F Y H:i:s", strtotime($sub1[0]['tgl_insert']))?></td>
                        <td><?php echo date("d F Y H:i:s", strtotime($sub[0]['tgl_insert']))?></td>
                        <td><?php echo date("d F Y H:i:s", strtotime($data[$i]['tgl_insert']))?></td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>                
            </div>
        </div>
        </div>
    </div>
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <?php
	    	$pasien = $db->query("select * from tbl_pasien where md5(nomr)='".$_GET['id']."'");
	    	$daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where nomr='".$_GET['id']."'");
	    	$daftarN = $db->query("select no_daftar from tbl_pendaftaran where md5(no_daftar)='".$_GET['ids']."'");
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Profile Pasien Layanan Hemodialisa
                </h3>
                <a href="index.php?mod=hd&submod=worklist&id=<?php echo $pasien[0]['nomr'].'&ids='.$daftarN[0]['no_daftar']?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right">Kembali ke Catatan HD</a>
                <a href="index.php?mod=hd&submod=worklist_phr_new&id=<?php echo $_GET['id'].'&ids='.$_GET['ids']?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Upload PHR</a>
              </div>
              <div class="box-content">
                <blockquote>
                  <p>
                    <?php echo $pasien[0]['nomr'].' - '.$pasien[0]['nm_pasien']?>
                  </p>
                  <small>Jenis Kelamin : <?php echo $pasien[0]['jk']?></small>
                  <small>Alamat / Asal : <?php echo $pasien[0]['alamat_pasien']?></small>
                  <small>Berobat ditempat ini sebanyak : <?php echo $daftarnr?> Kali</small>
                </blockquote>
              </div>
            </div>
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Daftar Dokumen PHR Pasien
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                      <th>Tgl Pemeriksaan</th>
                      <th>Dokter</th>
                      <th>Dokumen</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $data = $db->query("select * from tbl_hd_phr where md5(nomr)='".$_GET['id']."' and md5(no_daftar)='".$_GET['ids']."'");
	                  for ($i = 0; $i < count($data); $i++) {
                    ?>
                    <tr>
                      <td>
                        <?php echo date("d-F-Y", strtotime($data[$i]['tanggal']))?>
                      </td>
                      <td>
                        <?php echo $data[$i]['nama_dokter']?>
                      </td>
                      <td>
                        [<a href="dokumen/<?php echo $data[$i]['dokumen']?>" target="_blank">klik disini</a>]
                      </td>
                      <td>
                         <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/hd/worklist_hd_phr_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
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
    </div>
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
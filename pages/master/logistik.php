<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Data Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Logistik</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Pencarian Logistik
                </h3>
                <a href="index.php?mod=master&submod=logistik_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Logistik Baru</a>
              </div>
              <div class="box-content">
        <form action="index.php?mod=master&submod=logistik" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3">&nbsp;</div>
                        <div class="col-sm-5">
                            <label for="textfield" class="control-label">Nama</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama Logistik/Barang" class="form-control" value="<?php echo $_POST['nama']?>" />
                        </div>
                    	<div class="form-actions col-sm-1" style="margin-top: 40px;">
                        	<input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Cari..." />
                        </div>
                    </div>
            </div>
        </form>
              </div>
            </div>
            <div class="box">
              <div class="box-title">
                <h3 style="padding-right: 50px;">
                  <i class="fa fa-table"></i> Hasil Pencarian Logistik
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                         <th style="width:40px">No</th>
                         <th>Kode</th>
                         <th>Nama</th>
                         <th>Kategori</th>
                         <th>HNA</th>
                         <th>PPN</th>
                         <th>HNA + PPN</th>
                         <th style="width:70px">Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $today = date("Y-m-d");
			if ($_POST['nama'] != "") {
                 		$data = $db->query("select * from tbl_logistik where nama like '%".$_POST['nama']."%' order by id", 0);
			}

	                  for ($i = 0; $i < count($data); $i++) {
				$no = $no + 1;
                                            ?>
                                            <tr bgcolor="<?php echo $warna?>">
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['kode']?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td><?php echo $data[$i]['kategori_nama']?></td>
                                                <td style="text-align: right"><?php echo number_format($data[$i]['hna'])?></td>
                                                <td style="text-align: right"><?php echo number_format($data[$i]['ppn']).'%'?></td>
                                                <td style="text-align: right"><?php echo number_format($data[$i]['hna_ppn'])?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=logistik_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/logistik_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Tambah Satuan" href="index.php?mod=master&submod=logistik_satuan&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-plus"></span>
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
</div>

    <script>
        $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
    </script>
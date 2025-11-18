<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Data Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
              <div class="box-title">
                <h3>
                  <i class="fa fa-user"></i>
                  Pencarian Obat
                </h3>
                <a href="index.php?mod=farmasi&submod=obat_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Obat Baru</a>
                <a href="#"  class="btn btn-sm btn-small btn-darkblue pull-right" onclick="ExportExcelObat()"><span class="fa fa-share"></span>Export Data to Excel &nbsp;</a>
              </div>
              <div class="box-content">
        <form action="index.php?mod=farmasi&submod=obat" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
            <div class="row">
                    <div class="form-group">
                        <div class="col-sm-1">&nbsp;</div>
                        <div class="col-sm-3">
                            <label for="textfield" class="control-label">Nama Obat</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama Obat" class="form-control" value="<?php echo $_POST['nama']?>" />
                        </div>
                        <div class="col-sm-3">
                            <label for="textfield" class="control-label">Nama Vendor</label>
                            <input type="text" id="vendor" name="vendor" placeholder="Nama Vendor" class="form-control" value="<?php echo $_POST['vendor']?>" />
                        </div>
                        <div class="col-sm-3">
                            <label for="textfield" class="control-label">Nama Supplier</label>
                            <input type="text" id="supplier" name="supplier" placeholder="Nama Supplier" class="form-control" value="<?php echo $_POST['supplier']?>" />
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
                  <i class="fa fa-table"></i> Hasil Pencarian Obat
                </h3>
              </div>
              <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                  <thead>
                    <tr>
                         <th style="width:40px">No</th>
                         <th>Nama Obat (Kode)</th>
                         <th>Vendor</th>
                         <th>Suplier</th>
                         <th style="width:50px">Beli</th>
                         <th style="width:50px">Jual</th>
                         <th style="width:70px">Expired</th>
                         <th style="width:70px">Option</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $today = date("Y-m-d");
			if ($_POST['nama'] != "" and $_POST['vendor'] != "" and $_POST['supplier'] != "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['nama']."%' and vendor like '%".$_POST['vendor']."%' and suplier like '%".$_POST['supplier']."%' order by id", 0);
			}
			elseif ($_POST['nama'] != "" and $_POST['vendor'] != "" and $_POST['supplier'] == "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['nama']."%' and vendor like '%".$_POST['vendor']."%' order by id", 0);
			}
			elseif ($_POST['nama'] != "" and $_POST['vendor'] == "" and $_POST['supplier'] != "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['nama']."%' and suplier like '%".$_POST['supplier']."%' order by id", 0);
			}
			elseif ($_POST['nama'] != "" and $_POST['vendor'] == "" and $_POST['supplier'] == "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and nama_obat like '%".$_POST['nama']."%'order by id", 0);
			}
			elseif ($_POST['nama'] == "" and $_POST['vendor'] != "" and $_POST['supplier'] != "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and vendor like '%".$_POST['vendor']."%' and supplier like '%".$_POST['supplier']."%' order by id", 0);
			}
			elseif ($_POST['nama'] == "" and $_POST['vendor'] == "" and $_POST['supplier'] != "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and suplier like '%".$_POST['supplier']."%' order by id", 0);
			}
			elseif ($_POST['nama'] == "" and $_POST['vendor'] != "" and $_POST['supplier'] == "") {
                 		$data = $db->query("select *, period_diff(date_format(expire_date, '%Y%m'), date_format(now(), '%Y%m')) as beda from tbl_obat where status_delete='UD' and vendor like '%".$_POST['vendor']."%' order by id", 0);
			}

	                  for ($i = 0; $i < count($data); $i++) {
                                            $bedaB = $db->queryItem("select nilai from tbl_config where kode='EXOBAT'");
                                            if ($data[$i]['beda'] <= $bedaB) $warna = "#F99B9B";
                                            else $warna = "";
                                            $no = $start + $i + 1;
                                            ?>
                                            <tr bgcolor="<?php echo $warna?>">
                                                <td><?php echo $no?></td>
                                                <td><?php echo $data[$i]['nama_obat'].' ['.$data[$i]['kode_obat'].']'?></td>
                                                <td><?php echo $data[$i]['vendor']?></td>
                                                <td><?php echo $data[$i]['suplier']?></td>
                                                <td style="text-align: right"><?php echo number_format($data[$i]['harga_beli'])?></td>
                                                <td style="text-align: right"><?php echo number_format($data[$i]['harga_jual'])?></td>
                                                <td style="text-align: right"><?php echo date("d-m-Y", strtotime($data[$i]['expire_date']))?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=farmasi&submod=obat_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Tambah Satuan" href="index.php?mod=farmasi&submod=obat_satuan&id=<?php echo md5($data[$i]['id'])?>">
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
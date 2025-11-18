<?php

?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat</a>
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
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Satuan Obat
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/farmasi/obat_satuan_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <div class="col-sm-4">
														<label>Isi Besar</label>
                                                        <input type="number" id="isi_besar" name="isi_besar" value="1" class="form-control" tabindex="5" required="required" />
                                                    </div>
                                                    <div class="col-sm-8">
														<label>Satuan Besar</label>
                                                        <select id="satuan_besar" name="satuan_besar" size="1" class="form-control" tabindex="3" required="required">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
                                                                echo '<option value="'.$satuan[$i]['nama'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">
														<label>Isi Kecil</label>
                                                        <input type="number" id="harga_beli" name="harga_beli" class="form-control" tabindex="4" required="required" />
                                                    </div>
                                                    <div class="col-sm-8">
														<label>Satuan Kecil</label>
                                                        <select id="satuan" name="satuan" size="1" class="form-control" tabindex="2" required="required">
                                                            <option value="">--Pilih Satuan--</option>
                                                            <?php
                                                            $satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
                                                            for ($i = 0; $i < count($satuan); $i++) {
                                                                echo '<option value="'.$satuan[$i]['nama'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                	<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Satuan Obat" />
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                            	<?php
													$obat = $db->query("select * from tbl_obat where md5(id)='".$_GET['id']."'");
												?>
                                                <div style="margin-top: 10px; margin-left: 10px; margin-right: 10px;">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped nomargin">
                                                        <thead>
                                                        <th colspan="2" class="text-center">Detail Obat</th>
                                                        </thead>
                                                        <tr>
                                                            <td style="width:140px">Nama Obat</td>
                                                            <td><?php echo $obat[0]['kode_obat'].' - '.$obat[0]['nama_obat']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Vendor / Supplier</td>
                                                            <td><?php echo $obat[0]['vendor'].' / '.$obat[0]['suplier']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Harga</td>
                                                            <td><?php echo 'Harge Beli: Rp. '.number_format($obat[0]['harga_beli']).' | Harga Jual: Rp. '.number_format($obat[0]['harga_jual'])?></td>
                                                        </tr>
                                                    </table>                                                
                                                </div>
                                                <div style="margin-top: 10px; margin-left: 10px; margin-right: 10px; margin-bottom: 10px;">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped nomargin">
                                                        <thead>
                                                        	<tr>
                                                        		<th colspan="6" class="text-center">Daftar Satuan Obat</th>
                                                            </tr>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Isi Besar</th>
                                                                <th>Satuan Besar</th>
                                                                <th>Isi Kecil</th>
                                                                <th>Satuan Kecil</th>
                                                                <th>&nbsp;</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
															$data = $db->query("select * from tbl_obat_satuan where md5(obat_id)='".$_GET['id']."'");
															for ($i = 0; $i < count($data); $i++) {
																$no = $i + 1;
														?>
                                                        <tr>
                                                            <td><?php echo $no?></td>
                                                            <td><?php echo $data[$i]['isi_besar']?></td>
                                                            <td><?php echo $data[$i]['satuan_besar']?></td>
                                                            <td><?php echo $data[$i]['isi_kecil']?></td>
                                                            <td><?php echo $data[$i]['satuan_kecil']?></td>
							    <td>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/farmasi/obat_satuan_delete.php?id=<?php echo md5($data[$i]['id'])."&kode=".$_GET['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
							    </td>
                                                        </tr>
                                                        <?php
															}
														?>
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
<?php
	$data = $db->query("select * from tbl_obat where id='".$_GET['id']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Edit Data Master Obat</div>
	<form action="javascript:simpanData(this.form, 'pages/farmasi/obat_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <tr height="28">
                <td valign="middle" colspan="2">
                    <div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
                        
                    </div>
                </td>
           </tr>
           <tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Kode Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kode_obat" name="kode_obat" class="form-control" style="width: 50px;" tabindex="1" value="<?php echo $data[0]['kode_obat']?>" />
                            </div></td>
                        </tr>

                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama_obat" name="nama_obat" class="form-control" value="<?php echo $data[0]['nama_obat']?>" tabindex="2" />
                            </div></td>
                        </tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Type Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jenis" name="jenis" size="1" tabindex="3" >
                            <?php
								if ($data[0]['jenis'] == 'Obat') {
									echo '<option value="Obat" selected>Obat</option> <option value="Alkes">Alkes</option>';
								}
								else {
									echo '<option value="Obat">Obat</option> <option value="Alkes" selected>Alkes</option>';
								}
							?>
							</select>
                            </div>                            
                            </td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Satuan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="satuan" name="satuan" size="1">
                                <?php
									$satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
									for ($i = 0; $i < count($satuan); $i++) {
										if ($data[0]['satuan_terkecil'] == $satuan[$i]['kode']) {
											echo '<option value="'.$satuan[$i]['kode'].'" selected>'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
										}
										else {
											echo '<option value="'.$satuan[$i]['kode'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
										}
									}
								?>
                            </select>
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Awal</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_awal" name="stock_awal" class="form-control" value="<?php echo $data[0]['stock_awal']?>" tabindex="7" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Masuk</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_masuk" name="stock_masuk" class="form-control" value="<?php echo $data[0]['stock_masuk']?>" tabindex="8" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Keluar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_keluar" name="stock_keluar" class="form-control" value="<?php echo $data[0]['stock_keluar']?>" tabindex="9" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Akhir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_akhir" name="stock_akhir" class="form-control" value="<?php echo $data[0]['stock_akhir']?>" tabindex="10" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Minimal</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_min" name="stock_min" class="form-control" value="<?php echo $data[0]['stock_min']?>" tabindex="11" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Harga Beli</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="harga_beli" name="harga_beli" class="form-control" value="<?php echo $data[0]['harga_beli']?>" tabindex="13" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Harga Jual</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="harga_jual" name="harga_jual" class="form-control" value="<?php echo $data[0]['harga_jual']?>" tabindex="14" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Tanggal Expired</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" value="<?php echo date("m/d/Y", strtotime($data[0]['expire_date']))?>" tabindex="15" /> Format mm/dd/yyyy
                            </div></td>     
                        </tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Vendor/Pabrik</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="vendor" name="vendor" size="1" tabindex="16" style="width: 300px;" >
                            <option value="">--Pilih Vendor/Pabrik--</option>
                            <?php
								$vendor = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
								for ($i = 0; $i < count($vendor); $i++) {
									if ($data[0]['vendor_id'] == $vendor[$i]['kode_vendor']) echo '<option value="'.$vendor[$i]['kode_vendor'].'" selected>'.$vendor[$i]['nama_vendor'].'</option>';
									else echo '<option value="'.$vendor[$i]['kode_vendor'].'">'.$vendor[$i]['nama_vendor'].'</option>';
								}
							?>
                            </select>
                            </div>                            
                            </td>
						</tr>
						<tr height="28">
                            <td width="200"><span style="margin-left:10px">Suplier</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="suplier" name="suplier" size="1" tabindex="17" style="width: 300px;" >
                            <?php
								$vendor = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
								for ($i = 0; $i < count($vendor); $i++) {
									if ($data[0]['suplier_id'] == $vendor[$i]['kode_suplier']) echo '<option value="'.$vendor[$i]['kode_suplier'].'" selected>'.$vendor[$i]['nama_suplier'].'</option>';
									else echo '<option value="'.$vendor[$i]['kode_suplier'].'">'.$vendor[$i]['nama_suplier'].'</option>';
								}
							?>
                            </select>
                            </div>                            
                            </td>
						</tr>

                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Obat" onclick="simpanData(this.form, 'pages/farmasi/obat_update.php')" tabindex="15" />
    </div>
</form>
</div>

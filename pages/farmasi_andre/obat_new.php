<?php

?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Obat</div>
	<form action="javascript:simpanData(this.form, 'pages/farmasi/obat_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                    <h3>
                         <i class="fa fa-table"></i>

                    </h3>

                </div>
                <div class="box-content nopadding" style="overflow-x:auto;">
                        
                    </div>
                </td>
           </tr>
           <tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                        <!--<tr height="28">
                            <td width="200"><span style="margin-left:10px">Kode Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kode_obat" name="kode_obat" class="form-control" style="width: 50px;" tabindex="1" />
                            </div></td>
                        </tr>-->
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama_obat" name="nama_obat" class="form-control" tabindex="2" />
                            </div></td>
                            <td width="200"><span style="margin-left:10px">Type Obat</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="jenis" name="jenis" size="1" tabindex="3" >
                            <option value="">--Type Jenis Obat--</option>
                            <option value="Obat">Obat</option>
                            <option value="Alkes">Alkes</option>
                            </select>
                            </div>                            
                            </td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Satuan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="satuan" name="satuan" size="1">
                            	<option value="">--Pilih Satuan--</option>
                                <?php
									$satuan = $db->query("select * from tbl_satuan where status_delete='UD'");
									for ($i = 0; $i < count($satuan); $i++) {
										echo '<option value="'.$satuan[$i]['kode'].'">'.$satuan[$i]['kode'].' - '.$satuan[$i]['nama'].'</option>';
									}
								?>
                            </select>
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Stock Keluar</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_keluar" name="stock_keluar" class="form-control" tabindex="9" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Akhir</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_akhir" name="stock_akhir" class="form-control" tabindex="10" />
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Stock Minimal</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_min" name="stock_min" class="form-control" tabindex="11" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Harga Beli</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="harga_beli" name="harga_beli" class="form-control" tabindex="13" />
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Harga Jual</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="harga_jual" name="harga_jual" class="form-control" tabindex="14" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Stock Minimal Gudang</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_min_gudang" name="stock_min_gudang" class="form-control" tabindex="11" />
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Stock Minimal Apotik</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="stock_min_apotik" name="stock_min_apotik" class="form-control" tabindex="11" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Jumlah per Box</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="jml_per_box" name="jml_per_box" class="form-control" tabindex="14" />
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Harga per Box</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="harga_per_box" name="harga_per_box" class="form-control" tabindex="14" />
                            </div></td>     
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Tanggal Expired</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" tabindex="14" /> Format mm/dd/yyyy
                            </div></td>     
                            <td width="200"><span style="margin-left:10px">Vendor/Pabrik</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="vendor" name="vendor" size="1" tabindex="12" style="width: 300px;" >
                            <option value="">--Pilih Vendor/Pabrik--</option>
                            <?php
								$vendor = $db->query("select kode_vendor, nama_vendor from tbl_vendor where status_delete='UD'");
								for ($i = 0; $i < count($vendor); $i++) {
									echo '<option value="'.$vendor[$i]['kode_vendor'].'">'.$vendor[$i]['nama_vendor'].'</option>';
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
                            <select id="suplier" name="suplier" size="1" tabindex="12" style="width: 300px;" >
                            <option value="">--Pilih Suplier--</option>
                            <?php
								$vendor = $db->query("select kode_suplier, nama_suplier from tbl_suplier where status_delete='UD'");
								for ($i = 0; $i < count($vendor); $i++) {
									echo '<option value="'.$vendor[$i]['kode_suplier'].'">'.$vendor[$i]['nama_suplier'].'</option>';
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
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Obat" onclick="simpanData(this.form, 'pages/farmasi/obat_insert.php')" tabindex="15" />
    </div>
</form>
</div>

<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
	$ceknmr = $db->queryItem("select max(right(nomr_karyawan, 3)*1) from tbl_karyawan where left(nomr_karyawan, 4)='".date("ym")."'", 0);
	//echo $ceknmr;
	$ceknmr = $ceknmr + 1;
	if ($ceknmr < 10) $ceknmr = '00'.$ceknmr;
	elseif ($ceknmr >= 10 and $ceknmr < 100) $ceknmr = '0'.$ceknmr;
	elseif ($ceknmr >= 100 and $ceknmr < 1000) $ceknmr = $ceknmr;
	
	$nomr = date("ym").$ceknmr;
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Karyawan</div>
	<form action="javascript:simpanData(this.form, 'pages/master/karyawan_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">No Medical Record</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nomr" name="nomr" class="form-control" style="50px" value="<?php echo $nomr?>" readonly="readonly" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Karyawan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama" name="nama" class="form-control" />
                            </div></td>
                        </tr>

<tr height="28">
                            <td width="200"><span style="margin-left:10px">Unit</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <select id="unit" name="unit" size="1">
                            <option value="">--Pilih Unit--</option>
                            <option value="Yayasan RS MH Thamrin">Yayasan RS MH Thamrin</option>
                            <option value="Keluarga Abdul Radjak">Keluarga Abdul Radjak</option>
                            <option value="UPK Cengkareng">UPK Cengkareng</option>
                            <option value="UPK Kalideres">UPK Kalideres</option>
                            <option value="UPK Angke">UPK Angke</option>
                            <option value="UPK Serdang">UPK Serdang</option>
                            <option value="UPK Tegalan">UPK Tegalan</option>
                            <option value="UPK SMC">UPK SMC</option>
                            <option value="UPK Bekasi">UPK Bekasi</option>
                            <option value="UPK Cipayung">UPK Cipayung</option>
                            <option value="UPK Pondok Gede">UPK Pondok Gede</option>
                            <option value="UPK Nadya">UPK Nadya</option>
                            </select>
                            </div>                            
<tr height="28">

                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Karyawan" onclick="simpanData(this.form, 'pages/master/karyawan_insert.php')" />
    </div>
</form>
</div>

<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	$data = $db->query("select * from tbl_coa where id='".$_GET['id']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Edit Data Master COA</div>
	<form action="javascript:simpanData(this.form, 'pages/master/coa_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
    <div align="left">
        <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
           <td height="39"><tr height="28">
                <td valign="middle" colspan="2">
                <div align="left">
                    <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Kode COA</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kd_coa" name="kd_coa" class="form-control" readonly="readonly" style="50px" value="<?php echo $data[0]['kd_coa']?>" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama COA</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nm_coa"  name="nm_coa" class="form-control" value="<?php echo $data[0]['nm_coa']?>" />
                            </div></td>
                        </tr>

                            </div></td>
                        </tr>
                        </tr>
                        </tr>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="hidden" id="id" name="id" value="<?php echo $data[0]['id']?>" />
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Master COA" onclick="simpanData(this.form, 'pages/master/coa_update.php')" />
    </div>
	</form>
</div>
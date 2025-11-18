<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Bank</div>
	<form action="javascript:simpanData(this.form, 'pages/master/bank_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                            <td width="200"><span style="margin-left:10px">Kode Bank</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="kode_bank" name="kode_bank" class="form-control" style="50px" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Nama Bank</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nm_bank" name="nm_bank" class="form-control" />
                            </div></td>
                        </tr>
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">No Rekening</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="no_rek" name="no_rek" class="form-control" />
                            </div></td>
                        </tr>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Cabang</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="cabang" name="cabang" class="form-control" />
                            </div></td>
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
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Bank" onclick="simpanData(this.form, 'pages/master/bank_insert.php')" />
    </div>
</form>
</div>

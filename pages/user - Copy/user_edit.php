<?php
$data = $db->query("select * from tbl_user where id='".$_GET['id']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Edit Data User</div>
    <form method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div align="left">
            <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">USER ID</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="userid" name="userid" value="<?php echo $data[0]['userid'] ?>" class="form-control" readonly="" style="width: 125px;" /></div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">NIP/NIK</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nip" name="nip" class="form-control" value="<?php echo $data[0]['nip'] ?>" style="width: 125px;" /></div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Nama</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;"><input type="text" id="nama" name="nama" value="<?php echo $data[0]['nama'] ?>" class="form-control" /></div></td>
                </tr>
                <tr height="28">
                    <td width="200"><span style="margin-left:10px">Ganti Password</span></td>
                    <td valign="middle" align="center">
                        <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="password" id="password" name="password" class="form-control" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
			<input type="hidden" name="id" id="id" value="<?php echo $data[0]['id']?>" />
            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Karyawan" onclick="simpanData(this.form, 'pages/user/user_update.php')" />
        </div>
    </form>
</div>
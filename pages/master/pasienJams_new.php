<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Upload Data Master Pasien Jamsostek</div>
	<form action="pages/master/pasienJams_insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                            <td width="200"><span style="margin-left:10px">Nama Pasien</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="file" id="data" name="data" size="20">
							<input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Upload" onclick="uploadData(this.form)" />
                            </div></td>
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
</form>
</div>
<script language="javascript">
	function uploadData(t) {
		document.getElementById('simpan').value="Please Wait....";
		document.getElementById('simpan').disabled="disabled";
		t.submit();
	}
</script>
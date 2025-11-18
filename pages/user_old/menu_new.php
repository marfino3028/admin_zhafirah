<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Master Menu</div>
	<form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
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
                            <td width="200"><span style="margin-left:10px">Nama Menu</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="nama_menu" name="nama_menu" class="form-control" style="width: 300px;" />
                            </div></td>
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Kategori Menu</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px; float: left; width: 200px;">
                            <select id="kategori" name="kategori" size="1" style="width: 190px;" onchange="subkategori(this.value)">
                            	<option value="">--Pilih Kategori--</option>
                                <?php
									$layanan = $db->query("select kategori_id as kode, nm_ka_menu as nama from tbl_kat_menu where status_delete='UD'");
									for ($i = 0; $i < count($layanan); $i++) {
										echo '<option value="'.$layanan[$i]['kode'].'">'.$layanan[$i]['kode'].' - '.$layanan[$i]['nama'].'</option>';
									}
								?>
                            </select>
							</div>
							<div id="submenu" style="margin-bottom: 4px; margin-top: 4px; float: left; width: 200px;"></div>
							</td>
						</tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Link</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="link" name="link" class="form-control" style="width: 350px" />
                        </tr>
                        <tr height="28">
                            <td width="200"><span style="margin-left:10px">Keterangan</span></td>
                            <td valign="middle" align="center">
                            <div style="margin-bottom: 4px; margin-top: 4px;">
                            <input type="text" id="ket_kategori" name="ket_kategori" class="form-control" style="width: 350px" />
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
        </table>
    </div>
    <div align="center" style="margin-right: 15px; margin-top: 10px; margin-bottom: 10px;">
        <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Master Menu" onclick="simpanData(this.form, 'pages/user/menu_insert.php')" />
    </div>
</form>
</div>

<script language="javascript">
	function subkategori(id) {
		var url = "pages/user/submenu.php";
		var data = {id:id};
		
		$('#submenu').fadeOut();
		$('#submenu').load(url,data, function(){
			$('#submenu').fadeIn('fast');
		});
	}
</script>
<?php
	$theUser = $db->query("select * from tbl_user where md5(id)='".$_GET['id']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">
    <div class="portlet-header ui-widget-header">Form Tambah Data Hak Akses</div>
		<div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">
		<table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
			<tbody>
				<?php
						$sub = $db->query("select nm_ka_menu nama, ket_kategori keterangan, id from tbl_kat_menu where status_delete='UD'");
						for ($j = 0; $j < count($sub); $j++) {
							$subm = $db->query("select nama_menu nama, link, id, keterangan from tbl_menu where kategori_id='".$sub[$j]['id']."' and status_delete='UD'");
							$f = $f + 1;
							if (count($subm) > 0) {
				?>
				<tr>
					<td colspan="3" style="font-size: 12px; font-weight: bolder; background-color: #F6F6F6;">
						<p style="margin-left: 10px; margin-bottom: 0px; margin-top: 10px;">
						<?php echo $sub[$j]['nama'].' ('.$sub[$j]['keterangan'].')'?></p>
					</td> 
					<td style="font-size: 12px; font-weight: bolder; background-color: #F6F6F6;"><div id="wait<?php echo $f?>">&nbsp;</div></td>
				</tr>
				<?php
								for ($k = 0; $k < count($subm); $k++) {
									$d = $d + 1;
									$cek = $db->queryItem("select id from tbl_user_menu where userid='".$theUser[0]['userid']."' and menu_id='".$subm[$k]['id']."' and kategori_sub_id='".$sub[$j]['id']."'", 0);
									if ($cek > 0) {
										$tulis = ' checked="checked"';
									}
									else {
										$tulis = '';
									}
				?>
				<tr>
					<td class="center" style="width: 40px; text-align: right;"><?php echo $k+1?></td> 
					<td><?php echo $subm[$k]['nama']?></td> 
					<td><?php echo $subm[$k]['link']?></td> 
					<td align="center" style="width: 70px;">
						<input type="checkbox" id="c1<?php echo $d?>" data-skin="minimal" onclick="simpanAkses('<?php echo $subm[$k]['id']?>', 'wait<?php echo $f?>', '<?php echo $theUser[0]['userid']?>')"<?php echo $tulis?>>
					</td> 
				</tr>
				<?php											
								}
							}
						}
				?>
			</tbody>
		</table>
		</div>
</div>

<script language="javascript">
	function simpanAkses(id, divisi, user) {
		//alert(id+" - "+divisi+" - "+user);
		var url = "pages/user/previlage_user_simpan.php";
		var data = {id:id, user:user};
		
		document.getElementById(divisi).innerHTML = "&nbsp;<img src='update/192.168.1.250/wait.gif' width='30'>";
		$('#'+divisi).load(url,data, function(){
			$('#'+divisi).fadeIn('fast');
		});
	}
</script>
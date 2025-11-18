<?php
	$theUser = $db->query("select * from tbl_user where md5(id)='".$_GET['id']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    Menu Previlege
                </a>
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
                                        Form Tambah Data Hak Akses
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
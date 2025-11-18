<?php
//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

    <div class="page-title ui-widget-content ui-corner-all">
        <h1>Data Master: <b>Menu </b></h1>
    </div>  
    <form action="javascript:simpanData(this.form, 'pages/master/dokter_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div align="left">
            <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                <tr height="28">
                    <td valign="middle" colspan="2">
                        <div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">

                            <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                <thead> 
                                    <tr>
                                        <th style="width:40px">No</th> 
                                        <th>User ID</th>
                                        <th>Nama User</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                    $data = $db->query("select * from tbl_user order by id desc", 0);
                                    for ($i = 0; $i < count($data); $i++) {
                                        $nama = $db->queryItem("select nama from tbl_user where userid='" . $data[$i]['userid'] . "'");
                                        $menu = $db->queryItem("select nama_menu from tbl_menu where id='" . $data[$i]['menu_id'] . "'");
                                        ?>
                                        <tr style="cursor: pointer;" title="Klik untuk menentukan Hak Akses" onclick="return window.location = 'index.php?mod=user&submod=previlage_new&id=<?php echo md5($data[$i]['id'])?>'">
                                            <td class="center"><?php echo $i + 1 ?></td> 
                                            <td><?php echo $data[$i]['userid'] ?></td> 
                                            <td><?php echo $nama ?></td> 
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>



    </form>
</div>
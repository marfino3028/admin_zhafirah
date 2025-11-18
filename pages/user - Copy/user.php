<?php
$sub = $db->query("select * from tbl_pegawai where id='" . $_GET['id'] . "'");
$t1 = explode("-", $sub[0]['tgl_lahir']);
$sub[0]['tgl_lahir'] = $t1[1] . '/' . $t1[2] . '/' . $t1[0];

$t2 = explode("-", $sub[0]['tgl_masuk']);
$sub[0]['tgl_masuk'] = $t2[1] . '/' . $t2[2] . '/' . $t2[0];

//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>

<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all form-container">

    <div class="page-title ui-widget-content ui-corner-all">
        <h1>Data Master: <b>USER MANAGEMENR</b></h1>
        <div class="other">
            <div class="float-left">Insert, Update, Delete Data Master User.</div>
            <div class="button float-right">

                <a href="index.php?mod=user&submod=user_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data User</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <form method="post" action="index.php?mod=user&submod=user">
            <input type="text" id="search" name="search" class="text ui-state-default" value="<?php echo $_POST['search'] ?>" /> <input type="submit" class="btn btn-darkblue rounded" value="search" />
        </form>
    </div>  
    <form action="javascript:simpanData(this.form, 'pages/user/user_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
        <div align="left">
            <table border="1" cellpadding="0" style="border-collapse: collapse" width="100%" bordercolor="#000000">
                <tr height="28">
                    <td valign="middle" colspan="2">
                        <div class="hastable box box-content nopadding" align="center" style="margin-left: 10px; margin-right: 10px; width: 98%">

                            <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                <thead> 
                                    <tr>
                                        <th style="width:40px">No</th> 
                                        <th style="width:270px">User</thID> 
                                        <th>Nama User</th> 
                                        <th style="width:70px">Option</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    <?php
                                    $start = $_GET['start'];
                                    $apage = $_GET['apage'];
                                    $number = $_GET['number'];
                                    if (!isset($start))
                                        $start = 0;
                                    if (!isset($apage))
                                        $apage = 50;

                                    if ($_POST['search'] == "")
                                        $data_nr = $db->queryItem("select count(id) from tbl_user", 0);
                                    else
                                        $data_nr = $db->queryItem("select count(id) from tbl_user where nama like '%" . $_POST['search'] . "%' and status_delete='UD'", 0);
                                    $nrdata = $data_nr;

                                    if (!isset($number))
                                        $number = $nrdata;
                                    $page = new pages();
                                    if ($_POST['search'] == "")
                                        $page->link = "index.php?mod=user&submod=user";
                                    else
                                        $page->link = "index.php?mod=user&submod=user&search=" . $_POST['search'];

                                    $page->start = $start;
                                    $page->apage = $apage;
                                    $page->number = $number;
                                    $page->total();
                                    $pagehtml = $page->html;

                                    if ($_POST['search'] == "")
                                        $data = $db->query("select * from tbl_user order by id desc", 0);
                                    else
                                        $data = $db->query("select * from tbl_user where nama like '%" . $_POST['search'] . "%' or userid like '%" . $_POST['search'] . "%' order by id desc", 0);

                                    for ($i = 0; $i < count($data); $i++) {
                                        $no = $start + $i + 1;
                                        ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $no ?></td> 
                                            <td><?php echo $data[$i]['userid'] ?></td> 
                                            <td><?php echo $data[$i]['nama'] ?></td> 
                                            <td class="text-center">
                                                <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=user&submod=user_edit&id=<?php echo $data[$i]['id'] ?>">
                                                    <span class="ui-icon ui-icon-wrench"></span>
                                                </a>
                                                <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/user/user_delete.php?id=<?php echo $data[$i]['id'] ?>';">
                                                    <span class="ui-icon ui-icon-circle-close"></span>
                                                </a>
                                            </td> 
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="4">
                                            <?php echo $pagehtml ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>



    </form>
</div>
<?php
//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Menu Previlege</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Menu Previlege
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>

                                    </h3>

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
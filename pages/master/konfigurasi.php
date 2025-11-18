<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Konfigurasi</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Konfigurasi
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Konfigurasi
                                    </h3>
                                    <a href="index.php?mod=master&submod=konfigurasi_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Konfigurasi</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:30px">No</th>
                                            <th>Deskripsi</th>
                                            <th style="width:90px">Kode</th>
                                            <th style="width:90px">Tahun</th>
                                            <th style="width:90px">Nilai</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $data = $db->query("select * from tbl_config", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['deskripsi']?></td>
                                                <td><?php echo $data[$i]['kode']?></td>
                                                <td><?php echo $data[$i]['tahun']?></td>
                                                <td><?php echo $data[$i]['nilai']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=konfigurasi_edit&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/konfigurasi_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                </td>
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
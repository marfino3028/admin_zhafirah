<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Kelas Rawat Inap</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Kelas untuk Rawat Inap
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i> Daftar Kelas Rawat Inap
                                    </h3>
                                    <a href="index.php?mod=master&submod=kelas_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Kode Kelas</th>
                                            <th>Nama Kelas</th>
                                            <th>Tarif</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select * from tbl_kelas");
											for ($i = 0; $i < count($data); $i++) {
												$no = $start + $i + 1;
                                        ?>
                                            <tr>
                                                <td class="center"><?php echo $no?></td>
                                                <td><?php echo $data[$i]['kode']?></td>
                                                <td><?php echo $data[$i]['nama']?></td>
                                                <td style="text-align: right;">
                                                  	<div style="float: left;">Rp. </div>
                                                  	<?php echo number_format($data[$i]['tarif'])?>
                                              	</td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=kelas_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/kelas_delete.php?id=<?php echo md5($data[$i]['id'])?>';">
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
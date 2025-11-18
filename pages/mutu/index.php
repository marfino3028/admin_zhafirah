<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Worklist</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Indikator Mutu</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Indikator Mutu
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
                                        List / Daftar Indikator Mutu
                                    </h3>
                                    <a href="index.php?mod=mutu&submod=new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Definisi Operasional</th>
                                            <th>Inklusi / Eksklusi</th>
                                            <th>Nilai</th>
                                            <th style="width:40px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select * from tbl_indikator order by id desc", 0);
                                            for ($i = 0; $i < count($data); $i++) {
						$data[$i]['hasil'] = ($data[$i]['total_numerator'] / $data[$i]['total_denominator']) * 100;
                                        ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo 'Unit : '.$data[$i]['unit'].'<br>Waktu : '.date("F Y", strtotime($data[$i]['bulantahun'])).'<br>Kategori : <strong>'.$data[$i]['jenis'].'<br>'.$data[$i]['nama'].'</strong>'?></td>                                                
                                                <td><?php echo nl2br($data[$i]['definisi'])?></td>
                                                <td><?php echo '<strong>Inklusi</strong><br>'.$data[$i]['inklusi'].'<br><br><strong>Eksklusi</strong><br>'.$data[$i]['eksklusi']?></td>
                                                <td>
							Standar : 100%<br><br>
							Hasil Pengolahan Data : <?php echo number_format($data[$i]['hasil'])?>%
						</td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 1px;" title="Edit" href="index.php?mod=mutu&submod=edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="glyphicon-edit"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 1px;" title="Delete" href="#" onclick="return window.location = 'pages/mutu/delete.php?id=<?php echo md5($data[$i]['id'])?>';">
                                                        <span class="glyphicon-bin"></span>
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
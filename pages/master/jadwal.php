<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Dokter</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Jadwal Dokter
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
                                        Daftar / List Jadwal Dokter
                                    </h3>
                                    <a href="index.php?mod=master&submod=jadwal_new" class="btn btn-sm btn-darkblue rounded pull-right">
                                        <span class="fa fa-plus-circle"></span> Setup Jadwal Dokter
                                    </a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                            <tr>
                                                <th style="width:40px; text-align: center;">No</th>
                                                <th style="text-align: center;">Nama Dokter</th>
                                                <th style="text-align: center;">Hari</th>
                                                <th style="text-align: center;">Mulai</th>
                                                <th style="text-align: center;">Selesai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $data = $db->query("SELECT * FROM tbl_jadwal ORDER BY nama_dokter ASC, hari ASC");
                                            $no = 1;
                                            foreach ($data as $dt):
                                            ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $dt['nama_dokter']; ?></td>
                                                    <td>
                                                        <?php
                                                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                                        echo $days[$dt['hari'] - 1];
                                                        ?>
                                                    </td>
                                                    <td><?= $dt['mulai']; ?></td>
                                                    <td><?= $dt['selesai']; ?></td>
                                                </tr>
                                            <?php
                                            endforeach;
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
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    });
</script>
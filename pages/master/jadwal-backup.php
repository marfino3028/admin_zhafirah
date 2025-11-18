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
                                                <th style="text-align: center;">Senin</th>
                                                <th style="text-align: center;">Selasa</th>
                                                <th style="text-align: center;">Rabu</th>
                                                <th style="text-align: center;">Kamis</th>
                                                <th style="text-align: center;">Jumat</th>
                                                <th style="text-align: center;">Sabtu</th>
                                                <th style="text-align: center;">Minggu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $search = isset($_POST['search']) ? $_POST['search'] : '';
                                            $dataQuery = "SELECT kd_poli, nama_poli FROM tbl_jadwal GROUP BY kd_poli";

                                            if ($search) {
                                                $dataQuery = "SELECT kd_poli, nama_poli FROM tbl_jadwal WHERE nama_dokter LIKE '%$search%' GROUP BY kd_poli";
                                            }

                                            $data = $db->query($dataQuery);

                                            foreach ($data as $poli) {
                                            ?>
                                                <tr>
                                                    <td colspan="9" style="background-color: #368ee0; color: #FFFFFF;">
                                                        <?php echo $poli['nama_poli']; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $subQuery = "SELECT kode_dokter, nama_dokter FROM tbl_jadwal WHERE kd_poli='" . $poli['kd_poli'] . "' GROUP BY kode_dokter";

                                                if ($search) {
                                                    $subQuery = "SELECT kode_dokter, nama_dokter FROM tbl_jadwal WHERE kd_poli='" . $poli['kd_poli'] . "' AND nama_dokter LIKE '%$search%' GROUP BY kode_dokter";
                                                }

                                                $sub1 = $db->query($subQuery);

                                                foreach ($sub1 as $no => $dokter) {
                                                    $no++;
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?php echo $no; ?></td>
                                                        <td><?php echo $dokter['nama_dokter']; ?></td>
                                                        <?php
                                                        $cek = $db->query("SELECT janji FROM tbl_jadwal WHERE kode_dokter='" . $dokter['kode_dokter'] . "'");

                                                        if ($cek[0]['janji'] != "") {
                                                            echo '<td colspan="7" style="text-align: center;"><i>' . $cek[0]['janji'] . '</i></td>';
                                                        } else {
                                                            for ($l = 1; $l < 8; $l++) {
                                                                echo '<td style="text-align: center; font-size: 11px; width: 100px;">';
                                                                $schedule = $db->query("SELECT id, mulai, selesai, keterangan, janji FROM tbl_jadwal WHERE kode_dokter='" . $dokter['kode_dokter'] . "' AND hari='$l'");

                                                                foreach ($schedule as $scheduleItem) {
                                                                    if ($scheduleItem['janji'] == '*Dengan Perjanjian') {
                                                                        echo '<div><a href="/index.php?mod=master&submod=jadwal_edit&id=' . md5($scheduleItem['id']) . '">' . $scheduleItem['janji'] . '</a></div>';
                                                                    } else {
                                                                        $borderStyle = ($scheduleItem !== reset($schedule)) ? 'border-top-style: dotted; border-top-width: 1px;' : '';
                                                                        $keterangan = $scheduleItem['keterangan'] ? '<br><small>' . $scheduleItem['keterangan'] . '</small>' : '';
                                                                        echo "<div style='$borderStyle'><a href='/index.php?mod=master&submod=jadwal_edit&id=" . md5($scheduleItem['id']) . "'>" . $scheduleItem['mulai'] . ' - ' . $scheduleItem['selesai'] . $keterangan . "</a></div>";
                                                                    }
                                                                }
                                                                echo '</td>';
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                            <?php
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

<script>
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    });
</script>
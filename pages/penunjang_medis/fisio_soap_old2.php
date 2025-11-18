<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <?php
    $pasien = $db->query("select * from tbl_pasien where nomr='" . $_GET['id'] . "'");
    $daftarnr = $db->queryItem("select count(id) from tbl_pendaftaran where nomr='" . $_GET['id'] . "'");
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-user"></i>
                        Profile Pasien
                    </h3>
                    <a href="index.php?mod=penunjang_medis&submod=fisio_soap_form&id=<?php echo $_GET['id'] . '&ids=' . $_GET['ids']; ?>&fisio=<?= $_GET['fisio']; ?>" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Pemeriksaan</a>
                </div>
                <div class="box-content">
                    <blockquote>
                        <p>
                            <?php echo $pasien[0]['nomr'] . ' - ' . $pasien[0]['nm_pasien'] ?>
                        </p>
                        <small>Jenis Kelamin : <?php echo $pasien[0]['jk'] ?></small>
                        <small>Alamat / Asal : <?php echo $pasien[0]['alamat_pasien'] ?></small>
                        <small>Berobat ditempat ini sebanyak : <?php echo $daftarnr ?> Kali</small>
                    </blockquote>
                </div>
            </div>
            <div class="box">
                <div class="box-title">
                    <h3 style="padding-right: 50px;">
                        <i class="fa fa-table"></i> History Fisioterapi
                    </h3>
                </div>
                <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

                    <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Subject</th>
                                <th>Object</th>
                                <th>Assesment</th>
                                <th>Planning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data = $db->query("select * from tbl_fisio where id='" . $_GET['fisio'] . "' order by tgl_input_fisio desc");
                            for ($i = 0; $i < count($data); $i++) {
                                if ($data[$i]['tgl_soap'] == '') {
                                    $tgl_soap = '-';
                                } else {
                                    $tgl_soap = date('d/m/Y H:i', strtotime($data[$i]['tgl_soap']));
                                }
                            ?>
                                <tr>
                                    <td><?= $tgl_soap; ?></td>
                                    <td><?= nl2br($data[$i]['subject']); ?></td>
                                    <td><?= nl2br($data[$i]['object']); ?></td>
                                    <td><?= nl2br($data[$i]['assesment']); ?></td>
                                    <td><?= nl2br($data[$i]['planning']); ?></td>
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

<script>
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    })
</script>
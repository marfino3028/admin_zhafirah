<?php
ini_set("display_errors", 0);
include "../../3rdparty/engine.php";
$pasien = $db->query("select * from tbl_pasien where nomr='" . $_GET['ids'] . "'");
$pendaftaran = $db->query("select p.*, d.nama_dokter, l.nama_poli from tbl_pendaftaran p LEFT JOIN tbl_dokter d ON p.kode_dokter=d.kode_dokter LEFT JOIN tbl_poli l ON p.kd_poli=l.kd_poli where no_daftar='" . $_GET['id'] . "'");
$catatan = $db->query("select * from tbl_catatan_dktr where no_daftar='" . $_GET['id'] . "'");

$tindakan = $db->query("select * from tbl_tindakan where no_daftar='" . $_GET['id'] . "'");

$resepHeader = $db->query("select * from tbl_resep where no_daftar='" . $_GET['id'] . "'");
$no_resep = $resepHeader[0]['no_resep'];
$resep = $db->query("select * from tbl_resep_detail where no_resep='" . $no_resep . "'");

$racikHeader = $db->query("select * from tbl_racikan where no_daftar='" . $_GET['id'] . "'");

$fisio = $db->query("select * from tbl_fisio where no_daftar='" . $_GET['id'] . "' and status_delete = 'UD'");

?>

<div style="padding: 10px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
    <table style="width: 100%;">
        <tr valign="top">
            <td style="text-align: center;"><img src="../../images/billing_1.png" height="65px"></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <h3 style="font-weight: bold; margin-bottom: -10px;">KLINIK UTAMA DIALISACARE</h3>
                <p style="font-size: 12px;">Jl. Kamboja No. 10A Rt. 04 Rw. 08 Kel. Pejaten, Kec. Pasar Minggu. <br>Website: dialisacare.com / Email: info@dialisacare.com <br>Phone: +62852-1142-5557</p>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="text-align: right; width: 30%;">
                <label style="color: blue; font-size: 18pt;">Resume Medis</label>
                <br>
                <?php
                if ($catatan[0]['insert_resume'] == '') {
                    $insert = '';
                } else {
                    $insert = 'Dibuat : ' . date('d F Y H:i:s', strtotime($catatan[0]['insert_resume']));
                }
                if ($catatan[0]['update_resume'] == '') {
                    $update = '';
                } else {
                    $update = 'Diubah : ' . date('d F Y H:i:s', strtotime($catatan[0]['update_resume']));
                }
                ?>
                <p style="font-size: 12px;">
                    <?= $insert; ?> <br>
                    <?= $update; ?>
                </p>
            </td>
        </tr>
    </table>

    <br><br><br>

    <table style="width: 100%;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 50%;">

                <label style="color: blue; font-size: 14pt;">Info Pasien</label>
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td style="width: 45%;">Nama Pasien</td>
                        <td style="width: 5%;">:</td>
                        <td><?= $pasien[0]['nm_pasien']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?= date('d F Y', strtotime($pasien[0]['tgl_lahir'])); ?></td>
                    </tr>
                    <tr>
                        <td>No.RM</td>
                        <td>:</td>
                        <td><?= $pasien[0]['nomr']; ?></td>
                    </tr>
                    <tr>
                        <td>Golongan Darah</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Hamil / Menyusui</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                </table>

            </td>
            <td style="width: 50%;">

                <label style="color: blue; font-size: 14pt;">Info Pendaftaran</label>
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td style="width: 45%;">Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td><?= date('d F Y', strtotime($pendaftaran[0]['tgl_daftar'])); ?></td>
                    </tr>
                    <tr>
                        <td>Nama Dokter</td>
                        <td>:</td>
                        <td><?= $pendaftaran[0]['nama_dokter']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Poli</td>
                        <td>:</td>
                        <td><?= $pendaftaran[0]['nama_poli']; ?></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <br>

    &nbsp; <label style="color: blue; font-size: 14pt;">Subjective</label>
    <table style="width: 100%; font-size: 12px;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 22%;">Keluhan Utama</td>
            <td style="width:2.5%">:</td>
            <td><?= $catatan[0]['cc_hpi']; ?></td>
        </tr>
        <tr>
            <td>Riwayat Penyakit</td>
            <td>:</td>
            <td><?= $catatan[0]['past_med_history']; ?></td>
        </tr>
        <tr>
            <td>Riwayat Penyakit Keluarga</td>
            <td>:</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Riwayat Alergi</td>
            <td>:</td>
            <td><?= $catatan[0]['alergi']; ?></td>
        </tr>
        <tr>
            <td>Riwayat Vaksinasi</td>
            <td>:</td>
            <td>-</td>
        </tr>
    </table>

    <br>

    &nbsp; <label style="color: blue; font-size: 14pt;">Objective</label>

    <table style="width: 100%;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 50%;">

                <label style="font-size: 14pt;">Tanda-tanda Vital</label>
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td style="width: 45%;">Suhu Tubuh</td>
                        <td style="width: 5%;">:</td>
                        <td><?= $catatan[0]['v_temp']; ?><sup>o</sup></td>
                    </tr>
                    <tr>
                        <td>Tekanan Darah</td>
                        <td>:</td>
                        <td><?= $catatan[0]['v_bp']; ?>/<?= $catatan[0]['v_bpd']; ?> mmHg</td>
                    </tr>
                    <tr>
                        <td>Denyut Nadi</td>
                        <td>:</td>
                        <td><?= $catatan[0]['v_rr']; ?></td>
                    </tr>
                    <tr>
                        <td>Frekuensi Pernapasan</td>
                        <td>:</td>
                        <td><?= $catatan[0]['v_rr']; ?></td>
                    </tr>
                </table>

            </td>
            <td style="width: 50%;">
                <br>
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td style="width: 45%;">Tinggi Badan</td>
                        <td style="width: 5%;">:</td>
                        <td><?= $catatan[0]['v_height']; ?></td>
                    </tr>
                    <tr>
                        <td>Berat Badan</td>
                        <td>:</td>
                        <td><?= $catatan[0]['v_weight']; ?></td>
                    </tr>
                    <tr>
                        <td>Lingkar Kepala</td>
                        <td>:</td>
                        <td><?= $catatan[0]['lingkar_k']; ?></td>
                    </tr>
                    <tr>
                        <td>Lingkar Perut</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Saturasi Oksigen</td>
                        <td>:</td>
                        <td><?= $catatan[0]['spo2']; ?></td>
                    </tr>
                </table>

            </td>
        </tr>

        <tr valign="top">
            <td colspan="2">

                <label style="font-size: 14pt;">Pemeriksaan Fisik</label>
                <br>
                <p style="font-size: 12px;">
                    - Mata : <?= $catatan[0]['pe_mata']; ?> <br>
                    - THT : <?= $catatan[0]['pe_tht']; ?> <br>
                    - Jantung : <?= $catatan[0]['pe_jantung']; ?> <br>
                    - Paru : <?= $catatan[0]['pe_paru']; ?> <br>
                    - Ekstremitas : <?= $catatan[0]['pe_eks']; ?> <br>
                </p>
            </td>
        </tr>
    </table>

    <br>

    &nbsp; <label style="color: blue; font-size: 14pt;">Assesment</label>
    <table style="width: 100%; font-size: 12px;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 22%;">Diagnosa</td>
            <td style="width:2.5%">:</td>
            <td><?= $catatan[0]['as_diagnosis']; ?></td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Problem</td>
            <td style="width:2.5%">:</td>
            <td><?= $catatan[0]['as_problems']; ?></td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Progress Note</td>
            <td style="width:2.5%">:</td>
            <td><?= $catatan[0]['as_progres']; ?></td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Other</td>
            <td style="width:2.5%">:</td>
            <td><?= $catatan[0]['other_as']; ?></td>
        </tr>
    </table>
    <br><br>
    <br><br><br><br><br>
    <br><br><br><br><br>
    &nbsp; <label style="color: blue; font-size: 14pt;">Plan</label>
    <table style="width: 100%; font-size: 12px;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 22%;">Tindakan</td>
            <td style="width:2.5%">:</td>
            <td>

                <?php
                for ($i = 0; $i < count($tindakan); $i++) {
                    echo '- ' . $tindakan[$i]['nama_tindakan'] . '<br>';
                }
                ?>

            </td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Obat</td>
            <td style="width:2.5%">:</td>
            <td>

                <?php
                for ($i = 0; $i < count($resep); $i++) {
                    echo '- ' . $resep[$i]['nama_obat'] . ' (' . $resep[$i]['qty'] . ' | ' . $resep[$i]['frekuensi'] . ') <br>';
                }
                ?>

            </td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Medikamentosa</td>
            <td style="width:2.5%">:</td>
            <td>

                <?php



                for ($i = 0; $i < count($racikHeader); $i++) {
                    $id_racikan = $racikHeader[$i]['id'];
                    $racikan = $db->query("select * from tbl_racikan_detail where racikanId='" . $id_racikan . "'");

                    echo '- R/' . $racikHeader[$i]['nama'] . '<br>';
                    for ($x = 0; $x < count($racikan); $x++) {
                        echo '&nbsp;&nbsp;&nbsp;- ' . $racikan[$x]['nama_obat'] . ' (' . $racikan[$x]['qty'] . ') <br>';
                    }
                }
                ?>

            </td>
        </tr>
        <tr valign="top">
            <td style="width: 22%;">Status Pulang</td>
            <td style="width:2.5%">:</td>
            <td>Berobat Jalan</td>
        </tr>
    </table>

<?php
    if (count($fisio) > 0) {
        echo "<br>";
    ?>
        &nbsp; <label style="color: blue; font-size: 14pt;">Catatan Fisioterapi</label>
        <table style="width: 100%; font-size: 12px;" border="0" cellpadding="5">
            <tr valign="top">
                <td style="width: 22%;">Subject</td>
                <td style="width:2.5%">:</td>
                <td><?= $fisio[0]['subject']; ?></td>
            </tr>
            <tr>
                <td>Object</td>
                <td>:</td>
                <td><?= $fisio[0]['object']; ?></td>
            </tr>
            <tr>
                <td>Assesment</td>
                <td>:</td>
                <td><?= $fisio[0]['assesment']; ?></td>
            </tr>
            <tr>
                <td>Planning</td>
                <td>:</td>
                <td><?= $fisio[0]['planning']; ?></td>
            </tr>
        </table>
    <?php
    }
    ?>

    <br><br>
    &nbsp; <b>Dokter,</b>

    <br><br><br><br><br><br><br>

    &nbsp; <b><?= $pendaftaran[0]['nama_dokter']; ?></b>
</div>
<script>
    window.onload = function() {
        window.print();
        setTimeout(window.close, 500);
    };
</script>
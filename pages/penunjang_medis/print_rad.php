<?php
ini_set("display_errors", 0);
include "../../3rdparty/engine.php";
$theData = $db->query("select * from tbl_rad where md5(no_rad)='".$_GET['ids']."'");
$_GET['id'] = $theData[0]['no_daftar'];
$pasien = $db->query("select * from tbl_pasien where nomr='" . $theData[0]['nomr'] . "'");
$pendaftaran = $db->query("select p.*, d.nama_dokter, l.nama_poli from tbl_pendaftaran p LEFT JOIN tbl_dokter d ON p.kode_dokter=d.kode_dokter LEFT JOIN tbl_poli l ON p.kd_poli=l.kd_poli where no_daftar='" . $_GET['id'] . "'");
$catatan = $db->query("select * from tbl_catatan_dktr where no_daftar='" . $_GET['id'] . "'");

$tindakan = $db->query("select * from tbl_tindakan where no_daftar='" . $_GET['id'] . "'");

$resepHeader = $db->query("select * from tbl_resep where no_daftar='" . $_GET['id'] . "'");
$no_resep = $resepHeader[0]['no_resep'];
$resep = $db->query("select * from tbl_resep_detail where no_resep='" . $no_resep . "'");

$racikHeader = $db->query("select * from tbl_racikan where no_daftar='" . $_GET['id'] . "'");

$fisio = $db->query("select * from tbl_fisio where no_daftar='" . $_GET['id'] . "' and status_delete = 'UD'");

$detailnya = $db->query("select * from tbl_rad_dokumen where md5(no_rad)='".$_GET['ids']."'");

?>

<div style="padding: 10px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
    <table style="width: 100%;">
        <tr valign="top">
            <td style="text-align: center;"><img src="../../images/orthojack.png" height="100px"></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <h3 style="font-weight: bold; margin-bottom: -10px;">KLINIK UTAMA ORTHOJACK</h3>
                <p style="font-size: 12px;">Jl. Tebet Barat 1 No. 4, Kel. Tebet barat, Kec. Tebet, Jakarta Selatan 12810, Indonesia. <br>Website: Orthojackclinic.com / Email: info@klinikorthojack.com <br>Phone: 0857 99 500 500</p>
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

    <table style="width: 100%;" border="0" cellpadding="5">
        <tr valign="top">
            <td style="width: 100%;">

                <label style="color: blue; font-size: 14pt;">Keterangan Expertise Radiologi</label>
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td><?php echo nl2br($detailnya[0]['keterangan']); ?></td>
                    </tr>
                </table>

            </td>
        </tr>
	<?php 
		for ($i = 0; $i < count($detailnya); $i++) {
	?>
        <tr valign="top">
            <td style="width: 100%;">
                <table style="width: 100%; font-size: 12px;">
                    <tr>
                        <td><img src="../../dokumen/<?php echo $detailnya[$i]['dokumen']; ?>" style="max-width: 400px;"></td>
                    </tr>
                </table>

            </td>
        </tr>
	<?php
		}
	?>
    </table>

    <br>

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
<?php
date_default_timezone_set('Asia/Jakarta');
include "../../3rdparty/engine.php";
$data = $db->query("SELECT * FROM tbl_keterangan_pasien WHERE id='$_GET[id]'", 0);
$no_daftar = $data[0]['no_daftar'];
$nomr = $data[0]['nomr'];
$today = date("Y-m-d");
$catatan = $db->query("SELECT * FROM tbl_catatan_dktr WHERE no_daftar='$no_daftar'", 0);
$pasien = $db->query("select nomr, nm_pasien, pekerjaan, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, alamat_pasien, telp_pasien, id from tbl_pasien where status_delete='UD' and nomr='" . $nomr . "'", 0);
$pendaftaran = $db->query("SELECT p.kode_dokter, d.nama_dokter FROM tbl_pendaftaran p LEFT JOIN tbl_dokter d ON p.kode_dokter=d.kode_dokter WHERE p.no_daftar='$no_daftar'", 0);
?>

<div style="padding: 10px;">
    <table>
        <tr>
            <td style="text-align: center;"><img src="../../images/orthojack.png" height="100px"></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="text-align: center;">
                <h2 style="font-weight: bold; margin-bottom: -10px;">KLINIK UTAMA ORTHOJACK</h2>
                <p style="font-size: 12px;">Jl. Tebet Barat 1 No. 4, Kel. Tebet barat, Kec. Tebet, Jakarta Selatan 12810, Indonesia. <br>Website: Orthojackclinic.com / Email: info@klinikorthojack.com <br>Phone: 0857 99 500 500</p>
            </td>
        </tr>
    </table>
    <hr style="border: 2px solid black; margin-bottom: -5px;">
    <hr style="border: 0.8px solid black; margin-bottom: 30px;">
    <div style="text-align: center;"><u><b>SURAT KETERANGAN SAKIT</b></u></div>
    <br>
    Dengan ini menerangkan bahwa berdasarkan hasil pemeriksaan yang telah dilakukan kepada pasien : <br><br>
    <table style="width: 100%;">
        <tr>
            <td style="width: 20%;">Nama</td>
            <td style="width: 5%;">:</td>
            <td><?= $pasien[0]['nm_pasien']; ?></td>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <td><?= $pasien[0]['umur'] ?> Thn</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?= $pasien[0]['jk']; ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td><?= $pasien[0]['pekerjaan']; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $pasien[0]['alamat_pasien']; ?></td>
        </tr>
        <tr>
            <td>Diagnosa</td>
            <td>:</td>
            <td><?= $catatan[0]['as_diagnosis']; ?></td>
        </tr>
    </table>

    <br>
    <p>Diberikan istirahat selama <b><?= $data[0]['istirahat_selama']; ?></b> hari terhitung mulai tanggal <b><?= date('d F Y', strtotime($data[0]['istirahat_mulai_tanggal'])); ?></b> sampai dengan <b><?= date('d F Y', strtotime($data[0]['istirahat_sampai_tanggal'])); ?></b>. <br>Demikian surat keterangan ini diberikan untuk diketahui dan dipergunakan seperlunya.
    </p>

    <br><br>

    <?= $data[0]['terbit_di']; ?>, <?= date('d F Y', strtotime($data[0]['tanggal_pembuatan'])); ?><br>
    Dokter Pemeriksa,
    <br><br><br><br><br>
    <u><?= $pendaftaran[0]['nama_dokter']; ?></u>
</div>
<script>
    window.onload = function() {
        window.print();
        setTimeout(window.close, 500);
    };
</script>
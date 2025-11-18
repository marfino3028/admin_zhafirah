<?php
include "../../../3rdparty/engine.php";
extract($_GET);
$klinik = $db->query("SELECT deskripsi FROM tbl_config WHERE deskripsi = 'Nama Faskes'")[0]['deskripsi'];

$dataSep = $db->query("SELECT * FROM tbl_sep WHERE noSep = '$no'")[0];

$link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
$ch = curl_init();
$dataA = array(
    "no_sep" => $no
);
$payload = json_encode($dataA);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/sep/cari_sep");
$result = curl_exec($ch);
curl_close($ch);
$data = json_decode($result, true);
?>

<!-- page print -->
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<table border="0" cellpadding="8px" width="100%">
    <tr>
        <td width="25%">
            <img height="60px" src="../../../images/bpjs.png" alt="">
        </td>
        <td style="font-size: 25px; font-weight: bold;" align="center">
            SURAT ELEGIBILITAS PESERTA <br>
            <?= $klinik; ?>
        </td>
        <td width="20%">

        </td>
    </tr>
</table>

<div class="row mt-4">
    <div class="col-md-6">
        <table width="100%" cellpadding="0" border="0">
            <tr>
                <td width="30%">No MR</td>
                <td width="5%"> : </td>
                <td width="65%"><?= $data['response']['peserta']['noMr']; ?></td>
            </tr>
            <tr>
                <td>No SEP</td>
                <td> : </td>
                <td><b><?= $data['response']['noSep']; ?></b></td>
            </tr>
            <tr>
                <td>No Kartu</td>
                <td> : </td>
                <td><?= $data['response']['peserta']['noKartu']; ?></td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td> : </td>
                <td><?= $data['response']['peserta']['nama']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td> : </td>
                <td><?= date('d-M-Y', strtotime($data['response']['peserta']['tglLahir'])); ?> &nbsp; &nbsp;
                    <?php
                    if ($data['response']['peserta']['kelamin'] == 'L') {
                        $kelamin = "Laki-laki";
                    } else {
                        $kelamin = "Perempuan";
                    }
                    ?>
                    Jenis Kelamin : <?= $kelamin; ?>
                </td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td> : </td>
                <td><?= $data['response']['peserta']['jnsPeserta']; ?></td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td> : </td>
                <td><?= $data['response']['catatan']; ?></td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table width="100%" cellpadding="0" border="0">
            <tr>
                <td width="30%">Tanggal SEP</td>
                <td width="5%">:</td>
                <td width="65%"><?= date('d-M-Y', strtotime($data['response']['tglSep'])); ?></td>
            </tr>
            <tr>
                <td>Kls. Hak</td>
                <td> : </td>
                <td><?= $data['response']['peserta']['hakKelas']; ?></td>
            </tr>
            <tr>
                <td>Kls. Rawat</td>
                <td> : </td>
                <td>Kelas <?= $data['response']['klsRawat']['klsRawatHak']; ?></td>
            </tr>
            <tr>
                <td>Penj Naik Kelas</td>
                <td> : </td>
                <td><?= $data['response']['klsRawat']['klsRawatNaik']; ?></td>
            </tr>

            <tr>
                <td>Jns. Rawat</td>
                <td> : </td>
                <td><?= $data['response']['jnsPelayanan']; ?></td>
            </tr>
            <tr>
                <td>Procedure</td>
                <td> : </td>
                <td></td>
            </tr>
            <tr>
                <td>Diagnosa Awal</td>
                <td> : </td>
                <td><?= $data['response']['diagnosa']; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row mt-4" style="border-top: 3px solid black;border-bottom: 3px solid black;">
    <div class="col-md-4">
        Jasa Pelayanan
    </div>
    <div class="col-md-4">
        Dokter
    </div>
    <div class="col-md-4">
        Paraf
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <?= $data['response']['poli']; ?>
    </div>
    <div class="col-md-4">
        <?= $data['response']['dpjp']['nmDPJP']; ?>
    </div>
    <div class="col-md-4">
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-8">
        <small>
            <i>*Saya Menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan,</i>
            <br>
            <i>*SEP bukan sebagai bukti penjaminan peserta</i>
        </small>
    </div>
    <div align="left" class="col-md-4">
        Pasien

        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
    </div>
</div>

<script>
    window.onload = function() {
        window.print();
        setTimeout(window.close, 500);
    };
</script>
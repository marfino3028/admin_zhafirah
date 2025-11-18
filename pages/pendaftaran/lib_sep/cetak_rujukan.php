<?php
include "../../../3rdparty/engine.php";
extract($_GET);
$klinik = $db->query("SELECT deskripsi FROM tbl_config WHERE deskripsi = 'Nama Faskes'")[0]['deskripsi'];

$dataSep = $db->query("SELECT * FROM tbl_rujukan_bpjs WHERE noRujukan = '$no'")[0];

$link_ws = $db->query("SELECT * FROM tbl_wsbpjskes");
$ch = curl_init();
$dataA = array(
    "no_rujukan" => $no
);
$payload = json_encode($dataA);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_URL, $link_ws[0]['link_ws_vclaim'] . "vclaim/rujukan/norujukan_keluar");
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
            SURAT RUJUKAN <br>
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
                <td width="30%">No Kunjungan</td>
                <td width="5%">:</td>
                <td width="65%"><?= $data['response']['rujukan']['noRujukan']; ?></td>
            </tr>
            <tr>
                <td>No.Kartu</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['noKartu']; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['nama']; ?></td>
            </tr>
            <tr>
                <td>Kelas Rawat</td>
                <td> : </td>
                <td>Kelas <?= $data['response']['rujukan']['kelasRawat']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['tglLahir']; ?> (<?= $data['response']['rujukan']['kelamin']; ?>)</td>
            </tr>
            <tr>
                <td>Tanggal Rujukan</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['tglRujukan']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Rencana Rujukan</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['tglRencanaKunjungan']; ?></td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table width="100%" cellpadding="0" border="0">
            <tr>
                <td width="30%">PPK Dirujuk</td>
                <td width="5%">:</td>
                <td width="65%"><?= $data['response']['rujukan']['ppkDirujuk']; ?> - <?= $data['response']['rujukan']['namaPpkDirujuk']; ?></td>
            </tr>
            <tr>
                <td>Jenis Pelayanan</td>
                <td> : </td>
                <td>
                    <?php
                    if ($data['response']['rujukan']['jnsPelayanan'] == 1) {
                        echo "Rawat Inap";
                    } else {
                        echo "Rawat Jalan";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['catatan']; ?></td>
            </tr>
            <tr>
                <td>Diagnosa</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['diagRujukan']; ?> - <?= $data['response']['rujukan']['namaDiagRujukan']; ?></td>
            </tr>
            <tr>
                <td>Tipe Rujukan</td>
                <td> : </td>
                <td>
                    <?= $data['response']['rujukan']['namaTipeRujukan']; ?>
                </td>
            </tr>
            <tr>
                <td>Poli Rujukan</td>
                <td> : </td>
                <td><?= $data['response']['rujukan']['namaPoliRujukan']; ?></td>
            </tr>
        </table>
    </div>
</div>


<script>
    window.onload = function() {
        window.print();
        setTimeout(window.close, 500);
    };
</script>
<?php
date_default_timezone_set('Asia/Jakarta');
include "../../3rdparty/engine.php";
$header = $db->query("SELECT * FROM tbl_invoice WHERE id='$_GET[id]'", 0);

function terbilang($angka)
{
    $angka = (float)$angka;
    $bilangan = [
        "",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"
    ];

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return terbilang($angka - 10) . " belas";
    } elseif ($angka < 100) {
        return terbilang(floor($angka / 10)) . " puluh " . terbilang($angka % 10);
    } elseif ($angka < 200) {
        return "seratus " . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        return terbilang(floor($angka / 100)) . " ratus " . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        return "seribu " . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        return terbilang(floor($angka / 1000)) . " ribu " . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        return terbilang(floor($angka / 1000000)) . " juta " . terbilang($angka % 1000000);
    } else {
        return "Jumlah terlalu besar";
    }
}
?>

<div style="padding: 10px;">

    <table style="border-collapse: collapse; width: 100%;" border="1" cellpadding="5">
        <tr>
            <td>

                <table style="width: 100%;">
                    <tr valign="top">
                        <td style="text-align: center; width: 15%;"><img style="margin-top: -5px;" src="../../images/billing_1.png" height="50px"></td>
                        <td style="text-align: center;">
                            <h2 style="font-weight: bold; margin-bottom: -10px;">KWITANSI</h2>
                        </td>
                        <td style="text-align: left; width: 40%;">

                            <table style="width: 100%;">
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td><?= date('d / m / Y', strtotime($header[0]['tgl_input'])); ?></td>
                                </tr>
                                <tr>
                                    <td>No.Kwitansi</td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>

                <br>

                <table cellpadding="5" style="width: 100%;">
                    <tr valign="top">
                        <td style="width: 30%;">Sudah diterima dari</td>
                        <td style="width: 5%;">:</td>
                        <td><?= $header[0]['nama_perusahaan']; ?></td>
                    </tr>
                    <tr valign="top">
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>Rp. <?= number_format($header[0]['total']); ?></td>
                    </tr>
                    <tr valign="top">
                        <td><i>Terbilang</i></td>
                        <td>:</td>
                        <td><i><?= ucwords(terbilang($header[0]['total'])) . " rupiah"; ?></i></td>
                    </tr>
                    <tr valign="top">
                        <td>Untuk Pembayaran</td>
                        <td>:</td>
                        <td><?= $header[0]['no_inv']; ?></td>
                    </tr>
                </table>

                <br>

                <table align="right">
                    <tr>
                        <td style="text-align: center;">Finance</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><br><br><br></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><u>Lita Fitriyani S.Ak.</u></td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <table style="width: 100%; font-size: 9pt;">
        <tr valign="top">
            <td style="width: 5%;">NB:</td>
            <td>
                1. Kwitansi disimpan dengan baik dan jangan sampai hilang <br>
                2. Data ini tidak bisa diganti / print ulang
            </td>
        </tr>
    </table>

</div>
<script>
    window.onload = function() {
        window.print();
        setTimeout(window.close, 500);
    };
</script>
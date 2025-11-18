<?php
date_default_timezone_set('Asia/Jakarta');
include "../../3rdparty/engine.php";
$header = $db->query("SELECT * FROM tbl_invoice WHERE id='$_GET[id]'", 0);
$detail = $db->query("SELECT d.*, p.nm_pasien, h.no_inv FROM tbl_invoice_detail d LEFT JOIN tbl_invoice h ON d.invoiceID=h.id LEFT JOIN tbl_pasien p ON d.nomr=p.nomr WHERE d.invoiceID = '$_GET[id]'", 0);
?>

<div style="padding: 10px;">
    <table>
        <tr>
            <td style="text-align: center;"><img src="../../images/billing_1.png" height="75px"></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="text-align: center;">
                <h2 style="font-weight: bold; margin-bottom: -10px;">KLINIK DIALISACARE PEJATEN</h2>
                <p style="font-size: 12px;">Jl. Tebet Barat 1 No. 4, Kel. Tebet barat, Kec. Tebet, Jakarta Selatan 12810, Indonesia. <br>Website: dialisacare.com / Email: info@dialisacare.com <br>Phone: 0857 99 500 500</p>
            </td>
        </tr>
    </table>
    <hr style="border: 2px solid black; margin-bottom: -5px;">
    <hr style="border: 0.8px solid black; margin-bottom: 30px;">
    <div style="text-align: right;">Jakarta, <?= date('d F Y', strtotime($header[0]['tgl_input'])); ?></div>

    <table>
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td><?= $header[0]['no_inv']; ?></td>
        </tr>
        <tr>
            <td>Hal</td>
            <td>:</td>
            <td>Penagihan</td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td>:</td>
            <td><?= $header[0]['nama_perusahaan']; ?></td>
        </tr>
    </table>

    <p>
        Terima kasih atas kepercayaan <?= $header[0]['nama_perusahaan']; ?> untuk menjalin kerjasama dengan Klinik Dialisacare Pejaten dalam pelayanan medis para rekanan <?= $header[0]['nama_perusahaan']; ?>.
        <br>
        Bersama ini kami rincikan tagihan medis atas nama:
    </p>

    <table cellpadding="5" style="width: 100%; border-collapse: collapse;" border="1">
        <tr style="font-weight: bold;">
            <td style="width: 7%;">No.</td>
            <td>Tanggal</td>
            <td>No.Invoice</td>
            <td>Nama</td>
            <td>Total Biaya</td>
        </tr>
        <?php
        $no = 1;
        $grandTotal = 0;
        for ($i = 0; $i < count($detail); $i++) {
            $grandTotal += $detail[$i]['total'];
        ?>
            <tr>
                <td><?= $no++; ?>.</td>
                <td><?= date('d F Y', strtotime($detail[$i]['tgl_bayar'])); ?></td>
                <td><?= $detail[$i]['no_inv']; ?></td>
                <td><?= $detail[$i]['nm_pasien']; ?></td>
                <td>Rp. <?= number_format($detail[$i]['total']); ?></td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="4">Jumlah</td>
            <td><strong>Rp. <?= number_format($grandTotal); ?></strong></td>
        </tr>
    </table>

    <br>

    <table align="center" cellpadding="15" style="width: 80%; border-collapse: collapse;" border="1">
        <tr>
            <td>
                <center> Mohon Tagihan dapat ditransfer ke rekening:</center>
                PT. Medika Sejahtera Group <br>
                No. Rek : 1230012099141 <br>
                Cabang Salemba <br>
                Bank Mandiri
            </td>
        </tr>
    </table>

    <p>
        Mohon dicantumkan No.Invoice di Bukti Pembayaran dan di email ke : finance@dialisacare.com <br>
        Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih. <br><br>
        Hormat Kami, <br><br><br>
    </p>

    <p>
        <u>Lita Fitriyani S.Ak.</u><br>
        Finance Klinik Dialisacare Pejaten
    </p>

    <table style="width: 100%; font-size: 9pt;">
        <tr valign="top">
            <td style="width: 5%;">NB:</td>
            <td>
                Bilamana selama 7 (tujuh) hari setelah menerima invoice ini, kami tidak menerima tanggapan apapun, maka kami menganggap bahwa invoice ini telah disetujui.
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
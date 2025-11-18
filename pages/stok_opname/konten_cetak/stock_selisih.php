<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 9px;
    }

    h1 {
        text-align: center;
        font-size: 11px;
        margin-bottom: 10px;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        background: #f9f9f9;
    }

    .th,
    .td {
        border: 1px solid #bbb;
        padding: 6px 8px;
    }

    .th {
        background: #e3eafc;
        font-size: 9pt;
    }

    .tr:nth-child(even) {
        background: #f2f6fc;
    }
</style>

<?php
include __DIR__ . "/../../../koneksi.php";
extract($_GET);

if (isset($kd_wh)) {
    if (isset($tgl_segment)) {
        $tgl = $tgl_segment;
    } else {
        date_default_timezone_set("Asia/Jakarta");
        $tgl = date('Y-m-d');
    }

    $sql = "SELECT d.* FROM tbl_so_detail d INNER JOIN tbl_so_header h ON d.id_header = h.id_so WHERE 1=1 AND DATE(h.date_created) = '$tgl'";
    if ($kd_wh !== '') {
        $sql .= " AND h.kd_wh = '" . mysqli_real_escape_string($conn, $kd_wh) . "'";
    }
    if ($jenis !== '') {
        $sql .= " AND d.jenis = '" . mysqli_real_escape_string($conn, $jenis) . "'";
    }
    if ($instatus_so !== '') {
        $sql .= " AND d.status_so = '" . mysqli_real_escape_string($conn, $instatus_so) . "'";
    }
    if ($kode_obat !== '') {
        $sql .= " AND d.kode_obat = '" . mysqli_real_escape_string($conn, $kode_obat) . "'";
    }
    if ($nama_obat !== '') {
        $sql .= " AND d.nama_obat LIKE '%" . mysqli_real_escape_string($conn, $nama_obat) . "%'";
    }
    $result_data = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));

    $wh = mysqli_query($conn, "SELECT * FROM tbl_warehouse WHERE kd_wh = '$kd_wh'");
    $dataWH = mysqli_fetch_object($wh);
}
?>
<table style="width: 100%; border: none;" border="0">
    <tr>
        <td style="width: 50%; text-align: left;"><b><?= $_GET['nm_report']; ?> <?= $_GET['jenis']; ?></b> :
            <?= date('d F Y', strtotime($tgl)); ?></td>
        <td style="width: 50%; text-align: right;"><small>[<?= $_GET['nm_so']; ?>]</small>
            <b><?= $dataWH->nm_wh; ?></b>
        </td>
    </tr>
</table>
<table style="font-size:9px;">
    <tr class="tr" style="background-color: #1e3c72; color: #fff;">
        <th class="th" style="width: 3%;">No.</th>
        <th class="th" style="width: 7%;">Kd.Obat</th>
        <th class="th" style="width: 40%;">Nama Obat</th>
        <th class="th" style="width: 7%;">Jenis</th>
        <th class="th" style="width: 9%;">Satuan Besar</th>
        <th class="th" style="width: 9%;">Satuan Kecil</th>
        <th class="th" style="width: 6%;">St.Sistem</th>
        <th class="th" style="width: 6%;">St.Fisik</th>
        <th class="th" style="width: 6%;">Selisih</th>
        <th class="th" style="width: 7%;">Ket.</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result_data)) :
    ?>
        <tr class="tr">
            <td class="td" style="width: 3%;"><?= $no++; ?>.</td>
            <td class="td" style="width: 7%;"><?= $row['kode_obat']; ?></td>
            <td class="td" style="width: 40%;"><?= $row['nama_obat']; ?></td>
            <td class="td" style="width: 7%;"><?= $row['jenis']; ?></td>
            <td class="td" style="width: 9%;"><?= $row['satuan_besar']; ?></td>
            <td class="td" style="width: 9%;"><?= $row['satuan_terkecil']; ?></td>
            <td class="td" style="width: 6%;"><?= $row['stock_sistem']; ?></td>
            <td class="td" style="width: 6%;"><?= $row['stock_fisik']; ?></td>
            <td class="td" style="width: 6%;"><?= $row['selisih']; ?></td>
            <td class="td" style="width: 7%;"><?= $row['keterangan']; ?></td>
        </tr>
    <?php
    endwhile;
    ?>

</table>
<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=pendapatan-fisioterapi.xls");
?>

<table border="1" style="border-collapse: collapse;">
    <tr>
        <th style="width:68px">NO</th>
        <th style="width:111px">TGL</th>
        <th style="width:115px">NO.DAFTAR</th>
        <th style="width: 300px;">NAMA</th>
        <th style="width: 350px;">TINDAKAN</th>
        <th style="width: 215px;">JAMINAN</th>
        <th style="width: 140px;">MESSAGE</th>
        <th style="width:197px">TOTAL PEMBAYARAN</th>
    </tr>
    <?php
    include "../../3rdparty/engine.php";
    ini_set("display_errors", 0);
    $t1 = explode("/", $_GET['d1']);
    $t2 = explode("/", $_GET['d2']);
    //Nilai Tutup Pendapatan Harian
    $tutup_waktu = $db->queryItem("select nilai from tbl_config where kode='CLOSED'");
    $date1 = $t1[2] . '-' . $t1[0] . '-' . $t1[1] . ' ' . $tutup_waktu;
    //$date2 = $t2[2].'-'.$t2[0].'-'.$t2[1];
    $date2 = date("Y-m-d", mktime(0, 0, 0, $t2[0], $t2[1] + 1, $t2[2])) . ' ' . $tutup_waktu;

    //$data = $db->query("select * from tbl_fisio where tgl_insert >= '$date1' and tgl_insert < '$date2' and status_delete='UD'", 0);
    if ($_GET['metode'] == 'ALL') {
        $data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran, b.kode_perusahaan as kodeNya from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' order by c.nama_perusahaan", 0);
    } elseif ($_GET['metode'] == 'CASH') {
        $data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran , b.kode_perusahaan as kodeNya from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.metode_payment='CASH' order by c.nama_perusahaan", 0);
    } elseif ($_GET['metode'] == 'ASS') {
        $data = $db->query("select a.*, c.nama_perusahaan, b.metode_payment as metode_pembayaran, b.kode_perusahaan as kodeNya from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar left join tbl_pendaftaran c on c.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.metode_payment='ASS' order by c.nama_perusahaan", 0);
    }
    $dokter = $db->query("select * from tbl_dokter where kode_dokter='" . $_GET['dokter'] . "'");
    for ($i = 0; $i < count($data); $i++) {
        $no = $i + 1;
        $pasien = $db->query("select * from tbl_pasien where nomr='" . $data[$i]['nomr'] . "'");
        //$data[$i]['nama_perusahaan'] = $db->queryItem("select nama_perusahaan from tbl_pendaftaran where nomr='".$data[$i]['nomr']."'");
        $plusBiaya = $db->queryItem("select c.tarif from tbl_pendaftaran a left join tbl_pasien b on b.nomr=a.nomr left join tbl_poli c on c.kd_poli=a.kd_poli where a.no_daftar='" . $data[$i]['no_daftar'] . "' and a.status_delete='UD' and b.status_delete='UD' and c.status_delete='UD'", 0);
        $data[$i]['total'] = $data[$i]['total'] + $plusBiaya;
        $data[$i]['nofr'] = $db->queryItem("select nofr from tbl_kasir where no_daftar='" . $data[$i]['no_daftar'] . "'");
        $data[$i]['rehabmedik'] = $tindakanFisio = $db->queryItem("select nama_tindakan from tbl_fisio_detail where fisioID='" . $data[$i]['id'] . "'and status_delete='UD'");
        //$data[$i]['nebulizer'] = $db->queryItem("select sum(tarif) from tbl_fisio_detail where fisioID='".$data[$i]['id']."' and nama_tindakan='INHALASI' and status_delete='UD'");
        //$data[$i]['message'] = $db->queryItem("select sum(tarif) from tbl_fisio_detail where fisioID='".$data[$i]['id']."' and nama_tindakan='MASSAGE' and status_delete='UD'");
    ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input_fisio'])) ?></td>
            <td><?php echo $data[$i]['no_daftar'] ?></td>
            <td><?php echo $pasien[0]['nm_pasien'] ?></td>
            <td><?php echo $tindakanFisio ?></td>
            <td><?php echo $data[$i]['nama_perusahaan'] ?></td>
            <td style="text-align: right;"><?php echo $data[$i]['nama_tindakan']; ?></td>

            <td style="text-align: right;"><?php echo $data[$i]['total_harga_fisio']; ?></td>
        </tr>
    <?php
        $ttlr = $ttlr + $data[$i]['rehabmedik'];
        $ttln = $ttln + $data[$i]['nebulizer'];
        $ttlm = $ttlm + $data[$i]['message'];
        $ttlSum = $ttlSum + $data[$i]['total_harga_fisio'];
    }
    if ($ttlSum > 0) {
        $totJasa = $ttlSum + $biayaJaga;
        $pajak = $totJasa * 50 / 100;

        $cash = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and (b.kode_perusahaan='PPP031' or b.kode_perusahaan='')", 0);
        $asuransi = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan <> 'PPP031' and b.kode_perusahaan <> 'JJJ030' and b.kode_perusahaan != ''", 0);
        $jamsostek = $db->queryItem("select count(a.id) from tbl_fisio a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.tgl_insert >= '$date1' and a.tgl_insert < '$date2' and a.status_delete='UD' and b.kode_perusahaan='JJJ030'", 0);
    ?>
        <tr>
            <th colspan="7" style="text-align: right; font-weight: bold">
                GRAND TOTAL
            </th>
            <th style="text-align: right; font-weight: bold">
                <?php echo $ttlSum; ?>
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: right; font-weight: bold">
                JUMLAH PASIEN CASH
            </th>
            <th style="text-align: right; font-weight: bold">
                <?php echo $cash; ?>
            </th>
        </tr>
        <tr>
            <th colspan="7" style="text-align: right; font-weight: bold">
                JUMLAH PASIEN ASURANSI
            </th>
            <th style="text-align: right; font-weight: bold">
                <?php echo $asuransi; ?>
            </th>
        </tr>
    <?php
    }
    ?>
</table>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Print Permintaan Obat</title>
    <link href="../../style.css" rel="stylesheet" media="all" />
</head>

<body>
    <?php

    ini_set("display_errors", 0);
    include "../../3rdparty/engine.php";
    $noRO = $db->query("select no_ro_gudang, tgl_input_ro_gudang from tbl_ro_to_gudang where no_ro_gudang='" . $_POST['id'] . "'");

    $now = $ro[0]['tgl_input_ro'];
    $bln1 = date('F', strtotime($tgl . ' - 1 month'));
    $bln2 = date('F', strtotime($tgl . ' - 2 month'));
    $bln3 = date('F', strtotime($tgl . ' - 3 month'));
    ?>

    <div>
        <p style="margin-left: 12px; margin-top: 2px; margin-bottom: 5px;">
            Nomor RO : <?php echo $noRO[0]['no_ro_gudang'] ?><br />
            Tanggal Input : <?php echo date("d-F-Y", strtotime($noRO[0]['tgl_input_ro_gudang'])) ?><br />
        </p>
    </div>
    <div>
        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
            <thead>
                <tr>
                    <th style="text-align: center" rowspan="2">No</th>
                    <th style="text-align: center" rowspan="2">Nama Obat</th>
                    <th style="text-align: center" colspan="2">Unit</th>
                    <th style="text-align: center" colspan="3">Bulan</th>
                    <th style="text-align: center" rowspan="2">Saldo<br />Akhir</th>
                    <th style="text-align: center" rowspan="2">Rata2</th>
                    <th style="text-align: center" rowspan="2">Jumlah<br />Pesanan</th>
                    <th style="text-align: center" rowspan="2">Harga<br />Obat</th>
                </tr>
                <tr>
                    <th>Peminta</th>
                    <th>Diminta</th>
                    <th style="text-align: center"><?php echo $bln3 ?></th>
                    <th style="text-align: center"><?php echo $bln2 ?></th>
                    <th style="text-align: center"><?php echo $bln1 ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totgigi = 0;
                $adm = $db->query("select a.*, d.unit as unitPeminta, d.unit_diminta as unitDiminta from tbl_ro_to_gudang_detail a LEFT JOIN tbl_ro_to_gudang d ON a.no_ro_gudang=d.no_ro_gudang where a.no_ro_gudang='" . $noRO[0]['no_ro_gudang'] . "' and a.status_delete='UD'");
                for ($i = 0; $i < count($adm); $i++) {
                    $no = $i + 1;
                    $total = $adm[$i]['qty'] * $adm[$i]['harga'];
                ?>
                    <tr>
                        <td style="width: 15px; text-align: right"><?php echo $no ?></td>
                        <td style="text-align: left"><?php echo $adm[$i]['nama_obat'] ?></td>
                        <td><?= $adm[$i]['unitPeminta']; ?></td>
                        <td><?= $adm[$i]['unitDiminta']; ?></td>
                        <td style="text-align: right"><?php echo number_format($adm[$i]['bln3']) ?></td>
                        <td style="text-align: right"><?php echo number_format($adm[$i]['bln2']) ?></td>
                        <td style="text-align: right"><?php echo number_format($adm[$i]['bln1']) ?></td>
                        <td style="text-align: right"><?php echo number_format($adm[$i]['stok_akhir']) ?></td>
                        <td style="text-align: right"><?php echo number_format($adm[$i]['rata']) ?></td>
                        <td style="text-align: right; cursor: pointer;" title="Ganti/Update Jumlah Pesanan">
			      <div id="harga<?php echo $adm[$i]['id']?>">
                                <?php echo '<a href="#" onclick="UpdateQTY(\''.$adm[$i]['id'].'\')">'.number_format($adm[$i]['qty']).'</a>' ?>
			      </div>
			      <label id="keterangan<?php echo $adm[$i]['id']?>" style="font-size: 8px; color: red;"></label>
                        </td>
                        <td style="text-align: right">
                            <?php echo $adm[$i]['harga'] ?>
                        </td>
                    </tr>
                <?php
                    $total1 = $total1 + $adm[$i]['qty'];
                    $total2 = $total2 + $adm[$i]['harga'];
                    $total3 = $total3 + $total;
                }
                ?>
            </tbody>
        </table>
        <p align="left" style="margin-left: 5px; font-weight: bold"><?php echo $namaDokter ?></p>
    </div>
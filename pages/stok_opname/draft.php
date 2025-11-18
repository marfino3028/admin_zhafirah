<?php
include __DIR__ . "/../../koneksi.php";
$sql_wh = "SELECT * FROM tbl_warehouse WHERE status_freeze = 1 AND aktif = 1 ORDER BY nm_wh ASC";
$result_wh = mysqli_query($conn, $sql_wh);

$sql_barang = "SELECT jenis FROM tbl_obat GROUP BY jenis ORDER BY jenis ASC";
$result_barang = mysqli_query($conn, $sql_barang);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title" style="font-weight: bold; font-size: 10pt;">Stock Opname Draft</h4>
    </div>
    <div class="panel-body" style="background-color: #ecf1f6ff;">

        <!-- Filter Form -->
        <form style="margin-bottom:15px;" onsubmit="btnSimpan.disabled = true; return true;"
            action="pages/stok_opname/model/cari_so_draf.php" method="POST">
            <div class="row">
                <div class="col-md-2">
                    <label>Gudang</label>
                    <select name="kd_wh" id="kd_wh" required class="form-control input-sm">
                        <option value="">- Pilih Gudang -</option>
                        <?php while ($row = mysqli_fetch_assoc($result_wh)): ?>
                            <option value="<?= $row['kd_wh']; ?>"><?= $row['nm_wh']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Kategori Barang</label>
                    <select name="jenis" id="jenis" class="form-control input-sm">
                        <option value="">- Pilih Kategori -</option>
                        <?php while ($row = mysqli_fetch_assoc($result_barang)): ?>
                            <option value="<?= $row['jenis']; ?>"><?= $row['jenis']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Status Opname</label>
                    <select id="instatus_so" name="instatus_so" class="form-control input-sm">
                        <option value="">- Pilih Status -</option>
                        <option value="1">Open</option>
                        <option value="2">Draft</option>
                        <option value="3">Final</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_obat" id="kode_obat" autocomplete="off" class="form-control input-sm"
                        placeholder="CODE">
                </div>
                <div class="col-md-2">
                    <label>Nama Barang</label>
                    <input type="text" class="form-control input-sm" id="nama_obat" autocomplete="off" name="nama_obat"
                        placeholder="Contoh : Paracetamol">
                </div>
                <div class="col-md-2">
                    <label>Jenis Barang</label>
                    <select class="form-control input-sm">
                        <option value="">- Pilih Jenis -</option>
                    </select>
                </div>
            </div>

            <br>

            <button type="submit" id="btnSimpan" class="btn btn-success btn-xs btn-3d"><i
                    class="fa fa-fw fa-search"></i> VIEW</button>
            <button type="button" onclick="stockSelisih()" class="btn btn-default btn-xs btn-3d"><i
                    class="fa fa-fw fa-print"></i> PRINT SELISIH STOCK</button>
            <button type="button" onclick="stockCount()" class="btn btn-default btn-xs btn-3d"><i
                    class="fa fa-fw fa-print"></i>PRINT STOCK COUNT</button>
            <button disabled class="btn btn-default btn-xs btn-3d"><i class="fa fa-fw fa-print"></i> PRINT PERGERAKAN
                LEBIH DARI
                0</button>

        </form>

    </div>
</div>

<div class="panel panel-default" style="margin-top: -10px; padding: 0px;">
    <div class="panel-body" style="background-color: #ecf1f6ff;">

        <form onsubmit="btnSimpan.disabled = true; return true;" action="pages/stok_opname/model/update_so.php"
            method="POST">
            <input type="text" name="kodeWareHouse" hidden value="<?= @$kd_wh; ?>" required>
            <div class="table-responsive" style="background-color: white;">
                <table class="table table-bordered table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th style="width: 3%; text-align: center; display: none;">#</th>
                            <th>Status</th>
                            <th style="width: 7%;">ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th style="width: 9%;">Stock Sistem</th>
                            <th style="width: 9%;">Stock Fisik</th>
                            <th style="width: 9%;">Selisih</th>
                            <th style="width: 9%;">Adjusment</th>
                            <th style="width: 9%;">Stok Akhir</th>
                            <th style="width: 9%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        extract($_GET);

                        if (isset($kd_wh)) {
                            date_default_timezone_set("Asia/Jakarta");
                            $tgl = date('Y-m-d');

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

                            while ($row = mysqli_fetch_assoc($result_data)) : ?>
                                <tr>
                                    <td style="text-align: center; display:none;">
                                        <input type="checkbox" value="<?= $row['id_detail']; ?>" name="id_detail[]"
                                            id="check_id_<?= $row['id_detail']; ?>">
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['status_so'] == 1) {
                                            $readonly = "";
                                            echo '<span class="badge badge-info"><small>Open</small></span>';
                                        } else if ($row['status_so'] == 2) {
                                            $readonly = "";
                                            echo '<span class="badge badge-success"><small>Draft</small></span>';
                                        } else if ($row['status_so'] == 3) {
                                            $readonly = "readonly";
                                            echo '<span class="badge badge-primary"><small>Final</small></span>';
                                        } else {
                                            $readonly = "";
                                            echo '<span class="badge"><small>-</small></span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <input type="text" hidden name="kode_obat[<?= $row['id_detail']; ?>]"
                                            value="<?= $row['kode_obat']; ?>">
                                        <?= htmlspecialchars($row['kode_obat']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($row['nama_obat']) ?></td>
                                    <td><?= htmlspecialchars($row['satuan_terkecil']) ?></td>
                                    <td><?= htmlspecialchars($row['jenis']) ?></td>
                                    <td>
                                        <span id="stok_sistem_<?= $row['id_detail']; ?>">
                                            <?= htmlspecialchars($row['stock_sistem']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" <?= $readonly; ?>
                                            name="stock_fisik[<?= $row['id_detail']; ?>]" value="<?= $row['stock_fisik']; ?>"
                                            class="input_" data-id="<?= $row['id_detail']; ?>"
                                            id="inp_fisik_<?= $row['id_detail']; ?>" onkeyup="keyFisik(this)">
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" <?= $readonly; ?>
                                            name="selisih[<?= $row['id_detail']; ?>]" value="<?= $row['selisih']; ?>"
                                            class="input_" id="inp_selisih_<?= $row['id_detail']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" <?= $readonly; ?>
                                            name="adjusment[<?= $row['id_detail']; ?>]" value="<?= $row['adjusment']; ?>"
                                            class="input_" id="inp_adjusment_<?= $row['id_detail']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" <?= $readonly; ?>
                                            name="stock_akhir[<?= $row['id_detail']; ?>]" value="<?= $row['stock_akhir']; ?>"
                                            class="input_" id="inp_akhir_<?= $row['id_detail']; ?>">
                                    </td>
                                    <td>
                                        <input type="text" autocomplete="off" <?= $readonly; ?>
                                            name="keterangan[<?= $row['id_detail']; ?>]" value="<?= $row['keterangan']; ?>"
                                            class="input_">
                                        <input type="text" hidden value="<?= $row['status_so']; ?>"
                                            id="status_so_<?= $row['id_detail']; ?>"
                                            name="status_so[<?= $row['id_detail']; ?>]">
                                    </td>
                                </tr>
                        <?php endwhile;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <br>

            <button type="submit" id="btnSimpan" class="btn btn-primary btn-xs btn-3d"><i class="fa fa-fw fa-save"></i>
                SIMPAN DRAF</button>
            <button disabled class="btn btn-default btn-xs btn-3d"><i class="fa fa-fw fa-refresh"></i> NOLKAN STOK
                FISIK</button>
            <button disabled class="btn btn-default btn-xs btn-3d"><i class="fa fa-fw fa-refresh"></i> SAMAKAN
                STOK</button>

        </form>
    </div>
</div>

<script>
    var kd_wh = "<?= @$kd_wh; ?>";
    var jenis = "<?= @$jenis; ?>";
    var instatus_so = "<?= @$instatus_so; ?>";
    var kode_obat = "<?= @$kode_obat; ?>";
    var nama_obat = "<?= @$nama_obat; ?>";
    $("#kd_wh").val(kd_wh)
    $("#jenis").val(jenis)
    $("#instatus_so").val(instatus_so)
    $("#kode_obat").val(kode_obat)
    $("#nama_obat").val(nama_obat)

    function keyFisik(e) {
        var id_detail = e.getAttribute("data-id");
        var stok_sistem = document.getElementById("stok_sistem_" + id_detail).innerHTML;
        var stock_fisik = $("#inp_fisik_" + id_detail).val();
        var check_id = document.getElementById("check_id_" + id_detail);
        if (stock_fisik.length > 0) {
            check_id.checked = true;
            var hasil_selisih = stock_fisik - stok_sistem;
            $("#status_so_" + id_detail).val(2)
        } else {
            check_id.checked = false;
            var hasil_selisih = '';
            $("#status_so_" + id_detail).val(1)
        }

        $("#inp_selisih_" + id_detail).val(hasil_selisih);
        $("#inp_adjusment_" + id_detail).val(hasil_selisih);
        $("#inp_akhir_" + id_detail).val(stock_fisik);
    }

    function stockCount() {
        var kd_wh = "<?= @$_GET['kd_wh']; ?>";
        var jenis = "<?= @$_GET['jenis']; ?>";
        var instatus_so = "<?= @$_GET['instatus_so']; ?>";
        var kode_obat = "<?= @$_GET['kode_obat']; ?>";
        var nama_obat = "<?= @$_GET['nama_obat']; ?>";
        var nm_report = "Stock Count";
        var nm_so = "Draft";

        if (!kd_wh) {
            alert('Tidak ada data gudang!');
            return;
        }

        window.open(
            "pages/stok_opname/print_stock_count.php?kd_wh=" + kd_wh +
            "&jenis=" + jenis +
            "&instatus_so=" + instatus_so +
            "&kode_obat=" + kode_obat +
            "&nama_obat=" + nama_obat +
            "&nm_report=" + nm_report +
            "&nm_so=" + nm_so,
            "_blank"
        );
    }

    function stockSelisih() {
        var kd_wh = "<?= @$_GET['kd_wh']; ?>";
        var jenis = "<?= @$_GET['jenis']; ?>";
        var instatus_so = "<?= @$_GET['instatus_so']; ?>";
        var kode_obat = "<?= @$_GET['kode_obat']; ?>";
        var nama_obat = "<?= @$_GET['nama_obat']; ?>";
        var nm_report = "Stock Selisih";
        var nm_so = "Draft";

        if (!kd_wh) {
            alert('Tidak ada data gudang!');
            return;
        }

        window.open(
            "pages/stok_opname/print_stock_selisih.php?kd_wh=" + kd_wh +
            "&jenis=" + jenis +
            "&instatus_so=" + instatus_so +
            "&kode_obat=" + kode_obat +
            "&nama_obat=" + nama_obat +
            "&nm_report=" + nm_report +
            "&nm_so=" + nm_so,
            "_blank"
        );
    }
</script>
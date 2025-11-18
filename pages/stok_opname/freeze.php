<?php
include __DIR__ . "/../../koneksi.php";
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title" style="font-weight: bold; font-size: 10pt;">Stok Freeze</h4>
    </div>
    <div class="panel-body">

        <div class="alert alert-info" style="border-radius: 5px;">
            <span class="fa fa-fw fa-refresh" aria-hidden="true"></span>
            <strong> INFORMASI </strong><br>
            Untuk mengunci gudang, klik pada checkbox...
        </div>

        <?php
        $sql_wh = "SELECT * FROM tbl_warehouse WHERE aktif = 1 ORDER BY nm_wh ASC";
        $result_wh = mysqli_query($conn, $sql_wh);
        ?>

        <form onsubmit="btnSimpan.disabled = true; return true;"
            action="pages/stok_opname/model/update_status_freeze.php" method="POST">

            <div class="row">
                <?php $i = 0; ?>
                <?php while ($row = mysqli_fetch_assoc($result_wh)): ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="checklist-box" style="border-radius: 5px;">
                            <span><?= $row['nm_wh']; ?></span>
                            <?php $ceklist = $row['status_freeze'] == 1 ? "checked" : ""; ?>

                            <input type="hidden" name="kd[<?= $i ?>]" value="<?= $row['kd_wh']; ?>">
                            <input type="checkbox" style="cursor: pointer;" <?= $ceklist; ?> name="ceklist[<?= $i ?>]"
                                value="1">
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </div>

            <button id="btnSimpan" type="submit" class="btn btn-primary btn-xs btn-3d"><i class="fa fa-fw fa-save"></i>
                SIMPAN</button>
        </form>
    </div>
</div>
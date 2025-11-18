<?php
//$data = $db->query("select * from tbl_pasien where nomr='".$_GET['id']."'");
$today = date("Y-m-d");
$data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, alamat_pasien, telp_pasien, id from tbl_pasien where status_delete='UD' and nomr='" . $_GET['id'] . "'", 0);
$fisio = $db->query("select * from tbl_fisio where id='" . $_GET['fisio'] . "' order by tgl_input_fisio desc");
?>

<div class="box box-bordered box-color">
    <div class="box-title">
        <h3>
            <i class="fa fa-th-list"></i>SOAP- Fisio untuk Pasien [<?php echo $_GET['id'] . ' - ' . $data[0]['nm_pasien'] ?>]
        </h3>
    </div>
    <div class="box-content nopadding" style="overflow: auto;">
        <div class="col-sm-7">
            <form action="pages/penunjang_medis/simpan_soap_fisio.php" method="POST" class='form-horizontal form-bordered' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>SUBJECTIVE</strong></label>
                </div>
                <div class="form-group">
                    <textarea name="subject" rows="7" class="form-control"><?= $fisio[0]['subject']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>OBJECTIVE</strong></label>
                </div>
                <div class="form-group">
                    <textarea name="object" rows="7" class="form-control"><?= $fisio[0]['object']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>ASSESMENT</strong></label>
                </div>
                <div class="form-group">
                    <textarea name="assesment" rows="7" class="form-control"><?= $fisio[0]['assesment']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="textfield" class="control-label col-sm-12" style="text-align: left;"><strong>PLANNING</strong></label>
                </div>
                <div class="form-group">
                    <textarea name="planning" rows="7" class="form-control"><?= $fisio[0]['planning']; ?></textarea>
                </div>

                <div class="form-actions col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="id" value="<?= $fisio[0]['id']; ?>">
                    <button type="submit" class="btn btn-primary">Save Data</button>
                    <button type="button" class="btn" onclick="return window.location = 'index.php?mod=penunjang_medis&submod=fisiotherapiInput'">Cancel</button>
                </div>
            </form>
        </div>
        <div class="col-sm-5">
            <p style="font-size: 20px; margin-top: 10px;">Detail Pasien</p>
            <div>
                <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped nomargin">
                    <thead>
                        <th colspan="2" class="text-center">Detail Pasien</th>

                    </thead>
                    <tr>
                        <td style="width:140px">Nama Pasien</td>
                        <td><?php echo $data[0]['nm_pasien'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:140px">Jenis Kelamin</td>
                        <td><?php echo $data[0]['jk'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:140px">Umur</td>
                        <td><?php echo $data[0]['umur'] ?> Thn</td>
                    </tr>
                    <tr>
                        <td style="width:140px">Alamat</td>
                        <td><?php echo $data[0]['alamat_pasien'] ?></td>
                    </tr>
                    <tr>
                        <td style="width:140px">No. Telp</td>
                        <td><?php echo $data[0]['telp_pasien'] ?></td>
                    </tr>
                </table>
                <div class="col-sm-8">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
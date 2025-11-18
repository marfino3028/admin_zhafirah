<div>
  <div class="breadcrumbs">
    <ul>
      <li>
        <a href="javascript:void(0)">Data Master</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="javascript:void(0)">Pasien</a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="box">
        <div class="box-title">
          <h3>
            <i class="fa fa-user"></i>
            Pencarian Pasien
          </h3>
          <a href="index.php?mod=master&submod=pasien_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Pasien Baru</a>
          <a href="index.php?mod=master&submod=pasien_mutasi" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Mutasi Pasien</a>
        </div>
        <div class="box-content">
          <form action="index.php?mod=master&submod=pasien" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
            <div class="row">
              <div class="form-group">
                <div class="col-sm-1">&nbsp;</div>
                <div class="col-sm-2">
                  <label for="textfield" class="control-label">Tanggal Lahir</label>
                  <input type="date" id="tgl_lahir" name="tgl_lahir" placeholder="Group" class="form-control" value="<?php echo $_POST['tgl_lahir'] ?>" />
                </div>
                <div class="col-sm-2">
                  <label for="textfield" class="control-label">No. MR</label>
                  <input type="text" id="nomr" name="nomr" placeholder="No. MR" class="form-control" value="<?php echo $_POST['nomr'] ?>" />
                </div>
                <div class="col-sm-2">
                  <label for="textfield" class="control-label">Nama</label>
                  <input type="text" id="nama" name="nama" placeholder="Nama" class="form-control" value="<?php echo $_POST['nama'] ?>" />
                </div>
                <div class="col-sm-3">
                  <label for="textfield" class="control-label">Alamat</label>
                  <input type="text" id="alamat" name="alamat" placeholder="Alamat" class="form-control" value="<?php echo $_POST['alamat'] ?>" />
                </div>
                <div class="form-actions col-sm-1" style="margin-top: 40px;">
                  <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Cari..." />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php
      $data = $db->query("select * from tbl_pasien_mutasi where status_mutasi='BLM' order by id", 0);
      if (count($data) > 0) {
      ?>

        <p style="margin-left: 5%; margin-top: 10px; font-size: 20px; font-weight: bold;">Daftar Pasien Mutasi (Belum Confirm)</p>
        <table id="table-data-draft" class="table table-hover table-bordered table-striped table-condensed" style="margin-left: 3%; margin-bottom: 20px;; width: 94%;">
          <thead>
            <tr>
              <th style="width:40px">No</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Klinik</th>
              <th>Klinik (Mutasi)</th>
              <th>Type Pasien</th>
              <th>Type Pasien (Mutasi)</th>
              <th style="width:70px">&nbsp;</th>
              <th style="width:70px">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < count($data); $i++) {
            ?>
              <tr>
                <td><?php echo $i + 1 ?></td>
                <td><?php echo $data[$i]['nomr'] . ' - ' . $data[$i]['nm_pasien'] ?></td>
                <td><?php echo $data[$i]['alamat_pasien'] ?></td>
                <td><?php echo $data[$i]['rujukan'] ?></td>
                <td><?php echo $data[$i]['rujukan_mutasi'] ?></td>
                <td><?php echo $data[$i]['type_pasien'] ?></td>
                <td><?php echo $data[$i]['type_pasian_mutasi'] ?></td>
                <td style="text-align: center; cursor: pointer;" title="Konfirm Pasien Mutasi Agar terupdate" onclick="konfirmasiPerusahaan('<?php echo md5($data[$i]['id']) ?>')">confirm?</td>
                <td class="text-center">DRAFT</td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php
      }
      ?>

      <div class="box">
        <div class="box-title">
          <h3 style="padding-right: 50px;">
            <i class="fa fa-table"></i> Hasil Pencarian Pasien
          </h3>
        </div>
        <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">

          <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
            <thead>
              <tr>
                <th style="width:40px">No</th>
                <th>NoMR</th>
                <th>Nama Pasien</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Option</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $today = date("Y-m-d");
              if ($_POST['nama'] != "" and $_POST['alamat'] != "") {
                $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, id, alamat_pasien from tbl_pasien where status_delete='UD' and nomr='" . $_POST['nomr'] . "' or tgl_lahir='" . $_POST['tgl_lahir'] . "' or nm_pasien like '%" . $_POST['nama'] . "%' or alamat_pasien like '%" . $_POST['alamat'] . "%'", 0);
              } elseif ($_POST['nama'] != "" and $_POST['alamat'] == "") {
                $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, id, alamat_pasien from tbl_pasien where status_delete='UD' and nomr='" . $_POST['nomr'] . "' or tgl_lahir='" . $_POST['tgl_lahir'] . "' or nm_pasien like '%" . $_POST['nama'] . "%'", 0);
              } elseif ($_POST['nama'] == "" and $_POST['alamat'] != "") {
                $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, id, alamat_pasien from tbl_pasien where status_delete='UD' and nomr='" . $_POST['nomr'] . "' or tgl_lahir='" . $_POST['tgl_lahir'] . "' or alamat_pasien like '%" . $_POST['alamat'] . "%'", 0);
              } else {
                $data = $db->query("select nomr, nm_pasien, round(DATEDIFF('$today', tgl_lahir) /  365) umur, tgl_lahir, jk, id, alamat_pasien from tbl_pasien where status_delete='UD' and nomr='" . $_POST['nomr'] . "' or tgl_lahir='" . $_POST['tgl_lahir'] . "'", 0);
              }
              for ($i = 0; $i < count($data); $i++) {
              ?>
                <tr>
                  <td><?php echo $i + 1 ?></td>
                  <td><a href="index.php?mod=pendaftaran&submod=daftar&id=<?php echo md5($data[$i]['nomr']) ?>"><?php echo $data[$i]['nomr'] ?></a></td>
                  <td><a href="index.php?mod=pendaftaran&submod=daftar&id=<?php echo md5($data[$i]['nomr']) ?>"><?php echo $data[$i]['nm_pasien'] ?></a></td>
                  <td><?php echo $data[$i]['tgl_lahir'] ?></td>
                  <td><?php echo $data[$i]['umur'] ?> thn</td>
                  <td><?php echo $data[$i]['alamat_pasien'] ?></td>
                  <td class="text-center">
                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=pasien_edit&id=<?php echo md5($data[$i]['id']) ?>">
                      <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/pasien_delete.php?id=<?php echo $data[$i]['id'] ?>';">
                      <span class="ui-icon ui-icon-circle-close"></span>
                    </a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script language="javascript">
  function konfirmasiPerusahaan(id) {
    if (confirm("Apakah Anda yakin akan meng-konfirmasi Mutasi Pasien ini?") == true) {
      window.location = "pages/master/pasien_confirm.php?id=" + id;
    }
  }
</script>

<script>
  $('#table-data').DataTable({
    responsive: true,
    columnDefs: [{
      targets: [0],
      orderable: false
    }]
  })
</script>
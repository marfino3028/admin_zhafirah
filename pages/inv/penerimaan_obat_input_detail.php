<?php
$data = $db->query("select * from tbl_penerimaan where md5(id)='" . $_GET['id'] . "'");
?>
<div>
  <div class="breadcrumbs">
    <ul>
      <li>
        <a href="javascript:void(0)">Warehouse</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="javascript:void(0)">
          Input Penerimaan Obat
        </a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="javascript:void(0)">Tambah Data</a>
        <i class="fa fa-angle-right"></i>
      </li>
      <li>
        <a href="javascript:void(0)">Data Detail Penerimaan</a>
      </li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="box">
      <div class="box-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="box box-color box-bordered box-small blue">
              <div class="box-title">
                <h3>
                  <i class="fa fa-edit"></i>
                  Form Tambah Data Detail Penerimaan Obat
                </h3>
              </div>
              <div class="box-content nopadding">
                <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">No. Terima</label>
                        <div class="col-sm-8">
                          <?php echo $data[0]['no_penerimaan'] ?>
                          <input type="hidden" id="no_penerimaan" name="no_penerimaan" value="<?php echo $data[0]['no_penerimaan'] ?>" />
                          <input type="hidden" id="penerimaan_id" name="penerimaan_id" value="<?php echo $data[0]['id'] ?>" />
                          <input type="hidden" id="jenis_barang" name="jenis_barang" value="<?php echo $data[0]['jenis_barang'] ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">No. Faktur </label>
                        <div class="col-sm-8">
                          <?php echo $data[0]['no_faktur'] ?>
                          <input type="hidden" id="no_faktur" name="no_faktur" value="<?php echo $data[0]['no_faktur'] ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">Tanggal Faktur</label>
                        <div class="col-sm-8">
                          <?php echo $data[0]['tgl_faktur'] ?>
                          <input type="hidden" id="tgl_faktur" name="tgl_faktur" value="<?php echo $data[0]['tgl_faktur'] ?>" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">Vendor </label>
                        <div class="col-sm-8">
                          <?= preg_replace('/[^A-Za-z0-9 ]/', '', $data[0]['nama_vendor']) ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">Supplier </label>
                        <div class="col-sm-8">
                          <?= preg_replace('/[^A-Za-z0-9 ]/', '', $data[0]['nama_supplier']) ?>
                        </div>
                      </div>
                      <?php
                      $sql = '';
                      if ($data[0]['jenis_barang'] == 'obat') {
                        $sql = "select kode_obat as code, nama_obat as name from tbl_obat where status_delete='UD' order by nama_obat";
                      } else {
                        $sql = "select kode as code, nama as name from tbl_logistik where status_delete='UD' order by nama";
                      }
                      $items = $db->query($sql);
                      ?>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">Obat/ Logistik </label>
                        <div class="col-sm-8">
                          <select id="code" class="form-control" name="code">
                            <option value="">--Pilih Obat/ Logistik--</option>
                            <?php
                            foreach ($items as $item) {
                              echo '<option value="' . $item['code'] . '"> &nbsp; &nbsp; &nbsp;' . $item['name'] . '</option>';
                            }
                            ?>
                          </select>
                          <input type="hidden" name="name" id="name">
                          <!-- <input type="text" id="obat" name="obat" onchange="TampilHarga(this.value)" style="width: 100%;" required="required"> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="qty" class="control-label col-sm-4">Qty</label>
                        <div class="col-sm-8">
                          <input type="number" name="qty" class="form-control" id="qty" size="5" style="text-align: right" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="harga_beli" class="control-label col-sm-4">Harga Beli</label>
                        <div class="col-sm-8">
                          <input type="number" name="harga_beli" class="form-control" id="harga_beli" size="12" style="text-align: right" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="textfield" class="control-label col-sm-4">Harga Jual</label>
                        <div class="col-sm-8">
                          <input type="number" name="harga_jual" class="form-control" id="harga_jual" size="12" style="text-align: right" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="harga_beli" class="control-label col-sm-4">Exipre Date</label>
                        <div class="col-sm-8">
                          <input type="date" name="expired" class="form-control" id="expired" size="5" value="<?php echo date("Y-m-d")?>" />
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8">
                      <div id="data_pasien">
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                          <thead>
                            <tr>
                              <th style="width:20px">No</th>
                              <th>Description</th>
                              <th style="width:40px">QTY</th>
                              <th style="width:80px">Harga Beli</th>
                              <th style="width:80px">Harga Jual</th>
                              <th style="width:40px">Expired Date</th>
                              <th style="width:30px">OPT</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $data = $db->query("select * from tbl_penerimaan_detail where status_delete='UD' and no_penerimaan='" . $data[0]['no_penerimaan'] . "'", 0);
                            for ($i = 0; $i < count($data); $i++) {
                              $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='" . $data[$i]['kode_tarif'] . "'");
                              echo "
                              <tr>
                                <td>" . ($i + 1) . "</td>
                                <td>" . $data[$i]['nama_obat'] . ' - ' . $data[$i]['kode_obat'] . "</td>
                                <td align='right'>" . number_format($data[$i]['qty']) . "</td>
                                <td align='right'>" . number_format($data[$i]['harga_beli']) . "</td>
                                <td align='right'>" . number_format($data[$i]['harga_jual']) . "</td>
                                <td align='right'>" . date("d M Y", strtotime($data[$i]['expired_date'])) . "</td>
                                <td align='center'>
                                  <a href='pages/inv/penerimaan_obat_detail_delete.php?id=".md5($data[$i]['id'])."' class='btn_no_text btn' style='border-radius: 4px;' title='Delete'><span class='ui-icon ui-icon-circle-close'></span></a>
                                </td>
                              </tr>
                              ";
                              $beli = $beli + $data[$i]['harga_beli'];
                              $jual = $jual + $data[$i]['harga_jual'];
                              $total = $total + ($data[$i]['harga_beli'] * $data[$i]['qty']);
                            }
                            ?>
                            <tr>
                              <td colspan="3">Total</td>
                              <td>
                                <div align="right" style="font-weight: bold"><?php echo number_format($beli) ?></div>
                              </td>
                              <td>
                                <div align="right" style="font-weight: bold"><?php echo number_format($jual) ?></div>
                              </td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="form-actions">
                    <input type="button" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Penerimaan" onclick="simpanData(this.form, 'pages/inv/penerimaan_obat_detail_insert.php')" />
                    <input type="button" class="btn btn-sm btn-small btn-primary rounded" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Update Stock" onclick="simpanData(this.form, 'pages/inv/penerimaan_obat_update_stock.php')" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script language="javascript">
  function clearAll() {
    document.getElementById('qty').value = "";
    document.getElementById('harga_beli').value = "";
    document.getElementById('margin_obat').value = "";
    document.getElementById('harga_jual').value = "0";
    document.getElementById('qty').focus();
  }

  function Clear1() {
    document.getElementById('harga_beli').value = "";
    document.getElementById('margin_obat').value = "";
    document.getElementById('harga_jual').value = "0";
  }

  function Clear2() {
    document.getElementById('margin_obat').value = "";
    document.getElementById('harga_jual').value = "0";
  }

  function hitungHargaJual() {
    var marginNya = document.getElementById('margin_obat').value;
    var beli = document.getElementById('harga_beli').value;
    harga_jual = (beli * 1) + (beli * marginNya / 100);
    document.getElementById('harga_jual').value = harga_jual;
  }

  $(document).ready(function() {
    $(".select2").select2();

    $("#qty").keypress(function(e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });

    $("#harga_beli").keypress(function(e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });

    $("#margin_obat").keypress(function(e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });

    $("#harga_jual").keypress(function(e) {
      if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
      }
    });

    $("#form").submit(function() {
      return false;
    });

    $('#code').change(function() {
      var value = $(this).val();
      if (value) document.getElementById('name').value = (this.options[this.selectedIndex].text);
    });

    $('#hapusItem').click(function(){
      var r = confirm("Apakah anda yakin ingin menghapus item ini?");
      var id = $(this).attr('data-id');
      var subId = $(this).attr('data-subid');
      var qty = $(this).attr('data-qty');
      if (r == true) {
          window.location = "pages/inv/penerimaan_obat_detail_delete.php?id=" + id + "&subid=" + subId + "&qty=" + qty;
      }
    });
  });
</script>
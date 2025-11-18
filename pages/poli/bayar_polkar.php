<?php

	$data = $db->query("select * from tbl_polkar where id='".$_GET['id']."'", 0);
	$noPolkar = $data[0]['no_polkar'];
?>
<script language="javascript">
	function GetData(id) {
		//var no_inv = document.getElementById('no_inv').value;
		//var tgl_input = document.getElementById('tgl_input').value;
		//var kirim = document.getElementById('kirim').value;
		//var jatuh_tempo = document.getElementById('jatuh_tempo').value;
		var url = "pages/piutang/invoice_asuransi.php";
		var data = {id:id};
		
		$('.loading').fadeIn();
		$('#data_pasien').fadeOut();
		$('#data_pasien').load(url,data, function(){
			$('.loading').fadeOut('fast');
			$('#data_pasien').fadeIn('fast');
		});
	}
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Poli</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Poli Gigi</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembayaran Poli Karyawan </a>
            </li>
        </ul>
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
                                        Form Pembayaran Poli Karyawan
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. PolKar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_polkar" name="no_polkar" class="form-control" style="width: 130px; background-color:#CCC" value="<?php echo $data[0]['no_polkar']?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Total Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="total_txt" name="total_txt" class="form-control" style="width: 130px; text-align: right; font-weight: bold" value="<?php echo number_format($_GET['total'])?>" />
                                                        <input type="hidden" id="total" name="total" class="form-control" style="width: 130px; text-align: right; font-weight: bold" value="<?php echo $_GET['total']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="tgl_bayar" name="tgl_bayar" class="form-control" style="width: 130px;" value="<?php echo date("m/d/Y")?>" />
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Pembayaran" onclick="simpanData(this.form, 'pages/poli/bayar_polkar_insert.php')" />
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">

                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Nama Obat</th>
                                                            <th style="width:30px">Sat</th>
                                                            <th style="width:30px">QTY</th>
                                                            <th style="width:40px">Harga</th>
                                                            <th style="width:40px">Total</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from  tbl_polkar_detail where status_delete='UD' and jenis='NR' and polkar_id='".$_GET['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['nama_obat']?></td>
                                                                <td><?php echo $satuan?></td>
                                                                <td><div align="right"><?php echo $data[$i]['qty']?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obat_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $sbttl = $sbttl + $data[$i]['total'];
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="5">SubTotal</td>
                                                            <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($sbttl)?></div></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    &nbsp;
                                                    <?php
                                                    $resep = $db->query("select * from  tbl_polkar_racikan where no_polkar='".$noPolkar."' and status_delete='UD'", 0);
                                                    for ($j = 0; $j < count($resep); $j++) {

                                                        ?>
                                                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                            <thead>
                                                            <tr>
                                                                <th style="width:20px">No</th>
                                                                <th>Nama Obat</th>
                                                                <th style="width:30px">Sat</th>
                                                                <th style="width:30px">QTY</th>
                                                                <th style="width:40px">Harga</th>
                                                                <th style="width:40px">Total</th>
                                                                <th style="width:30px">OPT</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="6" style="height: 10px;"><?php echo '<p align="left" style="margin-top: 0px; margin-bottom: 0px; margin-left: 5px; font-weight: bold">Obat Racikan : '.$resep[$j]['nama'].'</p>'?></td>
                                                                <td class="text-center">
                                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikanH_delete.php?id=<?php echo $resep[$j]['id'].'&subid='.$_GET['id']?>';">
                                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $data = $db->query("select * from tbl_polkar_detail where status_delete='UD' and jenis='R' and racikan_id='".$resep[$j]['id']."'", 0);
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                $satuan = $db->queryItem("select satuan_terkecil from tbl_obat where kode_obat='".$data[$i]['kode_obat']."'");
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i+1?></td>
                                                                    <td><?php echo $data[$i]['nama_obat']?></td>
                                                                    <td><?php echo $satuan?></td>
                                                                    <td><?php echo $data[$i]['qty']?></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['harga'])?></div></td>
                                                                    <td align="right"><div align="right"><?php echo number_format($data[$i]['total'])?></div></td>
                                                                    <td class="text-center">
                                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/poli/polkar_obatRacikan_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';">
                                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $sbttl2[$j] = $sbttl2[$j] + $data[$i]['total'];
                                                            }
                                                            $tambahan = $db->queryItem("select nilai from tbl_config where kode='RACIKAN' and tahun='".date("Y")."'");
                                                            $totalRacikan = $tambahan + $sbttl2[$j];
                                                            ?>
                                                            <tr>
                                                                <td colspan="5">&nbsp;</td>
                                                                <td colspan="2"><div align="left" style="font-weight: bold"><?php echo number_format($totalRacikan)?></div></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
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
</div>
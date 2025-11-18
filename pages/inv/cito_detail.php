<?php

	$data = $db->query("select * from tbl_cito where id='".$_GET['id']."'");
?>
<script language="javascript">
	function CariPasien(id) {
		var url = "pages/pendaftaran/view_pasien.php";
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
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    PEMBELIAN OBAT LANGSUNG
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Detail Pembelian Obat Langsung</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small lightgrey">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/pendaftaran/daftar_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">No. CITO</label>
                                                    <div class="col-sm-8">
                                                        <?php echo $data[0]['no_cito']?>
                                                        <input type="hidden" id="no_cito" name="no_cito" value="<?php echo $data[0]['no_cito']?>" />
                                                        <input type="hidden" id="citoID" name="citoID" value="<?php echo $data[0]['id']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Input</label>
                                                    <div class="col-sm-8">
                                                        <?php echo date("d-m-Y", strtotime($data[0]['tgl_input_cito']))?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pilih Obat </label>
                                                    <div class="col-sm-8">
                                                        <select id="obat" name="obat" size="1" class="form-control" tabindex="1">
                                                            <option value="">--Pilih Obat--</option>
                                                            <?php
                                                            $lab = $db->query("select kode_obat, nama_obat from tbl_obat where stock_akhir <= stock_min_apotik and status_delete='UD' and stock_min_apotik > 0 order by nama_obat");
                                                            for ($i = 0; $i < count($lab); $i++) {
                                                                $j = $i + 1;
                                                                echo '<option value="'.$lab[$i]['kode_obat'].'">'.$lab[$i]['nama_obat'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Qty</label>
                                                    <div class="col-sm-8">
                                                        <div id="DataAdd">
                                                            <div id="TarifTindakan">
                                                                <input type="text" name="qty" id="qty" size="5" value="0" class="form-control text-right" tabindex="3" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Harga Satuan</label>
                                                    <div class="col-sm-8">
                                                        <div id="DataAdd">
                                                            <div id="TarifTindakan">
                                                                <input type="text" name="harga_satuan" id="harga_satuan" size="15" value="0" class="form-control text-right" tabindex="3" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Harga Beli</label>
                                                    <div class="col-sm-8">
                                                        <div id="DataAdd">
                                                            <div id="TarifTindakan" >
                                                                <input type="text" name="harga_beli" id="harga_beli" size="15" value="0" class="form-control text-right" tabindex="3" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="data_pasien">
                                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                                        <thead>
                                                        <tr>
                                                            <th style="width:20px">No</th>
                                                            <th>Nama Obat</th>
                                                            <th style="width:60px">QTY</th>
                                                            <th style="width:100px">Harga Satuan</th>
                                                            <th style="width:100px">Harga Beli</th>
                                                            <th style="width:30px">OPT</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $data = $db->query("select * from tbl_cito_detail where status_delete='UD' and citoID='".$data[0]['id']."'", 0);
                                                        for ($i = 0; $i < count($data); $i++) {
                                                            $total = $data[$i]['harga'] * $data[$i]['qty'];
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i+1?></td>
                                                                <td><?php echo $data[$i]['nama_obat']?></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['qty'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga_satuan'])?></div></td>
                                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['harga_beli'])?></div></td>
                                                                <td class="text-center"><a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/cito_detail_delete.php?id=<?php echo $data[$i]['id'].'&subid='.$_GET['id']?>';"> <span class="ui-icon ui-icon-circle-close"></span> </a> </td>
                                                            </tr>
                                                            <?php
                                                            $tot1 = $tot1 + $data[$i]['qty'];
                                                            $tot2 = $tot2 + $data[$i]['harga'];
                                                            $tot3 = $tot3 + $total;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="2" style="font-weight: bold; text-align: right">Grand Total</td>
                                                            <td><div align="right" style="font-weight: bold"><?php echo number_format($tot1)?></div></td>
                                                            <td><div align="right" style="font-weight: bold">&nbsp;</div></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="button" value="Tambahkan Obat" class="btn btn-sm btn-small btn-primary rounded" onclick="simpanData(this.form, 'pages/inv/simpan_cito_detail.php')" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="List CITO" onclick="simpanData(this.form, 'index.php?mod=inv&submod=cito')" />
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
<?php
	$data = $db->query("select * from tbl_invoice where id='".$_GET['id']."'", 0);
?>
<script language="javascript">
	function GetData(id) {
		var url = "pages/piutang/view_perusahaan.php";
		var data = {id:id, inv:<?php echo $_GET['id']?>};

		$('#detailPerusahaan').load(url,data, function(){
			$('#detailPerusahaan').fadeIn('fast');
		});
	}
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Piutang</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembuatan Invoice
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pembayaran Invoice</a>
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
                                        Form Pembayaran Invoice
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/poli_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan" >
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Nomor Invoice</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_inv" name="no_inv" class="form-control" readonly="readonly" value="<?php echo $data[0]['no_inv']?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Total Invoice</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="no_inv" name="no_inv" class="form-control" readonly="readonly" value="<?php echo number_format($data[0]['total'])?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Pembayaran untuk</label>
                                                    <div class="col-sm-8">
                                                        <select id="perusahaan" name="perusahaan" size="1" class="form-control" onchange="GetData(this.value)">
                                                            <option value="">--Pilih Perusahaan--</option>
                                                            <option value="ALL">ALL/SEMUA</option>
                                                            <?php
                                                            $data = $db->query("select b.pekerjaan, a.nomr from tbl_invoice_detail a left join tbl_pasien b on b.nomr=a.nomr where a.invoiceID='".$_GET['id']."' and b.status_delete='UD' and a.status_bayar='BLM' group by b.pekerjaan");
                                                            for ($i = 0; $i < count($data); $i++) {
                                                                echo '<option value="'.$data[$i]['pekerjaan'].'">'.$data[$i]['pekerjaan'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Tanggal Bayar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="jatuh_tempo" name="jatuh_tempo" class="form-control" value="" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Keterangan</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="textarea" id="textarea" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-4">Coa Bayar</label>
                                                    <div class="col-sm-8">
	                                            <select id="kd_coa" name="kd_coa" size="1" class="form-control">
                                	                    <option value="">--Pilih Nama Coa--</option>
							    <?php
								$coa = $db->query("select kd_coa, nm_coa from tbl_coa order by kd_coa");
								for ($i = 0; $i < count($coa); $i++) {
									if ($data[0]['pendapatan_kd_coa'] == $coa[$i]['kd_coa']) {
										echo '<option value="'.$coa[$i]['kd_coa'].'" selected>'.$coa[$i]['kd_coa'].' - '.$coa[$i]['nm_coa'].'</option>';
									}
									else {
										echo '<option value="'.$coa[$i]['kd_coa'].'">'.$coa[$i]['kd_coa'].' - '.$coa[$i]['nm_coa'].'</option>';
									}
								}
							    ?>
        	                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="detailPerusahaan" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanData(this.form, 'pages/piutang/invoice_update.php')" />
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
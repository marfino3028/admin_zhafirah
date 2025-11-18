<?php
	$data = $db->query("select * from tbl_coa where md5(id)='".$_GET['id']."'");
?>

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Chart of Account (COA)
                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data</a>
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
                                        Form Edit Data Master Chart of Account (COA)
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/coa_update.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode COA</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="kd_coa" name="kd_coa" class="form-control" style="50px" value="<?php echo $data[0]['kd_coa']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama COA</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nm_coa" name="nm_coa" class="form-control" value="<?php echo $data[0]['nm_coa']?>" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Account Type</label>                                           
                                            <div class="col-sm-2">
                                                <select id="ac_type" name="ac_type" size="1" class="form-control">
                                                    <?php
                                                            if ($data[0]['ac_type'] == 'Asset') {
                                                                echo '<option value="Asset" selected="selected">Asset</option>';
                                                                echo '<option value="Liabillty">Liabillty</option>';
                                                                echo '<option value="Equity">Equity</option>';
                                                                echo '<option value="Income">Income</option>';
                                                                echo '<option value="Expense">Expense</option>';
                                                            }
                                                            elseif ($data[0]['ac_type'] == 'Liabillty') {
                                                                echo '<option value="Asset">Asset</option>';
                                                                echo '<option value="Liabillty" selected="selected">Liabillty</option>';
                                                                echo '<option value="Equity">Equity</option>';
                                                                echo '<option value="Income">Income</option>';
                                                                echo '<option value="Expense">Expense</option>';
                                                            }
                                                            elseif ($data[0]['ac_type'] == 'Equity') {
                                                                echo '<option value="Asset">Asset</option>';
                                                                echo '<option value="Liabillty">Liabillty</option>';
                                                                echo '<option value="Equity" selected="selected">Equity</option>';
                                                                echo '<option value="Income">Income</option>';
                                                                echo '<option value="Expense">Expense</option>';
                                                            }
                                                            elseif ($data[0]['ac_type'] == 'Income') {
                                                                echo '<option value="Asset">Asset</option>';
                                                                echo '<option value="Liabillty">Liabillty</option>';
                                                                echo '<option value="Equity">Equity</option>';
                                                                echo '<option value="Income" selected="selected">Income</option>';
                                                                echo '<option value="Expense">Expense</option>';
                                                            }
                                                            elseif ($data[0]['ac_type'] == 'Expense') {
                                                                echo '<option value="Asset">Asset</option>';
                                                                echo '<option value="Liabillty">Liabillty</option>';
                                                                echo '<option value="Equity">Equity</option>';
                                                                echo '<option value="Income">Income</option>';
                                                                echo '<option value="Expense" selected="selected">Expense</option>';
                                                            }
                                                            else{
                                                                echo '<option value="Asset">Asset</option>';
                                                                echo '<option value="Liabillty">Liabillty</option>';
                                                                echo '<option value="Equity">Equity</option>';
                                                                echo '<option value="Income">Income</option>';
                                                                echo '<option value="Expense">Expense</option>';
                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Post Type</label>                                           
                                            <div class="col-sm-2">
                                                <select id="post_tape" name="post_tape" size="1" class="form-control">
                                                        <?php
                                                            if ($data[0]['post_tape'] == 'Detail') {
                                                                echo '<option value="Detail" selected="selected">Detail</option>';
                                                                echo '<option value="Header">Header</option>';
                                                            }
                                                            elseif ($data[0]['post_tape'] == 'Header') {
                                                                echo '<option value="Detail">Detail</option>';
                                                                echo '<option value="Header" selected="selected">Header</option>';
                                                            }
                                                            else{
                                                                echo '<option value="Detail">Detail</option>';
                                                                echo '<option value="Header">Header</option>';
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Group COA</label>                                           
                                            <div class="col-sm-2">
                                                <select id="group_coa" name="group_coa" size="1" class="form-control">
                                                    <?php
                                                            if ($data[0]['group_coa'] == 'G/L') {
                                                                echo '<option value="G/L" selected="selected">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                            }
                                                            elseif ($data[0]['group_coa'] == 'Hutang Usaha') {
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha" selected="selected">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                            }
                                                            elseif ($data[0]['group_coa'] == 'Penyusutan dan Amortisasi') {
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi" selected="selected">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                           }
                                                            elseif ($data[0]['group_coa'] == 'Persedian Raw Material') {
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material" selected="selected">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                           }
                                                            elseif ($data[0]['group_coa'] == 'Piutang') {
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang" selected="selected">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                           }
                                                            elseif ($data[0]['group_coa'] == 'Temporary') {
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary" selected="selected">Temporary</option>';
                                                            }
                                                            else{
                                                                echo '<option value="G/L">G/L</option>';
                                                                echo '<option value="Hutang Usaha">Hutang Usaha</option>';
                                                                echo '<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>';
                                                                echo '<option value="Persedian Raw Material">Persedian Raw Material</option>';
                                                                echo '<option value="Piutang">Piutang</option>';
                                                                echo '<option value="Temporary">Temporary</option>';
                                                            }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Parent COA</label>                                           
                                            <div class="col-sm-5">
                                                        <select class="form-control" id="parent_coa" name="parent_coa">
                                                            <option value="">--Pilih Parent COA--</option>
                                        				<?php
                                        					    $sub = $db->query("select kd_coa, parent_coa, nm_coa from tbl_coa");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['parent_coa'] == $sub[$i]['parent_coa']) {
                                        					            echo '<option value="'.$sub[$i]['parent_coa'].'" selected>'.$sub[$i]['parent_coa'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['parent_coa'].'">'.$sub[$i]['parent_coa'].'</option>';
                                        					        }
                                        					    }
                                        				?>
														</select>
                                                    </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">System Default COA</label>                                           
                                            <div class="col-sm-3">
                                                <select id="sd_coa" name="sd_coa" size="1" class="form-control">
                                                        <?php
                                                            if ($data[0]['sd_coa'] == 'Detail') {
                                                                echo '<option value="Detail" selected="selected">Detail</option>';
                                                                echo '<option value="Header">Header</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Header') {
                                                                echo '<option value="Detail">Detail</option>';
                                                                echo '<option value="Header" selected="selected">Header</option>';
                                                            }
                                                            else{
                                                                echo '<option value="Detail">Detail</option>';
                                                                echo '<option value="Header">Header</option>';
                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Temporary COA</label>                                           
                                            <div class="col-sm-3">
                                                <select id="tempo_coa" name="tempo_coa" size="1" class="form-control">
                                                    <option value="">--Pilih Temporary COA--</option>
                                        				<?php
                                        					    $sub = $db->query("select kd_coa, tempo_coa from tbl_coa");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['tempo_coa'] == $sub[$i]['tempo_coa']) {
                                        					            echo '<option value="'.$sub[$i]['tempo_coa'].'" selected>'.$sub[$i]['tempo_coa'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['tempo_coa'].'">'.$sub[$i]['tempo_coa'].'</option>';
                                        					        }
                                        					    }
                                        				?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1" style="text-align: right;">Note</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="note" name="note" class="form-control" value="<?php echo $data[0]['note']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Unit</label>                                           
                                            <div class="col-sm-2">
                                                <select id="unit" name="unit" size="1" class="form-control">
                                                        <?php
                                                            if ($data[0]['sd_coa'] == 'Lain-lain') {
                                                                echo '<option value="Lain-lain" selected="selected">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Farmasi') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi" selected="selected">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Radiologi') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi" selected="selected">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Laboratorium') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium" selected="selected">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Poliklinik') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik" selected="selected">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'Hemodialisa') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa" selected="selected">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                            elseif ($data[0]['sd_coa'] == 'OK / Kamar Bedah') {
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah" selected="selected">OK / Kamar Bedah</option>';
                                                            }
                                                            else{
                                                                echo '<option value="Lain-lain">Lain-lain</option>';
                                                                echo '<option value="Farmasi">Farmasi</option>';
                                                                echo '<option value="Radiologi">Radiologi</option>';
                                                                echo '<option value="Laboratorium">Laboratorium</option>';
                                                                echo '<option value="Poliklinik">Poliklinik</option>';
                                                                echo '<option value="Hemodialisa">Hemodialisa</option>';
                                                                echo '<option value="OK / Kamar Bedah">OK / Kamar Bedah</option>';
                                                            }
                                                        ?>                                                    
                                                </select>
                                            </div>
										<label class="control-label col-sm-3" style="text-align: right;">Profit & Lost (P/L) Account ?</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" id="pl_coa" name="pl_coa" value="YA" <?php if ($data[0]['pl_coa'] == 'YA') echo 'checked'?>>YA
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" id="pl_coa" name="pl_coa" value="TIDAK" <?php if ($data[0]['pl_coa'] == 'TIDAK') echo 'checked'?>>Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-1" style="text-align: right;">Is Valid</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" id="is_valid" name="is_valid" value="YA" <?php if ($data[0]['is_valid'] == 'YA') echo 'checked'?>>YA
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" id="is_valid" name="is_valid" value="TIDAK" <?php if ($data[0]['is_valid'] == 'TIDAK') echo 'checked'?>>Tidak
												</label>
											</div>
										</div>
                                        </div>
                                        <div class="form-group">
										<label class="control-label col-sm-2">Gunakan pada Settlemen Pegawai</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_settlemen" name="is_settlemen"<?php if ($data[0]['is_settlemen'] == 'YA') echo 'checked'?>>Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_settlemen" name="is_settlemen"<?php if ($data[0]['is_settlemen'] == 'TIDAK') echo 'checked'?>>Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-2" style="text-align: right;">Is Akun Penunjang</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_penunjang" name="is_penunjang"<?php if ($data[0]['is_penunjang'] == 'YA') echo 'checked'?>>Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_penunjang" name="is_penunjang"<?php if ($data[0]['is_penunjang'] == 'TIDAK') echo 'checked'?>>Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-2" style="text-align: right;">Use in Petty Cash</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_pettycash" name="is_pettycash"<?php if ($data[0]['is_pettycash'] == 'YA') echo 'checked'?>>Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_pettycash" name="is_pettycash"<?php if ($data[0]['is_pettycash'] == 'TIDAK') echo 'checked'?>>Tidak
												</label>
											</div>
										</div>
									</div>
									 <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Profit & Cost Center</label>                                           
                                            <div class="col-sm-2">
                                               <select class="form-control" id="profit" name="profit" required="required">
                                                    <option value="">--Pilih Profit & Cost Center--</option>
                                        				<?php
                                        					    $sub = $db->query("select kd_profit , nm_profit from tbl_profit");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        if ($data[0]['kd_profit '] == $sub[$i]['id']) {
                                        					            echo '<option value="'.$sub[$i]['kd_profit '].'" selected>'.$sub[$i]['nm_profit'].'</option>';
                                        					        }
                                        					        else {
                                        					            echo '<option value="'.$sub[$i]['kd_profit '].'">'.$sub[$i]['nm_profit'].'</option>';
                                        					        }
                                        					    }
                                        				?>                                        					
												</select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Default.Pos</label>                                           
                                            <div class="col-sm-2">
                                                <select id="default_pos" name="default_pos" size="1" class="form-control">
                                                        <?php
                                                            if ($data[0]['default_pos'] == 'Debit') {
                                                                echo '<option value="Debit" selected="selected">Debit</option>';
                                                                echo '<option value="Credit">Credit</option>';
                                                            }
                                                            elseif ($data[0]['default_pos'] == 'Credit') {
                                                                echo '<option value="Debit">Debit</option>';
                                                                echo '<option value="Credit" selected="selected">Credit</option>';
                                                            }
                                                            else{
                                                                echo '<option value="Debit">Debit</option>';
                                                                echo '<option value="Credit">Credit</option>';
                                                            }
                                                        ?>
                                                </select>
                                    </div>
                                    </div>
                                        <div class="form-actions">
                                            <input type="hidden" id="id" name="id" value="<?php echo md5($data[0]['id'])?>" />
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanData(this.form, 'pages/master/coa_update.php')" />
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
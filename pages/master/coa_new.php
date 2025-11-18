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
                <a href="javascript:void(0)">Tambah Data</a>
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
                                        Form Tambah Chart of Account (COA)
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form action="javascript:simpanData(this.form, 'pages/master/coa_insert.php')" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Kode COA</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="kd_coa" name="kd_coa" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama COA</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="nm_coa" name="nm_coa" class="form-control" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2">Account Type</label>                                           
                                            <div class="col-sm-2">
                                                <select id="ac_type" name="ac_type" size="1" class="form-control">
                                                    <option value="">--Pilih Account Type--</option>
                                                    <option value="Asset">Asset</option>
                                                    <option value="Liabillty">Liabillty</option>
                                                    <option value="Equity">Equity</option>
                                                    <option value="Income">Income</option>
                                                    <option value="Expense">Expense</option>
						    <option value="Other Expense">Other Expense</option>
						    <option value="Other Income">Other Income</option>
						    <option value="Operational Expense">Operational Expense</option>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Post Type</label>                                           
                                            <div class="col-sm-2">
                                                <select id="post_tape" name="post_tape" size="1" class="form-control">
                                                    <option value="">--Pilih Post Type--</option>
                                                    <option value="Detail">Detail</option>
                                                    <option value="Header">Header</option>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Group COA</label>                                           
                                            <div class="col-sm-2">
                                                <select id="group_coa" name="group_coa" size="1" class="form-control">
                                                    <option value="">--Pilih Group COA--</option>
                                                    <option value="G/L">G/L</option>
                                                    <option value="Hutang Usaha">Hutang Usaha</option>
                                                    <option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>
                                                    <option value="Persedian Raw Material">Persedian Raw Material</option>
                                                    <option value="Piutang">Piutang</option>
                                                    <option value="Temporary">Temporary</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Parent COA</label>                                           
                                            <div class="col-sm-5">
                                                        <select class="form-control" id="parent_coa" name="parent_coa">
                                                            <option value="">--Pilih Parent COA--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, nm_coa from tbl_coa");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['nm_coa'].'">'.$sub[$i]['nm_coa'].'</option>';
                                        					    }
                                        					?>
														</select>
                                                    </div>
                                            <label for="textfield" class="control-label col-sm-2">System Default COA</label>                                           
                                            <div class="col-sm-2">
                                                <select id="sd_coa" name="sd_coa" size="1" class="form-control">
                                                    <option value="">--Pilih Post Type--</option>
                                                    <option value="Detail">Detail</option>
                                                    <option value="Header">Header</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Temporary COA</label>                                           
                                            <div class="col-sm-2">
                                                <select id="tempo_coa" name="tempo_coa" size="1" class="form-control">
                                                    <option value="">--Pilih Temporary COA--</option>
                                        					<?php
                                        					    $sub = $db->query("select id, nm_coa from tbl_coa");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['nm_coa'].'">'.$sub[$i]['nm_coa'].'</option>';
                                        					    }
                                        					?>
                                                </select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Note</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="note" name="note" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Unit</label>                                           
                                            <div class="col-sm-2">
                                                <select id="unit" name="unit" size="1" class="form-control">
                                                    <option value="-">--Pilih Unit--</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                    <option value="Farmasi">Farmasi</option>
                                                    <option value="Radiologi">Radiologi</option>
                                                    <option value="Laboratorium">Laboratorium</option>
                                                    <option value="Poliklinik">Poliklinik</option>
                                                    <option value="Hemodialisa">Hemodialisa</option>
                                                    <option value="OK / Kamar Bedah">OK / Kamar Bedah</option>
                                                </select>
                                            </div>
										<label class="control-label col-sm-2">Profit & Lost (P/L) Account ?</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" id="pl_coa" name="pl_coa" value="YA">YA
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" id="pl_coa" name="pl_coa" value="TIDAK">Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-1" align="Right">Is Valid</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" id="is_valid" name="is_valid" value="YA">YA
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" id="is_valid" name="is_valid" value="TIDAK">Tidak
												</label>
											</div>
										</div>
                                        </div>
                                        <div class="form-group">
										<label class="control-label col-sm-2">Gunakan pada Settlemen Pegawai</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_settlemen" name="is_settlemen">Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_settlemen" name="is_settlemen">Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-1">Is Akun Penunjang</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_penunjang" name="is_penunjang">Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_penunjang" name="is_penunjang">Tidak
												</label>
											</div>
										</div>
										<label class="control-label col-sm-1">Use in Petty Cash</label>
										<div class="col-sm-2">
											<div class="radio">
												<label>
													<input type="radio" value="YA" id="is_pettycash" name="is_pettycash">Ya
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" value="TIDAK" id="is_pettycash" name="is_pettycash">Tidak
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
                                        					    $sub = $db->query("select id, nm_profit from tbl_profit");
                                        					    for ($i = 0; $i < count($sub); $i++) {
                                        					        echo '<option value="'.$sub[$i]['nm_profit'].'">'.$sub[$i]['nm_profit'].'</option>';
                                        					    }
                                        					?>
												</select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-1">Default.Pos</label>                                           
                                            <div class="col-sm-2">
                                                <select id="default_pos" name="default_pos" size="1" class="form-control">
                                                    <option value="">--Pilih Default Pos--</option>
                                                    <option value="Debit">Debit</option>
                                                    <option value="Credit">Credit</option>
                                                </select>
                                            </div>
                                    </div>
                                        <div class="form-actions">
                                            <input type="button" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data" onclick="simpanData(this.form, 'pages/master/coa_insert.php')" />
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
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Worklist</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Indikator Mutu</a>
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
                            <div class="box box-bordered box-color">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Indikator Mutu
                                </div>
                                <div class="box-content">
                                    <form action="pages/mutu/insert.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                                                <div class="form-group">
                                                    <div class="col-sm-2">
                                                    	Unit
                                                        <select class="form-control" id="unit" name="unit" required="required">
                                                            <option value="Radiologi">Radiologi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                    	Bulan/Tahun
                                                        <input type="month" id="bulantahun" name="bulantahun" class="form-control" value="<?php echo date("Y-m") ?>" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                    	Jenis Indikator
                                                        <select class="form-control" id="level" name="level" required="required">
                                                            <option value="">--Pilih Level--</option>
                                                            <option value="Nasional">Nasional</option>
                                                            <option value="Prioritas">Prioritas</option>
                                                            <option value="Unit">Unit</option>
                                                            <option value="Kontrak">Kontrak</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    	Nama Indikator
                                                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Kepatuhan Identifikasi Pasien" required="required" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-6">
                                                    	Definisi Operasional
                                                        <textarea name="definisi" id="definisi" rows="5" class="form-control"" placeholder="Definisi Operasional"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                    	Inklusi
                                                        <textarea name="inklusi" id="inklusi" rows="5" class="form-control"" placeholder="Inklusi"></textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                    	Inklusi
                                                        <textarea name="eksklusi" id="eksklusi" rows="5" class="form-control"" placeholder="Eksklusi"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
						    						<label for="textarea" class="control-label col-sm-2">Numerator</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="numerator" name="numerator" class="form-control" placeholder="Contoh: Jumlah waktu tunggu hasil pemeriksaan radiologi suspek tumor < 5jam" required="required" />
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator1" name="numerator1" class="form-control" placeholder="tgl 1" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator2" name="numerator2" class="form-control" placeholder="tgl 2" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator3" name="numerator3" class="form-control" placeholder="tgl 3" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator4" name="numerator4" class="form-control" placeholder="tgl 4" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator5" name="numerator5" class="form-control" placeholder="tgl 5" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator6" name="numerator6" class="form-control" placeholder="tgl 6" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator7" name="numerator7" class="form-control" placeholder="tgl 7" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator8" name="numerator8" class="form-control" placeholder="tgl 8" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator9" name="numerator9" class="form-control" placeholder="tgl 9" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator10" name="numerator10" class="form-control" placeholder="tgl 10" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator11" name="numerator11" class="form-control" placeholder="tgl 11" style="text-align: center;" /></div>
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator12" name="numerator12" class="form-control" placeholder="tgl 12" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator13" name="numerator13" class="form-control" placeholder="tgl 13" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator14" name="numerator14" class="form-control" placeholder="tgl 14" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator15" name="numerator15" class="form-control" placeholder="tgl 15" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator16" name="numerator16" class="form-control" placeholder="tgl 16" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator17" name="numerator17" class="form-control" placeholder="tgl 17" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator18" name="numerator18" class="form-control" placeholder="tgl 18" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator19" name="numerator19" class="form-control" placeholder="tgl 19" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator20" name="numerator20" class="form-control" placeholder="tgl 20" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator21" name="numerator21" class="form-control" placeholder="tgl 21" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator22" name="numerator22" class="form-control" placeholder="tgl 22" style="text-align: center;" /></div>
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator23" name="numerator23" class="form-control" placeholder="tgl 23" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator24" name="numerator24" class="form-control" placeholder="tgl 24" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator25" name="numerator25" class="form-control" placeholder="tgl 25" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator26" name="numerator26" class="form-control" placeholder="tgl 26" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator27" name="numerator27" class="form-control" placeholder="tgl 27" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator28" name="numerator28" class="form-control" placeholder="tgl 28" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator29" name="numerator29" class="form-control" placeholder="tgl 29" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator30" name="numerator30" class="form-control" placeholder="tgl 30" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="numerator31" name="numerator31" class="form-control" placeholder="tgl 31" style="text-align: center;" /></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
						    						<label for="textarea" class="control-label col-sm-2">Denominator</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="denominator" name="denominator" class="form-control" placeholder="Contoh: Jumlah pasien yang melakukan pemeriksaan radiologi dengan suspek tumor" required="required" />
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator1" name="denominator1" class="form-control" placeholder="tgl 1" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator2" name="denominator2" class="form-control" placeholder="tgl 2" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator3" name="denominator3" class="form-control" placeholder="tgl 3" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator4" name="denominator4" class="form-control" placeholder="tgl 4" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator5" name="denominator5" class="form-control" placeholder="tgl 5" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator6" name="denominator6" class="form-control" placeholder="tgl 6" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator7" name="denominator7" class="form-control" placeholder="tgl 7" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator8" name="denominator8" class="form-control" placeholder="tgl 8" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator9" name="denominator9" class="form-control" placeholder="tgl 9" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator10" name="denominator10" class="form-control" placeholder="tgl 10" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator11" name="denominator11" class="form-control" placeholder="tgl 11" style="text-align: center;" /></div>
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator12" name="denominator12" class="form-control" placeholder="tgl 12" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator13" name="denominator13" class="form-control" placeholder="tgl 13" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator14" name="denominator14" class="form-control" placeholder="tgl 14" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator15" name="denominator15" class="form-control" placeholder="tgl 15" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator16" name="denominator16" class="form-control" placeholder="tgl 16" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator17" name="denominator17" class="form-control" placeholder="tgl 17" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator18" name="denominator18" class="form-control" placeholder="tgl 18" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator19" name="denominator19" class="form-control" placeholder="tgl 19" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator20" name="denominator20" class="form-control" placeholder="tgl 20" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator21" name="denominator21" class="form-control" placeholder="tgl 21" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator22" name="denominator22" class="form-control" placeholder="tgl 22" style="text-align: center;" /></div>
                                                    </div>
						    						<label for="textarea" class="control-label col-sm-2">&nbsp</label>
                                                    <div class="col-sm-10">
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator23" name="denominator23" class="form-control" placeholder="tgl 23" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator24" name="denominator24" class="form-control" placeholder="tgl 24" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator25" name="denominator25" class="form-control" placeholder="tgl 25" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator26" name="denominator26" class="form-control" placeholder="tgl 26" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator27" name="denominator27" class="form-control" placeholder="tgl 27" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator28" name="denominator28" class="form-control" placeholder="tgl 28" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator29" name="denominator29" class="form-control" placeholder="tgl 29" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator30" name="denominator30" class="form-control" placeholder="tgl 30" style="text-align: center;" /></div>
                                                        <div class="col-sm-1" style="margin-left: 4px;"><input type="text" id="denominator31" name="denominator31" class="form-control" placeholder="tgl 31" style="text-align: center;" /></div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-actions">
                                                    <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Indikator Mutu" />
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
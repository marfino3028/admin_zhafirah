<div class="box">
                                    <div class="box-title">
                                        <h3>
                                            <i class="fa fa-bars"></i>
                                            Formulir Ganti Password
                                        </h3>
                                    </div>
                                    <div class="box-content">
                                        <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                            <div class="box-title">
                                                <h3>
                                                    <i class="fa fa-table"></i> Ganti Password
                                                </h3>
                                            </div>
                                            <div class="box-content nopadding" style="overflow-x:auto;">
                                                <?php
                                                    $UserID = $db->query("select * from tbl_user where userid='".$_SESSION['rg_user']."'");
                                                    //print_r($UserID);
                                                ?>
                                                <form method="post" enctype="multipart/form-data" action="force_ganti_user_update.php" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-2">USER ID (Email)</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" id="userid" name="userid" class="form-control" Placeholder="UserID / Email" value="<?php echo $UserID[0]['userid']?>" disabled="disabled" />
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" id="nama" name="nama" class="form-control" Placeholder="Nama Lengkap" value="<?php echo $UserID[0]['nama']?>" disabled="disabled" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-2">Posisi & No. WhatsApp</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" id="posisi" name="posisi" class="form-control" Placeholder="Posisi" value="<?php echo $UserID[0]['nip']?>" disabled="disabled" />
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input type="text" id="telp" name="telp" class="form-control" Placeholder="Nomor WhatsApp" value="<?php echo $UserID[0]['telp']?>" disabled="disabled" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-2">Password saat ini</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" id="password1" name="password1" class="form-control" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="textfield" class="control-label col-sm-2">Password baru</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" id="password2" name="password2" class="form-control" required="required" />
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data User" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
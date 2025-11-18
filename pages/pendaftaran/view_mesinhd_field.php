<?php
	include "../../3rdparty/engine.php";	
	//print_r($_POST);
	if ($_POST['id'] == 'HE01') {
?>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Shift </label>
                                                    <div class="col-sm-9">
                                                        <select id="shift_hd" name="shift_hd" size="1" class="form-control" onchange="pilihShiftHD(this.value)" required="required">
                                                            <option value="">Pilih Shift</option>
                                                            <?php
							    $prsh = $db->query("select * from tbl_shift_hd");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                echo '<option value="'.$prsh[$i]['nilai'].'">'.$prsh[$i]['nama'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Mesin HD </label>
                                                    <div class="col-sm-9" id="MesinHDShift">
                                                        <select id="mesin_hd" name="mesin_hd" size="1" class="form-control" required="required">
                                                            <option value="">Pilih Shift HD terlebih dahulu</option>
                                                            <?php
							    $prsh = $db->query("select * from tbl_mesinHD");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                //echo '<option value="'.$prsh[$i]['id'].'">'.$prsh[$i]['merk_mesin'].'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
<?php
	}
?>
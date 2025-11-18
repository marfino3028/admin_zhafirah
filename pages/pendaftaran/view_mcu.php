<?php
	ini_set("display_errors", 1);
	include "../../3rdparty/engine.php";
        $data = $db->query("select * from tbl_paketmcu_detail where paketmcu_id='".$_POST['id']."'", 0);
	if (count($data) > 0) {
?>
				<div style="margin-top: 10px;">
				    <p style="margin-left: 10px; margin-top: 20px; font-weight: bold;">Daftar Paket MCU <?php echo $data[0]['paketmcu_nama']?></p>
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori/Nama</th>
                                                <th>Tarif</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            	for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i + 1 ?></td>
                                                    <td><?php echo $data[$i]['kategori'].'<br>'.$data[$i]['kategori_detail_nama'] ?></td>
                                                    <td style="text-align: right;"><?php echo 'STD:'.number_format($data[$i]['standard']).'<br>ASS:'.number_format($data[$i]['asuransi']) ?></td>
                                                    <td>
                                                    <div>
							<label><input type="checkbox" id="policy<?php echo $data[$i]['id']?>" name="policy[<?php echo $data[$i]['id']?>]" value="NO"> Tidak Dilakukan</label>
                                                        <select id="doktermcu<?php echo $data[$i]['id']?>" name="doktermcu[<?php echo $data[$i]['id']?>]" size="1" class="form-control">
                                                            <option value="">--Pilih Dokter--</option>
                                                            <?php
                                                              $poli = $db->query("select * from tbl_dokter");
                                                              for ($ii = 0; $ii < count($poli); $ii++) {
                                                                echo '<option value="'.$poli[$ii]['kode_dokter'].'">'.$poli[$ii]['nama_dokter'].'</option>';
                                                              }
                                                            ?>
                                                        </select>
                                                    </div>
													</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
				</div>
<?php
	}
?>
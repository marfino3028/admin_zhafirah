<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
?>
		<div style="margin-top: 15px;">
                        <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                          <thead>
                            <tr>
                              <th style="width:20px">No</th>
                              <th>Description</th>
                              <th style="width:40px">QTY</th>
                              <th style="width:80px">Harga Beli</th>
                              <th style="width:80px">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
			    
                            $data = $db->query("select * from tbl_penerimaan_detail where status_delete='UD' and no_penerimaan='" . $_POST['id']. "'", 0);
                            for ($i = 0; $i < count($data); $i++) {
                              $kategori = $db->queryItem("select b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.kode_tarif='" . $data[$i]['kode_tarif'] . "'");
                              echo "
                              <tr>
                                <td>
					<div class=\"checkbox\">
						<input type=\"checkbox\" name=\"checkbox".$data[$i]['id']."\" value=\"".$data[$i]['id']."\" checked>
					</div>
				</td>
                                <td>" . $data[$i]['nama_obat'] . ' - ' . $data[$i]['kode_obat'] . "</td>
                                <td align='right'>" . number_format($data[$i]['qty']) . "</td>
                                <td align='right'>" . number_format($data[$i]['harga_beli']) . "</td>
                                <td align='right'>" . number_format($data[$i]['harga_beli']*$data[$i]['qty']) . "</td>
                              </tr>
                              ";
                              $beli = $beli + $data[$i]['harga_beli'];
                              $jual = $jual + $data[$i]['harga_jual'];
                              $total = $total + ($data[$i]['harga_beli'] * $data[$i]['qty']);
                            }
                            ?>
                            <tr>
                              <td colspan="3" style="text-align: right;">Sub Total</td>
                              <td colspan="2">
                                <div align="right" style="font-weight: bold" id="subtotal"><?php echo number_format($total) ?></div>
				<input type="hidden" id="subtotalnr" name="subtotalnr" value="<?php echo $total ?>">
				<input type="hidden" id="subtotal_awal" name="subtotal_awal" value="<?php echo $total ?>">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">Diskon</td>
                              <td colspan="2">
                                <input type="number" style="text-align: right;" id="diskon" onKeyUp="HitungSemua()" name="diskon" class="form-control" value="0" >
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">Retur</td>
                              <td colspan="2">
                                <input type="number" style="text-align: right;" id="retur" name="retur" class="form-control" onKeyUp="HitungSemua()" value="0" >
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">DP (Down Payment)</td>
                              <td colspan="2">
                                <input type="number" style="text-align: right;" id="dp" name="dp" class="form-control" onKeyUp="HitungSemua()" value="0" >
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">PPN (11%)</td>
                              <td colspan="2">
                                <input type="number" style="text-align: right;" id="ppn" name="ppn" class="form-control" value="<?php echo round($total*11/100) ?>" >
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">Biaya Lainnya</td>
                              <td colspan="2">
                                <input type="number" style="text-align: right;" id="lain" name="lain" class="form-control" onKeyUp="HitungSemua()" value="0" >
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align: right;">Total</td>
                              <td colspan="2">
                                <div align="right" style="font-weight: bold; margin-right: 25px;" id="total"><?php echo number_format(round($total + ($total*10/100))) ?></div>
				<input type="hidden" id="totalnr" name="totalnr" value="<?php echo round($total + ($total*10/100)) ?>">
				<input type="hidden" id="total_awal" name="total_awal" value="<?php echo round($total + ($total*10/100)) ?>">
                              </td>
                            </tr>
                          </tbody>
                        </table>
		</div>
                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Tgl Invoice</th>
                                                <th rowspan="2">No. Invoice</th>
                                                <th rowspan="2">Tgl Kirim</th>
                                                <th rowspan="2">Jatuh Tempo</th>
                                                <th rowspan="2">Umur Real</th>
                                                <th rowspan="2">Total</th>
                                                <th rowspan="2">Bayar</th>
                                                <th rowspan="2">Sisa</th>
                                                <th colspan="7">Term (Hari)</th>
                                            </tr>
                                            <tr>
                                                <th><=0 Current</th>
                                                <th>0-30</th>
                                                <th>30-45</th>
                                                <th>45-60</th>
                                                <th>60-90</th>
                                                <th>90-120</th>
                                                <th>> 120</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
						include "../../3rdparty/engine.php";
						ini_set("display_errors", 0);
						
function hitungUmur($tanggal_lahir) {
    // format tanggal lahir harus YYYY-MM-DD
    $tgl_lahir = new DateTime($tanggal_lahir);
    $sekarang  = new DateTime();
    $umur = $sekarang->diff($tgl_lahir);
    return $umur->days; // hasil umur dalam tahun
}

                                                $data = $db->query("select * from tbl_invoice where nama_perusahaan='".$_POST['jamin']."' and tgl_input >= '".$_POST['d1']."' and tgl_input <= '".$_POST['d2']."' order by id desc", 0);
						$sekarang = date_create();
                                            	for ($i = 0; $i < count($data); $i++) {
                                                	$bayar = $db->queryItem("select sum(bayar) from tbl_kasir_detail where payment_to='ASURANSI' and no_kwitansi in (select b.no_kwitansi from tbl_invoice_detail a left join tbl_kasir b on b.no_daftar=a.no_daftar where a.status_bayar='SDH' and a.invoiceID='" . $data[$i]['id'] . "')");
                                                	//print_r($bayar);
							$selisih =hitungUmur($data[$i]['tgl_jatuh_tempo']);
							$sisa = $data[$i]['total'] - $bayar;
							if ($sisa > 0) {
                                            ?>
                                                <tr>
                                                    <td><div style="width: 80px;"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_input'])) ?></div></td>
                                                    <td><div style="width: 120px;"><?php echo $data[$i]['no_inv'] ?></div></td>
                                                    <td><div style="width: 80px;"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_kirim'])) ?></div></td>
                                                    <td><div style="width: 80px;"><?php echo date("d-m-Y", strtotime($data[$i]['tgl_jatuh_tempo'])) ?></div></td>
                                                    <td style="text-align: center;"><?php echo $selisih ?></td>
                                                    <td align="right">
							<div align="right"><?php echo number_format($data[$i]['total']) ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php echo number_format($bayar) ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php echo number_format($sisa) ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih == 0) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih > 0 and $selisih < 30) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih >= 30 and $selisih < 45) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih >= 45 and $selisih < 60) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih >= 60 and $selisih < 90) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih >= 90 and $selisih < 120) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                    <td align="right">
                                                        <div align="right"><?php if ($selisih >= 120) echo number_format($sisa); else echo '0'; ?></div>
                                                    </td>
                                                </tr>
                                            <?php
							}
                                            	}
                                            ?>
                                        </tbody>
                                    </table>

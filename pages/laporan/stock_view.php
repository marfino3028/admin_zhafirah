    <div class="row">
        <div class="col-sm-12">
             <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                <div class="box-title">
                </div>
                <div class="box-content" style="overflow-x:auto;">
					<table id="table-data" class="table table-hover dataTable table-bordered table-striped table-condensed">
						<thead> 
						<tr>
							<th style="width: 50px; text-align: center;">NO</th> 
							<th>DESCRIPTION</th> 
							<th style="width:75px">Stock Masuk</th> 
							<th style="width:75px">Stock Keluar</th> 
							<th style="width:75px">Stock Akhir</th> 
						</tr> 
						</thead> 
						<tbody> 
						<?php
							include "../../3rdparty/engine.php";
							ini_set("display_errors", 0);
							print_r($_POST);
							//Nilai Tutup Pendapatan Harian
							$data = $db->query("select a.*, b.nama_suplier nama_perusahaan, b.no_po, b.tgl_input_po, a.qty_po, a.stok_akhir from tbl_ro_detail a left join tbl_po b on b.no_ro=a.no_ro where a.kode_obat='".$_POST['obat']."' and b.tgl_input_po >= '".$_POST['d1']."' and b.tgl_input_po <= '".$_POST['d2']."' order by b.tgl_input_po desc", 0);
							//$dokter = $db->query("select * from tbl_dokter where kode_dokter='".$_POST['dokter']."'");
							$ni = count($data);
							for ($i = 0; $i < count($data); $i++) {
								$pasien = $db->query("select * from tbl_pasien where nomr='".$data[$i]['nomr']."'");
								$biayaAdmin = $data[$i]['biayaAdmin'];
								$no = $i + 1;
								$ni = $ni - 1;
								if ($_POST['gudang'] == 'APOTIK') $data[$i]['stok_akhir'] = $data[$i]['stok_akhir_apotik'];
						?>
						<tr>
							<td style="width: 50px; text-align: center;"><?php echo $no?></td> 
							<td><?php echo 'Penerimaan Obat/Alkes dari '.$data[$i]['nama_perusahaan'].' / '.$data[$i]['no_po'].' / '.date("d-M-Y", strtotime($data[$i]['tgl_input_po']))?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['qty_po'])?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stok_akhir'])?></td> 
						</tr> 
						<?php
							}
							
							$data = $db->query("select a.*, b.no_ro_gudang, b.tgl_input_transfer from tbl_transfer_detail a left join tbl_transfer b on b.id=a.transferID where a.kode_obat='".$_POST['obat']."' and b.tgl_input_transfer >= '".$_POST['d1']."' and b.tgl_input_transfer <= '".$_POST['d2']."' order by b.tgl_input_transfer desc", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
								//$stock = $db->query()
						?>
						<tr>
							<td style="width: 50px; text-align: center;"><?php echo $no?></td> 
							<td><?php echo 'Transfer Obat dari Gudang Ke Apotik / No: '.$data[$i]['no_ro_gudang'].' / '.date("d-M-Y", strtotime($data[$i]['tgl_input_transfer']))?></td>
							<td style="text-align: right;"><?php echo number_format($data[$i]['qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($biayaFis)?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir']+$data[$i]['qty'])?></td> 
						</tr> 
						<?php	
							}
							
							//untuk resep
							if ($_POST['gudang'] == 'APOTIK') {
    							$data = $db->query("select a.qty, b.no_daftar, c.nama pasien, c.tgl_insert tgl_input_transfer, a.no_resep from tbl_resep_detail a left join tbl_resep b on b.id=a.resep_id left join tbl_kasir c on c.no_daftar=b.no_daftar where a.kode_obat='".$_POST['obat']."' and date(c.tgl_insert) >= '".$_POST['d1']."' and date(c.tgl_insert) <= '".$_POST['d2']."'", 0);
    							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
						?>
						<tr>
							<td style="width: 50px; text-align: center;"><?php echo $no?></td> 
							<td><?php echo 'Penjualan Obat ke Pasien ('.$data[$i]['pasien'].') / No. Resep: '.$data[$i]['no_resep'].' / '.date("d-M-Y", strtotime($data[$i]['tgl_input_transfer']))?></td>
							<td style="text-align: right;">0</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir']+$data[$i]['qty'])?></td> 
						</tr> 
						<?php	
							    }
							}
							
							//untuk Stock Opname Gudang
							$data = $db->query("select a.no_opn_gudang, a.qty, b.tgl_insert from tbl_opname_gudang_detail a left join tbl_opname_gudang b on b.id=a.opn_gudangID where a.kode_obat='".$_POST['obat']."' and date(b.tgl_insert) >= '".$_POST['d1']."' and date(b.tgl_insert) <= '".$_POST['d2']."'", 0);
							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
						?>
						<tr>
							<td style="width: 50px; text-align: center;"><?php echo $no?></td> 
							<td><?php echo 'SO GUDANG / '.$data[$i]['no_opn_gudang'].') /  '.date("d-M-Y", strtotime($data[$i]['tgl_insert']))?></td>
							<td style="text-align: right;">0</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir']+$data[$i]['qty'])?></td> 
						</tr> 
						<?php	
							}
							
							if ($_POST['gudang'] == 'APOTIK') {
    							//untuk Stock Opname Apotik
    							$data = $db->query("select a.no_opn_apotik, a.qty, b.tgl_insert from tbl_opname_apotik_detail a left join tbl_opname_apotik b on b.id=a.opn_apotikID where a.kode_obat='".$_POST['obat']."' and date(b.tgl_insert) >= '".$_POST['d1']."' and date(b.tgl_insert) <= '".$_POST['d2']."'", 0);
    							for ($i = 0; $i < count($data); $i++) {
								$no = $no + 1;
						?>
						<tr>
							<td style="width: 50px; text-align: center;"><?php echo $no?></td> 
							<td><?php echo 'SO APOTIK / '.$data[$i]['no_opn_apotik'].') /  '.date("d-M-Y", strtotime($data[$i]['tgl_insert']))?></td>
							<td style="text-align: right;">0</td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['qty'])?></td> 
							<td style="text-align: right;"><?php echo number_format($data[$i]['stock_akhir']+$data[$i]['qty'])?></td> 
						</tr> 
						<?php	
							    }
							}
						?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>

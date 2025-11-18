<?php
	ini_set("display_errors", 0);
	include "../../3rdparty/engine.php";
?>
<div>
    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
        <thead>
        		<tr>
				<th colspan="5">Detail Pembayaran</th>
			</tr>
        		<tr>
				<th>&nbsp;</th>
				<th>No</th>
				<th>Nama</th>
				<th>Penjamin</th>
				<th>Total</th>
			</tr>
        </thead>
		<?php
			if ($_POST['id'] == 'ALL') {
				$data01 = $db->query("select a.id, b.nm_pasien, a.no_daftar, a.invoiceID from tbl_invoice_detail a left join tbl_pasien b on b.nomr=a.nomr where a.invoiceID='".$_POST['inv']."' and status_bayar='BLM'", 0);
			}
			else {
				$data01 = $db->query("select a.id, b.nm_pasien, a.no_daftar, a.invoiceID from tbl_invoice_detail a left join tbl_pasien b on b.nomr=a.nomr where a.invoiceID='".$_POST['inv']."' and b.pekerjaan='".$_POST['id']."' and status_bayar='BLM'", 0);
			}
			for ($i = 0; $i < count($data01); $i++) {
				$no = $i + 1;
				$nokw = $db->queryItem("select no_kwitansi from tbl_kasir where no_daftar='".$data01[$i]['no_daftar']."'");
				$total = $db->queryItem("select sum(bayar) from tbl_kasir_detail where no_kwitansi='".$nokw."' and payment_to='ASURANSI'");
				$hdr = $db->query("select a.kode_perusahaan, a.nama_perusahaan, b.piutang_kd_coa from tbl_invoice a left join tbl_perusahaan b on b.kode_perusahaan=a.kode_perusahaan where a.id='".$data01[$i]['invoiceID']."'", 0);
		?>
        <tr>
            <td style="width:30px"><input type="checkbox" name="detailInvoice<?php echo $data01[$i]['id']?>" value="<?php echo $data01[$i]['id']?>"></td> 
            <td style="width:30px"><?php echo $no?></td> 
            <td style=""><?php echo $data01[$i]['nm_pasien']?></td> 
            <td style=""><?php echo $hdr[0]['nama_perusahaan']?></td> 
            <td style="width:90px; text-align: right"><?php echo number_format($total)?></td>
        </tr> 
		<?php
				$ttl2 = $ttl2 + $total;
			}
		?>
        <tr>
            <th colspan="4" style="text-align: right; font-weight: bold">Total</th> 
            <th style="width:90px; text-align: right; font-weight: bold"><?php echo number_format($ttl2)?></th>
        </tr> 
    </table>
</div>
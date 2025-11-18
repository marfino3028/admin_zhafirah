<?php
$id_paket=$_GET['id']??0;
$paket=$db->query("SELECT*FROM tbl_paket_keberangkatan WHERE id='$id_paket'");
$p=$paket[0]??[];
$jamaah=$db->query("SELECT*FROM tbl_pendaftaran_jamaah WHERE id_paket_keberangkatan='$id_paket' AND status='active'");
$total_transaksi=$p['harga_paket']*$p['kuota_jamaah'];
$total_bayar=$db->query("SELECT COALESCE(SUM(pb.jumlah_bayar),0)as total FROM tbl_pembayaran pb LEFT JOIN tbl_pendaftaran_jamaah pj ON pb.id_pendaftaran=pj.id WHERE pj.id_paket_keberangkatan='$id_paket'");
$sisa=$total_transaksi-$total_bayar[0]['total'];
?>
<style>
.info-box{background:white;border-radius:10px;padding:20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.info-title{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;padding:12px 20px;border-radius:8px;font-size:16px;font-weight:600;margin-bottom:20px;text-align:center}
.info-row{display:flex;margin-bottom:15px;border-bottom:1px solid #ecf0f1;padding-bottom:10px}
.info-label{width:40%;font-weight:600;color:#2c3e50}
.info-value{width:60%;color:#34495e}
.stat-card{border-radius:10px;padding:25px;color:white;margin-bottom:20px;box-shadow:0 5px 15px rgba(0,0,0,.3);display:flex;align-items:center}
.stat-card.blue{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%)}
.stat-card.green{background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%)}
.stat-card.orange{background:linear-gradient(135deg,#f39c12 0%,#e67e22 100%)}
.stat-icon{font-size:40px;margin-right:20px}
.stat-content h3{font-size:28px;font-weight:700;margin:0}
.stat-content p{font-size:14px;font-weight:600;text-transform:uppercase;opacity:.9;margin:5px 0 0}
.btn-back{background:#f39c12;color:white;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;margin-right:10px}
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:10px 20px;border-radius:8px;cursor:pointer}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
</style>
<div class="row">
<div class="col-md-6">
<div class="info-box">
<div class="info-title">Data Keberangkatan Umroh</div>
<div class="info-row"><div class="info-label">Nama Keberangkatan</div><div class="info-value">(<?=$p['kode_keberangkatan']?>)-<?=$p['nama_paket']?></div></div>
<div class="info-row"><div class="info-label">Tanggal Keberangkatan</div><div class="info-value"><?=date('d M Y',strtotime($p['tanggal_keberangkatan']))?> / <?=$p['jumlah_hari']?> Hari</div></div>
<div class="info-row"><div class="info-label">Nama Maskapai</div><div class="info-value"><?php $m=$db->query("SELECT nama_maskapai,rute_penerbangan FROM tbl_maskapai WHERE id='{$p['id_maskapai']}'");echo$m[0]['nama_maskapai'].' / '.$m[0]['rute_penerbangan'];?></div></div>
<div class="info-row"><div class="info-label">Harga Paket</div><div class="info-value">Rp <?=number_format($p['harga_paket'],0,',','.')?></div></div>
</div>
</div>
<div class="col-md-6">
<div class="stat-card blue"><div class="stat-icon">💰</div><div class="stat-content"><h3>Rp <?=number_format($total_transaksi,0,',','.')?></h3><p>Total Transaksi Manifest</p></div></div>
<div class="stat-card green"><div class="stat-icon">💰</div><div class="stat-content"><h3>Rp <?=number_format($total_bayar[0]['total'],0,',','.')?></h3><p>Total Sudah Pembayaran</p></div></div>
<div class="stat-card orange"><div class="stat-icon">💰</div><div class="stat-content"><h3>Rp <?=number_format($sisa,0,',','.')?></h3><p>Total Sisa Pembayaran</p></div></div>
</div>
</div>
<div class="table-section">
<div style="margin-bottom:20px">
<button onclick="history.back()" class="btn-back">⬅ Kembali</button>
<a href="?mod=manifest&submod=add&id=<?=$id_paket?>" class="btn-add">➕ Tambah Manifest Jamaah</a>
</div>
<div style="margin-bottom:15px">
<label>Show <select style="padding:5px;border:1px solid #ddd;border-radius:5px"><option>10</option></select> entries</label>
<div style="float:right;display:flex;gap:10px">
<button class="btn-action btn-detail">📄 Excel</button>
<button class="btn-action btn-edit">🖨️ Print</button>
<button class="btn-action btn-delete">🔄 Reset</button>
<button class="btn-action btn-detail">🔃 Reload</button>
</div>
</div>
<div style="margin-bottom:15px;float:right"><label>Search: <input type="text" style="padding:5px;border:1px solid #ddd;border-radius:5px"></label></div>
<table class="custom-table">
<thead>
<tr>
<th>No</th>
<th>Tanggal Registrasi</th>
<th>Kode Jamaah</th>
<th>NIK Jamaah</th>
<th>Nama Jamaah (KTP)</th>
<th>Nama Jamaah (PASPOR)</th>
<th>Jenis Kelamin</th>
<th>Tanggal Lahir</th>
<th>Umur</th>
<th>Nomor Paspor</th>
<th>Habis Paspor</th>
<th>Tipe Kamar</th>
<th>Jumlah Pax (Pax)</th>
</tr>
</thead>
<tbody>
<?php if($jamaah){foreach($jamaah as $k=>$r){
$tgl_reg=date('d M Y',strtotime($r['tanggal_registrasi']));
$tgl_lahir=date('d M Y',strtotime($r['tanggal_lahir']));
$umur=date_diff(date_create($r['tanggal_lahir']),date_create('today'))->y;
$habis_paspor=date('d M Y',strtotime($r['habis_paspor']));
?>
<tr>
<td><?=($k+1)?></td>
<td><?=$tgl_reg?></td>
<td><?=$r['kode_registrasi']?></td>
<td><?=$r['nik']?></td>
<td><?=$r['nama_jamaah']?></td>
<td><?=$r['nama_paspor']?></td>
<td><?=$r['jenis_kelamin']?></td>
<td><?=$tgl_lahir?></td>
<td><?=$umur?> th</td>
<td><?=$r['nomor_paspor']?></td>
<td><?=$habis_paspor?></td>
<td><?=$r['tipe_kamar']?></td>
<td><?=$r['jumlah_pax']?></td>
</tr>
<?php }}?>
</tbody>
</table>
</div>

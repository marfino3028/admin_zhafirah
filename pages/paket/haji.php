<?php
$data=$db->query("SELECT*FROM tbl_paket WHERE jenis_paket='haji' ORDER BY nama_paket ASC");
?>
<style>
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
.badge-active{background:#27ae60;color:white;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600}
.btn-action{padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:13px;margin-right:5px}
.btn-edit{background:#f39c12;color:white}
.btn-detail{background:#667eea;color:white}
.btn-delete{background:#95a5a6;color:white}
</style>
<div class="table-section">
<a href="?mod=paket&submod=add_haji" class="btn-add">➕ Tambah Paket Haji</a>
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
<th>Foto Brosur</th>
<th>Kode Paket</th>
<th>Nama Paket</th>
<th>Tanggal Keberangkatan</th>
<th>Jumlah Hari</th>
<th>Nama Maskapai</th>
<th>Rute Penerbangan</th>
<th>Lokasi Keberangkatan</th>
<th>Harga Paket</th>
<th>Kuota Jamaah</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php if($data){foreach($data as $k=>$r){
$tgl=date('d M Y',strtotime($r['tanggal_keberangkatan']));
$maskapai=$db->query("SELECT nama_maskapai,rute_penerbangan FROM tbl_maskapai WHERE id='{$r['id_maskapai']}'");
?>
<tr>
<td><?=($k+1)?></td>
<td><img src="<?=$r['foto_brosur']?>" style="width:50px;height:50px;object-fit:cover;border-radius:5px" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'50\' height=\'50\'%3E%3Crect fill=\'%23ddd\' width=\'50\' height=\'50\'/%3E%3C/svg%3E'"></td>
<td><?=$r['kode_paket']?></td>
<td><strong style="color:#667eea"><?=$r['nama_paket']?></strong></td>
<td><?=$tgl?></td>
<td><?=$r['jumlah_hari']?> Hari</td>
<td><?=$maskapai[0]['nama_maskapai']?></td>
<td><?=$maskapai[0]['rute_penerbangan']?></td>
<td><?=$r['lokasi_keberangkatan']?></td>
<td>Rp <?=number_format($r['harga_paket'],0,',','.')?></td>
<td><?=$r['kuota_jamaah']?> Pax</td>
<td><span class="badge-active">Active</span></td>
<td>
<button class="btn-action btn-edit">✏️</button>
<button class="btn-action btn-detail">👁️</button>
<button class="btn-action btn-delete">🗑️</button>
</td>
</tr>
<?php }}?>
</tbody>
</table>
</div>

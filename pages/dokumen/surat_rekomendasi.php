<?php
$data = $db->query("SELECT sr.*, j.nama_jamaah, j.nik, pk.nama_paket, pk.kode_keberangkatan, pk.tanggal_keberangkatan
    FROM tbl_surat_rekomendasi sr
    LEFT JOIN tbl_pendaftaran_jamaah j ON sr.id_jamaah=j.id
    LEFT JOIN tbl_paket_keberangkatan pk ON j.id_paket_keberangkatan=pk.id
    ORDER BY sr.tanggal_dokumen DESC");
?>
<style>
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.btn-add:hover{transform:translateY(-2px);box-shadow:0 5px 15px rgba(102,126,234,.4);color:white;text-decoration:none}
.table-section{background:white;border-radius:10px;padding:25px;margin-bottom:30px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50;vertical-align:middle}
.custom-table tbody tr:hover{background:#f8f9fa}
.btn-action{padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:13px;margin-right:5px;transition:all .3s}
.btn-edit{background:#f39c12;color:white}
.btn-detail{background:#667eea;color:white}
.btn-delete{background:#95a5a6;color:white}
.btn-action:hover{transform:translateY(-2px);box-shadow:0 3px 10px rgba(0,0,0,.2)}
</style>
<div class="table-section">
    <a href="?mod=dokumen&submod=surat_add" class="btn-add">➕ Tambah Surat Rekomendasi</a>
    <div style="margin-bottom:15px">
        <label>Show <select style="padding:5px;border:1px solid #ddd;border-radius:5px"><option>10</option><option>25</option><option>50</option></select> entries</label>
        <div style="float:right;display:flex;gap:10px">
            <button class="btn-action btn-detail">📄 Excel</button>
            <button class="btn-action btn-edit">🖨️ Print</button>
            <button class="btn-action btn-delete">🔄 Reset</button>
            <button class="btn-action btn-detail">🔃 Reload</button>
        </div>
    </div>
    <div style="margin-bottom:15px;float:right">
        <label>Search: <input type="text" style="padding:5px;border:1px solid #ddd;border-radius:5px"></label>
    </div>
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Dokumen</th>
                    <th>Kode Jamaah</th>
                    <th>NIK Jamaah</th>
                    <th>Nama Jamaah</th>
                    <th>Tanggal Lahir</th>
                    <th>Nama Keberangkatan</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Tanggal Kepulangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($data){foreach($data as $k=>$r){
                    $tgl_dok=date('d M Y',strtotime($r['tanggal_dokumen']));
                    $tgl_lahir=date('d M Y',strtotime($r['tanggal_lahir']));
                    $tgl_berangkat=date('d M Y',strtotime($r['tanggal_keberangkatan']));
                    $tgl_pulang=date('d M Y',strtotime($r['tanggal_kepulangan']));
                ?>
                <tr>
                    <td><?=($k+1)?></td>
                    <td><?=$tgl_dok?></td>
                    <td><?=$r['kode_jamaah']?></td>
                    <td><?=$r['nik']?></td>
                    <td><strong style="color:#667eea"><?=strtoupper($r['nama_jamaah'])?></strong></td>
                    <td><?=$tgl_lahir?></td>
                    <td><strong style="color:#667eea"><?=$r['nama_paket']?></strong></td>
                    <td><?=$tgl_berangkat?></td>
                    <td><?=$tgl_pulang?></td>
                    <td>
                        <button class="btn-action btn-edit">✏️</button>
                        <button class="btn-action btn-detail">👁️</button>
                        <button class="btn-action btn-delete">🗑️</button>
                    </td>
                </tr>
                <?php }}else{echo'<tr><td colspan="10" style="text-align:center">Tidak ada data</td></tr>';}?>
            </tbody>
        </table>
    </div>
    <div style="margin-top:15px;display:flex;justify-content:space-between;align-items:center">
        <p style="margin:0">Showing 1 to <?=count($data)?> of <?=count($data)?> entries</p>
        <div>
            <button class="btn btn-default" style="padding:8px 15px;margin:0 3px">Previous</button>
            <button class="btn btn-primary" style="padding:8px 15px;margin:0 3px;background:#667eea;border:none">1</button>
            <button class="btn btn-default" style="padding:8px 15px;margin:0 3px">Next</button>
        </div>
    </div>
</div>

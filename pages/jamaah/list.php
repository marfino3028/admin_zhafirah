<?php
// Query data jamaah dari tabel users dengan role 'jamaah'
$data = $db->query("
    SELECT 
        id,
        kode_registrasi,
        nik,
        nama_jamaah,
        full_name,
        email,
        whatsapp,
        telepon,
        jenis_kelamin,
        tanggal_lahir,
        kota_kabupaten,
        nama_paspor,
        nomor_paspor,
        status,
        created_at
    FROM users 
    WHERE role = 'jamaah' 
    ORDER BY created_at DESC
");
?>
<style>
.btn-add{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;border:none;padding:12px 25px;border-radius:8px;font-weight:600;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:all .3s;margin-bottom:20px}
.table-section{background:white;border-radius:10px;padding:25px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.custom-table{width:100%;border-collapse:collapse}
.custom-table thead th{background:#f8f9fa;padding:15px 10px;text-align:left;font-size:13px;font-weight:600;color:#2c3e50;border-bottom:2px solid #dee2e6}
.custom-table tbody td{padding:15px 10px;border-bottom:1px solid #ecf0f1;font-size:14px;color:#2c3e50}
.custom-table tbody tr:hover{background:#f8f9fa}
.btn-action{padding:6px 12px;border-radius:6px;border:none;cursor:pointer;font-size:13px;margin-right:5px}
.btn-edit{background:#f39c12;color:white}
.btn-detail{background:#667eea;color:white}
.btn-delete{background:#e74c3c;color:white}
.btn-delete:hover{background:#c0392b}
.btn-edit:hover{background:#e67e22}
.btn-detail:hover{background:#5568d3}
.badge{padding:5px 10px;border-radius:5px;font-size:12px;font-weight:600}
.badge-active{background:#d4edda;color:#155724}
.badge-inactive{background:#f8d7da;color:#721c24}
</style>
<div class="table-section">
    <a href="?mod=jamaah&submod=add" class="btn-add">➕ Tambah Jamaah</a>
    <div style="margin-bottom:15px">
        <label>Show <select id="entries" style="padding:5px;border:1px solid #ddd;border-radius:5px">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select> entries</label>
        <div style="float:right;display:flex;gap:10px">
            <button class="btn-action btn-detail" onclick="exportExcel()">📄 Excel</button>
            <button class="btn-action btn-edit" onclick="window.print()">🖨️ Print</button>
            <button class="btn-action btn-delete" onclick="location.reload()">🔃 Reload</button>
        </div>
    </div>
    <div style="margin-bottom:15px;float:right">
        <label>Search: <input type="text" id="searchInput" style="padding:5px;border:1px solid #ddd;border-radius:5px" onkeyup="searchTable()"></label>
    </div>
    <div style="clear:both"></div>
    <div style="overflow-x:auto">
        <table class="custom-table" id="jamaahTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jamaah</th>
                    <th>NIK</th>
                    <th>Nama Jamaah</th>
                    <th>Kontak</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Umur</th>
                    <th>Kota/Kabupaten</th>
                    <th>Nama Paspor</th>
                    <th>Nomor Paspor</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if($data && count($data) > 0): ?>
                    <?php foreach($data as $k => $r): 
                        // Hitung umur jika tanggal lahir ada
                        $umur = '-';
                        $tgl_lahir = '-';
                        if(!empty($r['tanggal_lahir'])) {
                            $tgl_lahir = date('d M Y', strtotime($r['tanggal_lahir']));
                            $umur = date_diff(date_create($r['tanggal_lahir']), date_create('today'))->y . ' th';
                        }
                        
                        // Nama jamaah prioritas: nama_jamaah > full_name
                        $nama = !empty($r['nama_jamaah']) ? $r['nama_jamaah'] : $r['full_name'];
                        
                        // Kontak prioritas: telepon > whatsapp
                        $kontak = !empty($r['telepon']) ? $r['telepon'] : $r['whatsapp'];
                    ?>
                    <tr>
                        <td><?=($k+1)?></td>
                        <td><?=htmlspecialchars($r['kode_registrasi'] ?? '-')?></td>
                        <td><?=htmlspecialchars($r['nik'] ?? '-')?></td>
                        <td><?=htmlspecialchars($nama ?? '-')?></td>
                        <td><?=htmlspecialchars($kontak ?? '-')?></td>
                        <td><?=htmlspecialchars($r['email'] ?? '-')?></td>
                        <td><?=htmlspecialchars($r['jenis_kelamin'] ?? '-')?></td>
                        <td><?=$tgl_lahir?></td>
                        <td><?=$umur?></td>
                        <td><?=htmlspecialchars($r['kota_kabupaten'] ?? '-')?></td>
                        <td><?=htmlspecialchars($r['nama_paspor'] ?? '-')?></td>
                        <td><?=htmlspecialchars($r['nomor_paspor'] ?? '-')?></td>
                        <td>
                            <span class="badge badge-<?=$r['status']?>">
                                <?=ucfirst($r['status'])?>
                            </span>
                        </td>
                        <td>
                            <a href="?mod=jamaah&submod=edit&id=<?=$r['id']?>" class="btn-action btn-edit" title="Edit">✏️</a>
                            <a href="?mod=jamaah&submod=detail&id=<?=$r['id']?>" class="btn-action btn-detail" title="Detail">👁️</a>
                            <button class="btn-action btn-delete" onclick="confirmDelete(<?=$r['id']?>)" title="Hapus">🗑️</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" style="text-align:center;padding:30px">
                            <p style="font-size:16px;color:#7f8c8d">Belum ada data jamaah</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div style="margin-top:15px;display:flex;justify-content:space-between;align-items:center">
        <p>Showing 1 to <?=count($data)?> of <?=count($data)?> entries</p>
        <div>
            <button style="padding:8px 15px;margin:0 3px;border:1px solid #ddd;background:white;border-radius:5px;cursor:pointer">Previous</button>
            <button style="padding:8px 15px;margin:0 3px;background:#667eea;color:white;border:none;border-radius:5px">1</button>
            <button style="padding:8px 15px;margin:0 3px;border:1px solid #ddd;background:white;border-radius:5px;cursor:pointer">Next</button>
        </div>
    </div>
</div>

<script>
// Fungsi search table
function searchTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('jamaahTable');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 1; i < tr.length; i++) {
        const row = tr[i];
        let found = false;
        const td = row.getElementsByTagName('td');
        
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                const txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        row.style.display = found ? '' : 'none';
    }
}

// Fungsi konfirmasi delete
function confirmDelete(id) {
    if(confirm('Apakah Anda yakin ingin menghapus data jamaah ini?')) {
        window.location.href = '?mod=jamaah&submod=delete&id=' + id;
    }
}

// Fungsi export Excel
function exportExcel() {
    const table = document.getElementById('jamaahTable');
    let html = table.outerHTML;
    const url = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'data_jamaah_' + new Date().getTime() + '.xls';
    link.click();
}
</script>

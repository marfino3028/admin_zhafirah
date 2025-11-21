<?php
// Mengambil data pendaftaran umroh dari tabel 'bookings'
$data = $db->query("
    SELECT 
        b.id as booking_id,
        b.booking_code,
        b.booking_date,
        b.status as booking_status,
        u.nik,
        u.full_name,
        u.gender,
        u.birth_date,
        u.city,
        p.name as package_name,
        p.package_code,
        p.departure_date,
        (SELECT COUNT(*) FROM bookings WHERE package_id = p.id AND status NOT IN ('cancelled', 'refunded')) as pax_count
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN packages p ON b.package_id = p.id
    WHERE p.package_type = 'umroh' AND b.status NOT IN ('cancelled', 'refunded')
    ORDER BY b.booking_date DESC
");
?>

<style>
.table-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.btn-add {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
    margin-bottom: 20px;
}
.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}
.table-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.btn-action {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 13px;
    margin-right: 5px;
    transition: all 0.3s;
}
.btn-edit {
    background: #f39c12;
    color: white;
}
.btn-detail {
    background: #667eea;
    color: white;
}
.btn-delete {
    background: #95a5a6;
    color: white;
}
.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}
.custom-table {
    width: 100%;
    border-collapse: collapse;
}
.custom-table thead th {
    background: #f8f9fa;
    padding: 15px 10px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #dee2e6;
}
.custom-table tbody td {
    padding: 15px 10px;
    border-bottom: 1px solid #ecf0f1;
    font-size: 14px;
    color: #2c3e50;
    vertical-align: middle;
}
.custom-table tbody tr:hover {
    background: #f8f9fa;
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="table-section">
            <a href="?page=pendaftaran/umroh_add" class="btn-add">
                ➕ Tambah Pendaftaran Umroh
            </a>

            <div style="margin-bottom: 15px;">
                <label>Show 
                    <select style="padding: 5px; border: 1px solid #ddd; border-radius: 5px;">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    entries
                </label>
                <div style="float: right; display: flex; gap: 10px;">
                    <button class="btn-action btn-detail">📄 Excel</button>
                    <button class="btn-action btn-edit">🖨️ Print</button>
                    <button class="btn-action btn-delete">🔄 Reset</button>
                    <button class="btn-action btn-detail">🔃 Reload</button>
                </div>
            </div>

            <div style="margin-bottom: 15px; float: right;">
                <label>Search: <input type="text" style="padding: 5px; border: 1px solid #ddd; border-radius: 5px;"></label>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Registrasi</th>
                            <th>Kode Registrasi</th>
                            <th>NIK Jamaah</th>
                            <th>Nama Jamaah</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Kota / Kabupaten</th>
                            <th>Nama Keberangkatan</th>
                            <th>Jumlah Jamaah (Pax)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($data) {
                            foreach($data as $key => $row) { 
                                $tgl_registrasi = date('d M Y', strtotime($row['booking_date']));
                                $tgl_lahir = date('d M Y', strtotime($row['birth_date']));
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><?php echo $tgl_registrasi; ?></td>
                            <td><?php echo $row['booking_code']; ?></td>
                            <td><?php echo $row['nik']; ?></td>
                            <td><strong style="color: #667eea;"><?php echo strtoupper($row['full_name']); ?></strong></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $tgl_lahir; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><strong style="color: #667eea;"><?php echo $row['package_name']; ?></strong></td>
                            <td><?php echo $row['pax_count']; ?> Pax</td>
                            <td>
                                <a href="#" class="btn-action btn-edit" title="Edit">✏️</a>
                                <a href="#" class="btn-action btn-delete" title="Delete">🗑️</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="11" style="text-align:center;">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                <p style="margin: 0;">Showing 1 to <?php echo count($data); ?> of <?php echo count($data); ?> entries</p>
                <div>
                    <button class="btn btn-default" style="padding: 8px 15px; margin: 0 3px;">Previous</button>
                    <button class="btn btn-primary" style="padding: 8px 15px; margin: 0 3px; background: #667eea; border: none;">1</button>
                    <button class="btn btn-default" style="padding: 8px 15px; margin: 0 3px;">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Get list paket keberangkatan haji untuk filter
$paket_list = $db->query("SELECT * FROM tbl_paket_keberangkatan WHERE jenis_paket='haji' ORDER BY tanggal_keberangkatan DESC");

// Handle filter
$where = "WHERE pk.jenis_paket='haji'";
$id_paket = '';
if(isset($_POST['id_paket_keberangkatan']) && $_POST['id_paket_keberangkatan'] != '') {
    $id_paket = $_POST['id_paket_keberangkatan'];
    $where .= " AND ph.id_paket_keberangkatan = '$id_paket'";
}

// Get total pengeluaran haji
$total = $db->query("SELECT COALESCE(SUM(ph.jumlah), 0) as total 
    FROM tbl_pengeluaran_haji ph
    LEFT JOIN tbl_paket_keberangkatan pk ON ph.id_paket_keberangkatan=pk.id
    $where");

// Get data pengeluaran haji
$data = $db->query("SELECT ph.*, pk.nama_paket, pk.kode_keberangkatan
    FROM tbl_pengeluaran_haji ph
    LEFT JOIN tbl_paket_keberangkatan pk ON ph.id_paket_keberangkatan=pk.id
    $where 
    ORDER BY ph.tanggal_pengeluaran DESC");
?>

<style>
.filter-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.filter-title {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}
.form-label {
    font-size: 14px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}
.form-control, .form-select {
    border: 1px solid #dfe4ea;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
    width: 100%;
}
.btn-search {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
}
.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}
.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    padding: 25px;
    color: white;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}
.stat-icon {
    font-size: 40px;
    margin-bottom: 10px;
}
.stat-amount {
    font-size: 32px;
    font-weight: 700;
    margin: 10px 0 5px 0;
}
.stat-label {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    opacity: 0.9;
}
.table-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
}
.custom-table tbody tr:hover {
    background: #f8f9fa;
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
    background: #e74c3c;
    color: white;
}
.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}
</style>

<div class="row">
    <div class="col-md-8">
        <div class="filter-section">
            <div class="filter-title">Filter Data Keberangkatan Haji</div>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Nama Keberangkatan Haji <span style="color:red;">*</span></label>
                    <select name="id_paket_keberangkatan" class="form-select" required>
                        <option value="">Pilih Nama Keberangkatan Haji</option>
                        <?php 
                        if($paket_list) {
                            foreach($paket_list as $paket) { 
                                $selected = ($id_paket == $paket['id']) ? 'selected' : '';
                                $tanggal = date('d M Y', strtotime($paket['tanggal_keberangkatan']));
                        ?>
                        <option value="<?php echo $paket['id']; ?>" <?php echo $selected; ?>>
                            <?php echo $paket['kode_keberangkatan']; ?> | <?php echo $paket['nama_paket']; ?>
                        </option>
                        <?php 
                            }
                        } 
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn-search">🔍 Cari</button>
            </form>
        </div>

        <div class="table-section">
            <div class="table-controls">
                <a href="?page=pengeluaran/form_pengeluaran_haji" class="btn-add">
                    ➕ Tambah Pengeluaran Haji
                </a>
                <div>
                    <button class="btn-action btn-detail">📄 Excel</button>
                    <button class="btn-action btn-edit">🖨️ Print</button>
                    <button class="btn-action btn-delete">🔄 Reset</button>
                    <button class="btn-action btn-detail">🔃 Reload</button>
                </div>
            </div>

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
                <div style="float: right;">
                    <label>Search: <input type="text" style="padding: 5px; border: 1px solid #ddd; border-radius: 5px;"></label>
                </div>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengeluaran</th>
                            <th>Kode Pengeluaran</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Nama Pengeluaran</th>
                            <th>Jumlah Pengeluaran</th>
                            <th>Nama Keberangkatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($data) {
                            foreach($data as $key => $row) { 
                                $tanggal = date('d M Y', strtotime($row['tanggal_pengeluaran']));
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $row['kode_pengeluaran']; ?></td>
                            <td><?php echo ucfirst($row['jenis_pengeluaran']); ?></td>
                            <td><?php echo $row['nama_pengeluaran']; ?></td>
                            <td>Rp <?php echo number_format($row['jumlah'], 0, ',', '.'); ?></td>
                            <td><?php echo $row['kode_keberangkatan']; ?> | <?php echo $row['nama_paket']; ?></td>
                            <td>
                                <button class="btn-action btn-edit">✏️</button>
                                <button class="btn-action btn-detail">👁️</button>
                                <button class="btn-action btn-delete">🗑️</button>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="8" style="text-align:center;">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 15px;">
                <p>Showing 1 to <?php echo count($data); ?> of <?php echo count($data); ?> entries</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-amount">Rp <?php echo number_format($total[0]['total'], 0, ',', '.'); ?></div>
            <div class="stat-label">Total Pengeluaran Haji</div>
        </div>
    </div>
</div>

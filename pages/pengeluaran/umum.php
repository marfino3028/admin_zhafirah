<?php
// Handle filter
$where = "WHERE 1=1";
if(isset($_POST['bulan']) && $_POST['bulan'] != '') {
    $bulan = $_POST['bulan'];
    $where .= " AND DATE_FORMAT(tanggal_pengeluaran, '%Y-%m') = '$bulan'";
}

// Get total pengeluaran umum
$total = $db->query("SELECT COALESCE(SUM(jumlah_pengeluaran), 0) as total FROM tbl_pengeluaran_umum $where");

// Get data pengeluaran
$data = $db->query("SELECT * FROM tbl_pengeluaran_umum $where ORDER BY tanggal_pengeluaran DESC");
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
.form-control {
    border: 1px solid #dfe4ea;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 14px;
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
    background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
    border-radius: 10px;
    padding: 25px;
    color: white;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(238, 9, 121, 0.3);
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
            <div class="filter-title">Filter Periode Bulanan</div>
            <form method="POST" action="">
                <div class="form-group">
                    <label class="form-label">Pilih Periode Bulanan</label>
                    <input type="month" name="bulan" class="form-control" value="<?php echo isset($_POST['bulan']) ? $_POST['bulan'] : ''; ?>">
                </div>
                <button type="submit" class="btn-search">🔍 Cari</button>
            </form>
        </div>

        <div class="table-section">
            <div class="table-controls">
                <a href="?page=pengeluaran/form_pengeluaran_umum" class="btn-add">
                    ➕ Tambah Pengeluaran Umum
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
                            <td>Rp <?php echo number_format($row['jumlah_pengeluaran'], 0, ',', '.'); ?></td>
                            <td>
                                <button class="btn-action btn-edit">✏️</button>
                                <button class="btn-action btn-detail">👁️</button>
                                <button class="btn-action btn-delete">🗑️</button>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="7" style="text-align:center;">Tidak ada data</td></tr>';
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
            <div class="stat-label">Total Pengeluaran Umum</div>
        </div>
    </div>
</div>

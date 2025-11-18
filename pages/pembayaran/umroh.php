<?php
// Get list jamaah dan paket untuk filter
$jamaah_list = $db->query("SELECT pj.*, pk.nama_paket 
    FROM tbl_pendaftaran_jamaah pj 
    LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id
    WHERE pk.jenis_paket='umroh' AND pj.status='active'
    ORDER BY pj.nama_jamaah ASC");

$paket_list = $db->query("SELECT * FROM tbl_paket_keberangkatan WHERE jenis_paket='umroh' ORDER BY tanggal_keberangkatan DESC");

// Handle filter
$where = "WHERE pk.jenis_paket='umroh'";
$id_jamaah = '';
$id_paket = '';

if(isset($_POST['id_jamaah']) && $_POST['id_jamaah'] != '') {
    $id_jamaah = $_POST['id_jamaah'];
    $where .= " AND pb.id_pendaftaran = '$id_jamaah'";
}
if(isset($_POST['id_paket_keberangkatan']) && $_POST['id_paket_keberangkatan'] != '') {
    $id_paket = $_POST['id_paket_keberangkatan'];
    $where .= " AND pj.id_paket_keberangkatan = '$id_paket'";
}

// Get data pembayaran umroh
$data = $db->query("SELECT pb.*, pj.nama_jamaah, pj.kode_registrasi, pk.nama_paket, pk.kode_keberangkatan
    FROM tbl_pembayaran pb
    LEFT JOIN tbl_pendaftaran_jamaah pj ON pb.id_pendaftaran=pj.id
    LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id
    $where
    ORDER BY pb.tanggal_bayar DESC");
?>

<style>
.filter-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.filter-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}
.filter-col {
    flex: 1;
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
    display: block;
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
    vertical-align: middle;
}
.custom-table tbody tr:hover {
    background: #f8f9fa;
}
.badge-check {
    background: #e74c3c;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-confirmed {
    background: #27ae60;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
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
.btn-print {
    background: #95a5a6;
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
</style>

<div class="row">
    <div class="col-md-12">
        <div class="filter-section">
            <div class="filter-row">
                <div class="filter-col">
                    <div class="filter-title">Filter Data Jamaah</div>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="form-label">Pilih Nama Jamaah</label>
                            <select name="id_jamaah" class="form-select">
                                <option value="">Pilih Nama Jamaah</option>
                                <?php 
                                if($jamaah_list) {
                                    foreach($jamaah_list as $jamaah) { 
                                        $selected = ($id_jamaah == $jamaah['id']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $jamaah['id']; ?>" <?php echo $selected; ?>>
                                    <?php echo $jamaah['nama_jamaah']; ?>
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

                <div class="filter-col">
                    <div class="filter-title">Filter Data Keberangkatan Umroh</div>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="form-label">Pilih Nama Keberangkatan Umroh</label>
                            <select name="id_paket_keberangkatan" class="form-select">
                                <option value="">Pilih Nama Keberangkatan Umroh</option>
                                <?php 
                                if($paket_list) {
                                    foreach($paket_list as $paket) { 
                                        $selected = ($id_paket == $paket['id']) ? 'selected' : '';
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
            </div>
        </div>

        <div class="table-section">
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
                            <th>Tanggal Pembayaran</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Jamaah</th>
                            <th>Nama Keberangkatan</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Kode Referensi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($data) {
                            foreach($data as $key => $row) { 
                                $tanggal = date('d M Y', strtotime($row['tanggal_bayar']));
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $row['kode_transaksi']; ?></td>
                            <td><strong style="color: #667eea;"><?php echo strtoupper($row['nama_jamaah']); ?></strong></td>
                            <td><strong style="color: #667eea;"><?php echo $row['nama_paket']; ?></strong></td>
                            <td>Rp <?php echo number_format($row['jumlah_bayar'], 0, ',', '.'); ?></td>
                            <td><?php echo ucfirst($row['metode_bayar']); ?></td>
                            <td>
                                <?php if($row['status_pembayaran'] == 'confirmed') { ?>
                                    <span class="badge-confirmed">Confirmed</span>
                                <?php } else { ?>
                                    <span class="badge-check">Check</span>
                                <?php } ?>
                            </td>
                            <td><?php echo $row['kode_referensi']; ?></td>
                            <td>
                                <button class="btn-action btn-edit" title="Edit">✏️</button>
                                <button class="btn-action btn-print" title="Print">🖨️</button>
                                <button class="btn-action btn-delete" title="Delete">🗑️</button>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="10" style="text-align:center;">Tidak ada data</td></tr>';
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

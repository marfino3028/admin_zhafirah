<?php
// Get dashboard statistics
$total_transaksi_umroh = $db->query("SELECT COALESCE(SUM(harga_paket * kuota_jamaah), 0) as total FROM tbl_paket_keberangkatan WHERE jenis_paket='umroh'");
$total_pembayaran_umroh = $db->query("SELECT COALESCE(SUM(jumlah_bayar), 0) as total FROM tbl_pembayaran p LEFT JOIN tbl_pendaftaran_jamaah pj ON p.id_pendaftaran=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='umroh'");
$sisa_tagihan_umroh = $total_transaksi_umroh[0]['total'] - $total_pembayaran_umroh[0]['total'];

$total_transaksi_haji = $db->query("SELECT COALESCE(SUM(harga_paket * kuota_jamaah), 0) as total FROM tbl_paket_keberangkatan WHERE jenis_paket='haji'");
$total_pembayaran_haji = $db->query("SELECT COALESCE(SUM(jumlah_bayar), 0) as total FROM tbl_pembayaran p LEFT JOIN tbl_pendaftaran_jamaah pj ON p.id_pendaftaran=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='haji'");
$sisa_tagihan_haji = $total_transaksi_haji[0]['total'] - $total_pembayaran_haji[0]['total'];

$total_jamaah_umroh = $db->query("SELECT COUNT(*) as total FROM tbl_pendaftaran_jamaah pj LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='umroh'");
$total_jamaah_haji = $db->query("SELECT COUNT(*) as total FROM tbl_pendaftaran_jamaah pj LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='haji'");

$total_tabungan_umroh = $db->query("SELECT COALESCE(SUM(jumlah), 0) as total FROM tbl_tabungan t LEFT JOIN tbl_pendaftaran_jamaah pj ON t.id_jamaah=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='umroh'");
$total_tabungan_haji = $db->query("SELECT COALESCE(SUM(jumlah), 0) as total FROM tbl_tabungan t LEFT JOIN tbl_pendaftaran_jamaah pj ON t.id_jamaah=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='haji'");

$total_jamaah_tabungan_umroh = $db->query("SELECT COUNT(DISTINCT t.id_jamaah) as total FROM tbl_tabungan t LEFT JOIN tbl_pendaftaran_jamaah pj ON t.id_jamaah=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='umroh'");
$total_jamaah_tabungan_haji = $db->query("SELECT COUNT(DISTINCT t.id_jamaah) as total FROM tbl_tabungan t LEFT JOIN tbl_pendaftaran_jamaah pj ON t.id_jamaah=pj.id LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket_keberangkatan=pk.id WHERE pk.jenis_paket='haji'");
?>

<style>
.dashboard-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    transition: transform 0.3s;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
.dashboard-icon {
    width: 70px;
    height: 70px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 30px;
    color: white;
}
.dashboard-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.dashboard-icon.green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
.dashboard-icon.red { background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%); }
.dashboard-content h3 {
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 28px;
    font-weight: 700;
}
.dashboard-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
}
.section-title {
    font-size: 18px;
    color: #95a5a6;
    margin: 30px 0 15px 0;
    font-weight: 600;
}
</style>

<div class="row">
    <div class="col-md-12">
        <h2 style="color: #2c3e50; font-weight: 700; margin-bottom: 30px;">Data Dashboard</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_transaksi_umroh[0]['total'], 0, ',', '.'); ?></h3>
                <p>Total Transaksi Umroh</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon green">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_pembayaran_umroh[0]['total'], 0, ',', '.'); ?></h3>
                <p>Sudah Pembayaran Umroh</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon red">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($sisa_tagihan_umroh, 0, ',', '.'); ?></h3>
                <p>Sisa Tagihan Umroh</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_transaksi_haji[0]['total'], 0, ',', '.'); ?></h3>
                <p>Total Transaksi Haji</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon green">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_pembayaran_haji[0]['total'], 0, ',', '.'); ?></h3>
                <p>Sudah Pembayaran Haji</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="dashboard-card">
            <div class="dashboard-icon red">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($sisa_tagihan_haji, 0, ',', '.'); ?></h3>
                <p>Sisa Tagihan Haji</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">👥</div>
            <div class="dashboard-content">
                <h3><?php echo $total_jamaah_umroh[0]['total']; ?> Jamaah</h3>
                <p>Total Jamaah Umroh</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">👥</div>
            <div class="dashboard-content">
                <h3><?php echo $total_jamaah_haji[0]['total']; ?> Jamaah</h3>
                <p>Total Jamaah Haji</p>
            </div>
        </div>
    </div>
</div>

<p class="section-title">Data Tabungan</p>

<div class="row">
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon green">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_tabungan_umroh[0]['total'], 0, ',', '.'); ?></h3>
                <p>Total Tabungan Umroh</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon green">💰</div>
            <div class="dashboard-content">
                <h3>Rp <?php echo number_format($total_tabungan_haji[0]['total'], 0, ',', '.'); ?></h3>
                <p>Total Tabungan Haji</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">👥</div>
            <div class="dashboard-content">
                <h3><?php echo $total_jamaah_tabungan_umroh[0]['total']; ?> Jamaah</h3>
                <p>Total Jamaah Tabungan Umroh</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="dashboard-card">
            <div class="dashboard-icon blue">👥</div>
            <div class="dashboard-content">
                <h3><?php echo $total_jamaah_tabungan_haji[0]['total']; ?> Jamaah</h3>
                <p>Total Jamaah Tabungan Haji</p>
            </div>
        </div>
    </div>
</div>

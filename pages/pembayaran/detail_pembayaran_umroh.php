<?php
$sidebar = "pembayaran";
$sidebarSub = "pembayaran_umroh";
include "../functions/koneksi.php";
include "header.php";

// Get jamaah ID from URL
$id_jamaah = isset($_GET['id_jamaah']) ? mysqli_real_escape_string($con, $_GET['id_jamaah']) : '';

// Get jamaah data
$jamaah = null;
$keberangkatan = null;
$total_harga_paket = 0;
$total_sudah_bayar = 0;
$sisa_pembayaran = 0;

if($id_jamaah) {
    // Get jamaah and keberangkatan info
    $query = "SELECT j.*, k.nama_keberangkatan, k.kode_keberangkatan, k.tanggal_keberangkatan, 
              p.nama_paket, p.harga_paket, k.id_keberangkatan
              FROM jamaah j
              LEFT JOIN keberangkatan k ON j.id_keberangkatan = k.id_keberangkatan
              LEFT JOIN paket p ON k.id_paket = p.id_paket
              WHERE j.id_jamaah = '$id_jamaah'";
    $result = mysqli_query($con, $query);
    $jamaah = mysqli_fetch_object($result);
    
    if($jamaah) {
        $total_harga_paket = $jamaah->harga_paket;
        
        // Get total pembayaran
        $query_bayar = "SELECT COALESCE(SUM(jumlah_pembayaran), 0) as total_bayar 
                       FROM pembayaran 
                       WHERE id_jamaah = '$id_jamaah' 
                       AND status_pembayaran = 'Check'";
        $result_bayar = mysqli_query($con, $query_bayar);
        $row_bayar = mysqli_fetch_object($result_bayar);
        $total_sudah_bayar = $row_bayar->total_bayar;
        
        $sisa_pembayaran = $total_harga_paket - $total_sudah_bayar;
    }
}

// Get list pembayaran
$query_pembayaran = "SELECT * FROM pembayaran 
                     WHERE id_jamaah = '$id_jamaah' 
                     ORDER BY tanggal_pembayaran DESC";
$result_pembayaran = mysqli_query($con, $query_pembayaran);
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Data Pembayaran Jamaah Umroh</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Pembayaran Jamaah Umroh</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <!-- Breadcrumb -->
        <div class="row mb-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../">Home</a></li>
                        <li class="breadcrumb-item"><a href="list_manifest_umroh.php">Data Manifest Jamaah Umroh - <?php echo $jamaah ? $jamaah->kode_keberangkatan : ''; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pembayaran Jamaah Umroh - <?php echo $jamaah ? $jamaah->kode_jamaah : ''; ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if(!$jamaah): ?>
            <div class="alert alert-warning">
                <strong>Peringatan!</strong> Data jamaah tidak ditemukan.
            </div>
        <?php else: ?>

        <!-- Info Jamaah Card -->
        <div class="row mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h4 class="card-title text-white mb-0">Data Pembayaran Jamaah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="150"><strong>Nama Jamaah</strong></td>
                                        <td>: <?php echo $jamaah->kode_jamaah . ' - ' . $jamaah->nama_jamaah; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Lahir</strong></td>
                                        <td>: <?php echo date('d M Y', strtotime($jamaah->tanggal_lahir)) . ' / ' . hitung_umur($jamaah->tanggal_lahir) . ' th'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kontak Jamaah</strong></td>
                                        <td>: <?php echo $jamaah->no_hp . ' / ' . ($jamaah->kota ? $jamaah->kota : '-'); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="180"><strong>Nama Keberangkatan</strong></td>
                                        <td>: <?php echo $jamaah->kode_keberangkatan . ' - ' . $jamaah->nama_keberangkatan; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-2">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-big text-center">
                                <i class="fas fa-wallet" style="font-size: 40px;"></i>
                            </div>
                            <div class="ml-3">
                                <h6 class="mb-0">Rp <?php echo number_format($total_harga_paket, 0, ',', '.'); ?></h6>
                                <small>TOTAL HARGA PAKET</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-success text-white mb-2">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-big text-center">
                                <i class="fas fa-wallet" style="font-size: 40px;"></i>
                            </div>
                            <div class="ml-3">
                                <h6 class="mb-0">Rp <?php echo number_format($total_sudah_bayar, 0, ',', '.'); ?></h6>
                                <small>TOTAL SUDAH PEMBAYARAN</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-warning text-white">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-big text-center">
                                <i class="fas fa-wallet" style="font-size: 40px;"></i>
                            </div>
                            <div class="ml-3">
                                <h6 class="mb-0">Rp <?php echo number_format($sisa_pembayaran, 0, ',', '.'); ?></h6>
                                <small>TOTAL SISA PEMBAYARAN</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="list_manifest_umroh.php?id=<?php echo $jamaah->id_keberangkatan; ?>" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPembayaran">
                    <i class="fas fa-plus"></i> Tambah Pembayaran
                </button>
                <button type="button" class="btn btn-info" onclick="printMutasi()">
                    <i class="fas fa-print"></i> Print Mutasi
                </button>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Tabel Pembayaran -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablePembayaran" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="12%">Tanggal Pembayaran</th>
                                        <th width="15%">Kode Transaksi</th>
                                        <th width="15%">Nama Jamaah</th>
                                        <th width="15%">Jumlah Pembayaran</th>
                                        <th width="10%">Metode Pembayaran</th>
                                        <th width="10%">Status Pembayaran</th>
                                        <th width="10%">Kode Referensi</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    while($row = mysqli_fetch_object($result_pembayaran)): 
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo date('d M Y', strtotime($row->tanggal_pembayaran)); ?></td>
                                        <td><?php echo $row->kode_transaksi; ?></td>
                                        <td><?php echo $jamaah->nama_jamaah; ?></td>
                                        <td>Rp <?php echo number_format($row->jumlah_pembayaran, 0, ',', '.'); ?></td>
                                        <td><?php echo $row->metode_pembayaran; ?></td>
                                        <td>
                                            <?php if($row->status_pembayaran == 'Check'): ?>
                                                <span class="badge badge-success">Check</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row->kode_referensi ? $row->kode_referensi : '-'; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="editPembayaran(<?php echo $row->id_pembayaran; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-info" onclick="printPembayaran(<?php echo $row->id_pembayaran; ?>)">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deletePembayaran(<?php echo $row->id_pembayaran; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php endif; ?>
    </div>
</div>

<!-- Modal Tambah Pembayaran -->
<div class="modal fade" id="modalTambahPembayaran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Pembayaran</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="proses_pembayaran_umroh.php" method="post" id="formPembayaran">
                <div class="modal-body">
                    <input type="hidden" name="id_jamaah" value="<?php echo $id_jamaah; ?>">
                    <input type="hidden" name="id_keberangkatan" value="<?php echo $jamaah->id_keberangkatan; ?>">
                    <input type="hidden" name="action" value="add">

                    <div class="form-group">
                        <label>Tanggal Pembayaran <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal_pembayaran" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Metode Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-control" name="metode_pembayaran" required>
                            <option value="Transfer">Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="Kartu Kredit">Kartu Kredit</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Pembayaran <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="jumlah_pembayaran" id="jumlah_pembayaran_modal" placeholder="0" required>
                        <small class="text-muted">Sisa: Rp <?php echo number_format($sisa_pembayaran, 0, ',', '.'); ?></small>
                    </div>

                    <div class="form-group">
                        <label>Kode Referensi</label>
                        <input type="text" class="form-control" name="kode_referensi" placeholder="Nomor referensi/bukti transfer (opsional)">
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" name="catatan_pembayaran" rows="3" placeholder="Catatan pembayaran (opsional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // DataTable
    $('#tablePembayaran').DataTable({
        "pageLength": 10,
        "ordering": true,
        "info": true,
        "searching": true
    });

    // Format currency
    $('#jumlah_pembayaran_modal').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(formatRupiah(value));
    });

    // Form submit
    $('#formPembayaran').submit(function(e) {
        let jumlah = $('#jumlah_pembayaran_modal').val().replace(/\D/g, '');
        let sisa = <?php echo $sisa_pembayaran; ?>;
        
        if (parseInt(jumlah) > sisa) {
            e.preventDefault();
            swal('Peringatan', 'Jumlah pembayaran melebihi sisa yang harus dibayar', 'warning');
            return false;
        }

        // Set hidden input for clean number
        $('<input>').attr({
            type: 'hidden',
            name: 'jumlah_pembayaran_clean',
            value: jumlah
        }).appendTo(this);
    });
});

function formatRupiah(angka) {
    let number_string = angka.toString();
    let split = number_string.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah;
}

function editPembayaran(id) {
    window.location.href = 'edit_pembayaran_umroh.php?id=' + id;
}

function printPembayaran(id) {
    window.open('print_pembayaran.php?id=' + id, '_blank');
}

function printMutasi() {
    window.open('print_mutasi_pembayaran.php?id_jamaah=<?php echo $id_jamaah; ?>', '_blank');
}

function deletePembayaran(id) {
    swal({
        title: 'Apakah Anda yakin?',
        text: "Data pembayaran akan dihapus permanen!",
        type: 'warning',
        buttons: {
            cancel: {
                visible: true,
                text: 'Batal',
                className: 'btn btn-secondary'
            },
            confirm: {
                text: 'Ya, Hapus!',
                className: 'btn btn-danger'
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = 'proses_pembayaran_umroh.php?action=delete&id=' + id + '&id_jamaah=<?php echo $id_jamaah; ?>';
        }
    });
}

function hitung_umur(tanggal_lahir) {
    <?php 
    function hitung_umur($tanggal_lahir) {
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        $umur = $today->diff($birthDate)->y;
        return $umur;
    }
    ?>
}
</script>

<?php include "footer.php"; ?>

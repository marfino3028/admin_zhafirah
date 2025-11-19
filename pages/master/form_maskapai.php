<?php
$sidebar = "master";
$sidebarSub = "maskapai";
include "../functions/koneksi.php";
include "header.php";

// Check if editing
$maskapai = null;
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query_maskapai = mysqli_query($con, "SELECT * FROM maskapai WHERE id_maskapai = '$id'");
    $maskapai = mysqli_fetch_object($query_maskapai);
}
?>

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold"><?php echo isset($maskapai) ? 'Edit' : 'Tambah'; ?> Data Maskapai</h2>
                    <h5 class="text-white op-7 mb-2">Kelola Data Maskapai</h5>
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
                        <li class="breadcrumb-item"><a href="list_maskapai.php">Data Maskapai</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo isset($maskapai) ? 'Edit' : 'Tambah'; ?> Data Maskapai</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="list_maskapai.php" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formMaskapai').submit();">
                    <i class="fas fa-save"></i> Tambah Maskapai
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

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="proses_maskapai.php" method="post" id="formMaskapai">
                            
                            <!-- Section: Data Maskapai -->
                            <div class="section-header text-center mb-4 p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
                                <h4 class="mb-0" style="font-weight: 600;">Data Maskapai</h4>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Kode Maskapai <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="kode_maskapai" id="kode_maskapai"
                                           value="<?php echo isset($maskapai->kode_maskapai) ? $maskapai->kode_maskapai : 'MK-'; ?>" 
                                           placeholder="MK-" required readonly style="background-color: #e9ecef;">
                                </div>
                                <label class="col-md-2 col-form-label">Nama Maskapai <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="nama_maskapai" 
                                           value="<?php echo isset($maskapai->nama_maskapai) ? $maskapai->nama_maskapai : ''; ?>" 
                                           placeholder="Masukkan nama maskapai" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Rute Penerbangan <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <select class="form-control" name="rute_penerbangan" required>
                                        <option value="">Direct</option>
                                        <option value="Direct" <?php echo (isset($maskapai->rute_penerbangan) && $maskapai->rute_penerbangan == 'Direct') ? 'selected' : ''; ?>>Direct</option>
                                        <option value="Transit 1x" <?php echo (isset($maskapai->rute_penerbangan) && $maskapai->rute_penerbangan == 'Transit 1x') ? 'selected' : ''; ?>>Transit 1x</option>
                                        <option value="Transit 2x" <?php echo (isset($maskapai->rute_penerbangan) && $maskapai->rute_penerbangan == 'Transit 2x') ? 'selected' : ''; ?>>Transit 2x</option>
                                    </select>
                                </div>
                                <label class="col-md-3 col-form-label">Lama Perjalanan (Jam) <span class="text-danger">*</span></label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="lama_perjalanan" 
                                           value="<?php echo isset($maskapai->lama_perjalanan) ? $maskapai->lama_perjalanan : ''; ?>" 
                                           placeholder="0" min="0" step="0.5" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Harga Tiket</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="harga_tiket" id="harga_tiket"
                                           value="<?php echo isset($maskapai->harga_tiket) ? number_format($maskapai->harga_tiket, 0, ',', '.') : ''; ?>" 
                                           placeholder="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Catatan Keberangkatan</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="catatan_keberangkatan" rows="4" 
                                              placeholder="Masukkan catatan keberangkatan (opsional)"><?php echo isset($maskapai->catatan_keberangkatan) ? $maskapai->catatan_keberangkatan : ''; ?></textarea>
                                </div>
                            </div>

                            <!-- Hidden field for ID if editing -->
                            <?php if(isset($maskapai->id_maskapai)): ?>
                                <input type="hidden" name="id_maskapai" value="<?php echo $maskapai->id_maskapai; ?>">
                                <input type="hidden" name="action" value="edit">
                            <?php else: ?>
                                <input type="hidden" name="action" value="add">
                            <?php endif; ?>

                            <!-- Submit Buttons -->
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <a href="list_maskapai.php" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-generate kode maskapai on page load
    <?php if(!isset($maskapai->id_maskapai)): ?>
    generateKodeMaskapai();
    <?php endif; ?>

    // Format currency input
    $('#harga_tiket').on('input', function() {
        let value = $(this).val().replace(/\D/g, '');
        $(this).val(formatRupiah(value));
    });

    // Form validation
    $('#formMaskapai').submit(function(e) {
        let harga = $('#harga_tiket').val().replace(/\D/g, '');
        
        if (harga != '' && parseInt(harga) < 0) {
            e.preventDefault();
            swal('Peringatan', 'Harga tiket tidak valid', 'warning');
            return false;
        }

        // Set hidden input for clean number
        if (harga != '') {
            $('<input>').attr({
                type: 'hidden',
                name: 'harga_tiket_clean',
                value: harga
            }).appendTo(this);
        }
    });
});

function generateKodeMaskapai() {
    $.ajax({
        url: 'ajax_generate_kode_maskapai.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#kode_maskapai').val(response.kode);
            }
        },
        error: function() {
            console.log('Gagal generate kode maskapai');
        }
    });
}

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

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}
</script>

<?php include "footer.php"; ?>

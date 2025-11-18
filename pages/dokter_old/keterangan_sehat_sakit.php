<?php
date_default_timezone_set("Asia/Jakarta");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Surat Keterangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="padding-right: 50px;">
                                <i class="fa fa-table"></i> Keterangan Pasien Sakit / Sehat
                            </h3>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <button onclick="modalKeterangan()" class="btn btn-primary"><i class="fa fa-fa fa-plus"></i> Buat Surat Keterangan</button>
                        </div>
                    </div>
                </div>
                <div class="box-content nopadding" style="overflow-x:auto; min-height: 350px;">
                    <table id="table-data" class="table table-hover table-responsive table-nomargin table-bordered" style="padding-top: 0px;">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Tgl</th>
                                <th style="width: 15%;">Jenis</th>
                                <th style="width: 10%;">No. Pendaftaran</th>
                                <th style="width: 15%;">Diterbitkan</th>
                                <th>Deskripsi</th>
                                <th style="width: 15%;">#</th>
                            </tr>
                        </thead>
                        <tbody id="dataKeterangan"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKeterangan" tabindex="-1" role="dialog" aria-labelledby="modalKeteranganLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <div class="row">
                    <div class="col-md-7">
                        <h4 class="modal-title" id="modalKeteranganLabel"><b>Buat Surat Keterangan</b></h4>
                    </div>
                    <div class="col-md-5">
                        <select class="form-control" id="jenis" name="jenis">
                            <option value="">- Pilih Jenis Keterangan -</option>
                            <option value="Keterangan Sehat">Keterangan Sehat</option>
                            <option value="Keterangan Sakit">Keterangan Sakit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <!-- Form content goes here -->
                <form>
                    <div class="card bg-success" style="border-radius: 5px; display: none;" id="cardSehat">
                        <div class="card-body" style="padding: 10px;">
                            <div class="row">
                                <div class="col-md-7">
                                    <h3 id="judul" style="margin-top: 0px; font-weight: bolder;"></h3>
                                    <span id="id_" style="display: none;"></span>
                                </div>
                                <div class="col-md-5" style="text-align: right;">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="width: 40%;"><b>Terbitkan di*</b> &nbsp;</td>
                                            <td><input type="text" class="form-control" value="Jakarta" id="terbit_di" name="terbit_di"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <?php include 'form_sehat.php'; ?>
                            <?php include 'form_sakit.php'; ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6" style="text-align: left; color: red; font-weight: bold;"><i>Catatan : Pastikan pengisian TTV sudah terisi.</i></div>
                    <div class="col-md-6" style="text-align: right;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-warning" onclick="resetForm()" style="margin-left: 0px;">Reset</button>
                        <button type="button" style="display: none;" onclick="simpanKetSehat()" id="btnSehat" class="btn btn-primary">Simpan</button>
                        <button type="button" style="display: none;" onclick="simpanKetSakit()" id="btnSakit" class="btn btn-primary">Simpan</button>
                        <button type="button" disabled id="btnDisabled" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var nomr = "<?php echo $_GET['id']; ?>";
    var no_daftar = "<?php echo $_GET['ids']; ?>";
    var user = "<?php echo $_SESSION['rg_user']; ?>";

    function modalKeterangan() {
        $('#modalKeterangan').modal('show');
        $('#id_').html('');
        resetForm()
    }

    $('#jenis').change(function() {
        var jenis = $(this).val();
        if (jenis == '') {
            $('#cardSehat').hide();
            $('#btnSehat').hide();
            $('#btnSakit').hide();
            $('#btnDisabled').show();
            $('#formSehat').hide();
            $('#formSakit').hide();
        } else {
            $('#cardSehat').show();
        }
        if (jenis == 'Keterangan Sehat') {
            $('#btnSehat').show();
            $('#btnSakit').hide();
            $('#btnDisabled').hide();
            $('#judul').html('Keterangan Sehat');
            $('.card').removeClass('bg-danger').addClass('bg-success');
            $('#formSehat').show();
            $('#formSakit').hide();
        } else if (jenis == 'Keterangan Sakit') {
            $('#btnSehat').hide();
            $('#btnSakit').show();
            $('#btnDisabled').hide();
            $('#judul').html('Keterangan Sakit');
            $('.card').removeClass('bg-success').addClass('bg-danger');
            $('#formSehat').hide();
            $('#formSakit').show();
        }
    });

    function resetForm() {
        $('#terbit_di').val('Jakarta');
        $('#tgl_periksa_kesehatan').val('<?= date('Y-m-d'); ?>');
        $('#catatan_keperluan').val('');
        $('#buta_warna').val('Tidak Buta Warna');
        $('#visus').val('');
        $('#penyakit_kronis').val('Tidak Ada');
        $('#penyakit_menular').val('Tidak Ada');
        $('#istirahat_mulai_tanggal').val('');
        $('#istirahat_sampai_tanggal').val('');
        $('#istirahat_selama').val('');
    }

    function simpanKetSehat() {
        var id_ = $('#id_').html();
        var jenis_surat = $('#jenis').val();
        var tgl_periksa_kesehatan = $('#tgl_periksa_kesehatan').val();
        var catatan_keperluan = $('#catatan_keperluan').val();
        var buta_warna = $('#buta_warna').val();
        var visus = $('#visus').val();
        var penyakit_kronis = $('#penyakit_kronis').val();
        var penyakit_menular = $('#penyakit_menular').val();
        var terbit_di = $('#terbit_di').val();

        if (jenis_surat == '' || tgl_periksa_kesehatan == '' || catatan_keperluan == '' || buta_warna == '' || visus == '' || penyakit_kronis == '' || penyakit_menular == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data tidak boleh kosong!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url: 'pages/dokter/simpan_keterangan.php',
                data: {
                    id: id_,
                    nomr: nomr,
                    no_daftar: no_daftar,
                    jenis_surat: jenis_surat,
                    tgl_periksa_kesehatan: tgl_periksa_kesehatan,
                    catatan_keperluan: catatan_keperluan,
                    buta_warna: buta_warna,
                    visus: visus,
                    penyakit_kronis: penyakit_kronis,
                    penyakit_menular: penyakit_menular,
                    terbit_di: terbit_di,
                    user: user
                },
                dataType: 'json',
                async: true,
                success: function(data) {
                    if (data.status == 'sukses') {
                        $('#modalKeterangan').modal('hide');
                        resetForm();
                        dataKeterangan();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data gagal disimpan!'
                        });
                    }
                }
            });
        }
    }

    function simpanKetSakit() {
        var id_ = $('#id_').html();
        var jenis_surat = $('#jenis').val();
        var istirahat_mulai_tanggal = $('#istirahat_mulai_tanggal').val();
        var istirahat_sampai_tanggal = $('#istirahat_sampai_tanggal').val();
        var istirahat_selama = $('#istirahat_selama').val();
        var terbit_di = $('#terbit_di').val();

        if (jenis_surat == '' || istirahat_mulai_tanggal == '' || istirahat_sampai_tanggal == '' || istirahat_selama == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data tidak boleh kosong!'
            });
        } else {
            $.ajax({
                type: 'POST',
                url: 'pages/dokter/simpan_keterangan.php',
                data: {
                    id: id_,
                    nomr: nomr,
                    no_daftar: no_daftar,
                    jenis_surat: jenis_surat,
                    istirahat_mulai_tanggal: istirahat_mulai_tanggal,
                    istirahat_sampai_tanggal: istirahat_sampai_tanggal,
                    istirahat_selama: istirahat_selama,
                    terbit_di: terbit_di,
                    user: user
                },
                dataType: 'json',
                async: true,
                success: function(data) {
                    if (data.status == 'sukses') {
                        $('#modalKeterangan').modal('hide');
                        resetForm();
                        dataKeterangan();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data gagal disimpan!'
                        });
                    }
                }
            });
        }
    }

    dataKeterangan()

    function dataKeterangan() {
        $.ajax({
            type: 'POST',
            url: 'pages/dokter/simpan_keterangan.php',
            data: {
                jenis_surat: 'Get Data',
                nomr: nomr,
                no_daftar: no_daftar
            },
            dataType: 'json',
            async: true,
            success: function(data) {
                var html = '';
                for (var i = 0; i < data.jumlahData; i++) {
                    if (data.body[i].jenis_surat == 'Keterangan Sehat') {
                        var deskripsi = "Tanggal Periksa Kesehatan : " + data.body[i].tanggal_periksa_kesehatan + "<br>Catatan Keperluan : " + data.body[i].catatan_keperluan + "<br>Buta Warna : " + data.body[i].buta_warna + "<br>Visus : " + data.body[i].visus + "<br>Penyakit Kronis : " + data.body[i].penyakit_kronis + "<br>Penyakit Menular : " + data.body[i].penyakit_menular;
                        var btn = '<button class="btn btn-success" onclick="getEditSehat(this)" data-id="' + data.body[i].id + '" data-jenis="' + data.body[i].jenis_surat + '" data-tgl="' + data.body[i].tanggal_periksa_kesehatan + '" data-catatan="' + data.body[i].catatan_keperluan + '" data-butawarna="' + data.body[i].buta_warna + '" data-visus="' + data.body[i].visus + '" data-kronis="' + data.body[i].penyakit_kronis + '" data-menular="' + data.body[i].penyakit_menular + '" data-terbit="' + data.body[i].terbit_di + '">Edit</button>'
                    } else {
                        var deskripsi = "Istirahat Mulai Tanggal : " + tglFormat2(data.body[i].istirahat_mulai_tanggal) + "<br>Istirahat Sampai Tanggal : " + tglFormat2(data.body[i].istirahat_sampai_tanggal) + "<br>Lamanya Hari : " + data.body[i].istirahat_selama;
                        var btn = '<button class="btn btn-success" onclick="getEditSakit(this)" data-id="' + data.body[i].id + '" data-jenis="' + data.body[i].jenis_surat + '" data-mulai="' + data.body[i].istirahat_mulai_tanggal + '" data-sampai="' + data.body[i].istirahat_sampai_tanggal + '" data-lama="' + data.body[i].istirahat_selama + '" data-terbit="' + data.body[i].terbit_di + '">Edit</button>'
                    }
                    html += `
                        <tr>
                            <td>${tglFormat(data.body[i].tanggal_pembuatan)}</td>
                            <td>${data.body[i].jenis_surat}</td>
                            <td>${data.body[i].no_daftar}</td>
                            <td>${data.body[i].terbit_di}</td>
                            <td>${deskripsi}</td>
                            <td>
                                <button onclick="cetak(this)" data-jenis="${data.body[i].jenis_surat}" data-id="${data.body[i].id}" class="btn btn-primary">Print</button>
                                <button onclick="hapus(this)" data-id="${data.body[i].id}" class="btn btn-danger">Hapus</button>
                                ${btn}
                            </td>
                        </tr>
                    `;
                }
                $('#dataKeterangan').html(html);
            }
        });
    }

    function getEditSehat(data) {
        var id = $(data).data('id');
        var jenis = $(data).data('jenis');
        var tgl = $(data).data('tgl');
        var catatan = $(data).data('catatan');
        var butawarna = $(data).data('butawarna');
        var visus = $(data).data('visus');
        var kronis = $(data).data('kronis');
        var menular = $(data).data('menular');
        var terbit = $(data).data('terbit');

        $("#modalKeterangan").modal('show');

        $('#jenis').val(jenis).trigger('change');

        $('#id_').html(id);
        $('#tgl_periksa_kesehatan').val(tgl);
        $('#catatan_keperluan').val(catatan);
        $('#buta_warna').val(butawarna);
        $('#visus').val(visus);
        $('#penyakit_kronis').val(kronis);
        $('#penyakit_menular').val(menular);
        $('#terbit_di').val(terbit);
    }

    function getEditSakit(data) {
        var id = $(data).data('id');
        var jenis = $(data).data('jenis');
        var mulai = $(data).data('mulai');
        var sampai = $(data).data('sampai');
        var lama = $(data).data('lama');
        var terbit = $(data).data('terbit');

        $("#modalKeterangan").modal('show');

        $('#jenis').val(jenis).trigger('change');

        $('#id_').html(id);
        $('#istirahat_mulai_tanggal').val(mulai);
        $('#istirahat_sampai_tanggal').val(sampai);
        $('#istirahat_selama').val(lama);
        $('#terbit_di').val(terbit);
    }

    function hapus(data) {
        var id = $(data).data('id');
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'pages/dokter/simpan_keterangan.php',
                    data: {
                        id: id,
                        jenis_surat: 'Hapus'
                    },
                    dataType: 'json',
                    async: true,
                    success: function(data) {
                        if (data.status == 'sukses') {
                            dataKeterangan();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data gagal dihapus!'
                            });
                        }
                    }
                });
            }
        });
    }

    function cetak(data) {
        var id = $(data).data('id');
        var jenis = $(data).data('jenis');
        if (jenis == 'Keterangan Sehat') {
            window.open('pages/dokter/cetak_keterangan.php?id=' + id, '_blank');
        } else {
            window.open('pages/dokter/cetak_keterangan_sakit.php?id=' + id, '_blank');
        }
    }

    function tglFormat(tanggal) {
        var date = new Date(tanggal);
        var options = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        return date.toLocaleString('id-ID', options);
    }

 function tglFormat2(tanggal) {
        var date = new Date(tanggal);
        var options = {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'        };
        return date.toLocaleString('id-ID', options);
    }
</script>
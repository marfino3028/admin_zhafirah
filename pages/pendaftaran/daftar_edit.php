<?php
$data = $db->query("select * from tbl_pendaftaran where md5(id)='" . $_GET['id'] . "'");
//print_r($data);
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Pasien</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Tambah Data</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Tambah Data Pendaftaran Pasien
                                </div>
                                <div class="box-content nopadding">
                                    <form action="pages/pendaftaran/daftar_update.php" method="post" enctype="multipart/form-data" class="form-horizontal form-column form-bordered" name="form_karyawan" id="form_karyawan">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">No. Pendaftaran</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $data[0]['no_daftar'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Nomor MR</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $data[0]['nomr'] ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Hubungan</label>
                                                    <div class="col-sm-9">
                                                        <?php echo $data[0]['yang_berobat']; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Poli</label>
                                                    <div class="col-sm-9">
                                                        <select id="kd_poli" name="kd_poli" size="1" onchange="pilihPoli(this.value)" class="form-control" required="required">
                                                            <option value="">--Pilih Poli--</option>
                                                            <?php
                                                            $poli = $db->query("select * from tbl_poli where status_delete='UD'");
                                                            for ($i = 0; $i < count($poli); $i++) {
                                                                if ($data[0]['kd_poli'] == $poli[$i]['kd_poli']) {
                                                                    echo '<option value="' . $poli[$i]['kd_poli'] . '" selected="selected">' . $poli[$i]['nama_poli'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $poli[$i]['kd_poli'] . '">' . $poli[$i]['nama_poli'] . '</option>';
                                                                }
                                                            }
                                                            echo '<option value="LANGSUNG">PENUNJANG MEDIS</option>';
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3">Pilih Dokter</label>
                                                    <div class="col-sm-9">
                                                        <div style="margin-bottom: 4px; margin-top: 4px;" id="langsung">
                                                            <div>
                                                                <select id="kd_dokter" name="kd_dokter" size="1" class="form-control" onchange="oncall_dokter(this.value)">
                                                                    <?php
                                                                    //$poli = $db->query("select * from tbl_dokter where status_delete='UD' and kode_dokter not in (select kode_dokter from tbl_jadwal where hari='".date("N")."')");
                                                                    $poli = $db->query("select * from tbl_dokter where status_delete='UD'");
                                                                    for ($i = 0; $i < count($poli); $i++) {
                                                                        if ($data[0]['kode_dokter'] == $poli[$i]['kode_dokter']) {
                                                                            echo '<option value="' . $poli[$i]['kode_dokter'] . '" selected="selected">' . $poli[$i]['nama_dokter'] . '</option>';
                                                                        } else {
                                                                            echo '<option value="' . $poli[$i]['kode_dokter'] . '">' . $poli[$i]['nama_dokter'] . '</option>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div style="margin-bottom: 4px; margin-top: 4px;" id="dokter_oncall"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Dokter Pengirim</label>
                                                    <div class="col-sm-9">
                                                        <select id="dokter_pengirim" name="dokter_pengirim" size="1" class="form-control" required="required">
                                                            <option value="">Pilih Dokter Pengirim</option>
                                                            <?php
                                                            $prsh = $db->query("select * from tbl_dokter where status_delete='UD'");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                if ($data[0]['dokter_pengirim_kode'] == $prsh[$i]['kode_dokter']) {
                                                                    echo '<option value="' . $prsh[$i]['kode_dokter'] . '" selected="selected">' . $prsh[$i]['nama_dokter'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $prsh[$i]['kode_dokter'] . '">' . $prsh[$i]['nama_dokter'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="textfield" class="control-label col-sm-3"> Pilih Jaminan </label>
                                                    <div class="col-sm-9">
                                                        <select id="kode_perusahaan" name="kode_perusahaan" size="1" class="form-control" required="required">
                                                            <option value="">Pilih Jaminan</option>
                                                            <?php
                                                            $prsh = $db->query("select * from tbl_perusahaan where status_delete='UD'");
                                                            for ($i = 0; $i < count($prsh); $i++) {
                                                                if ($data[0]['kode_perusahaan'] == $prsh[$i]['kode_perusahaan']) {
                                                                    echo '<option value="' . $prsh[$i]['id'] . '" selected="selected">' . $prsh[$i]['nama_perusahaan'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $prsh[$i]['id'] . '">' . $prsh[$i]['nama_perusahaan'] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Pilih Rujukan</label>
                                                    <div class="col-sm-3">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="01" id="rujukan" name="rujukan" <?php if ($data[0]['rujukan_kode'] == '01') echo 'checked'; ?> required="required" onclick="rsrujukan(this.value)">Inisiatif Sendiri
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="02" id="rujukan" name="rujukan" <?php if ($data[0]['rujukan_kode'] == '02') echo 'checked'; ?> required="required" onclick="rsrujukan(this.value)">Luar RS/Klinik
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" value="03" id="rujukan" name="rujukan" <?php if ($data[0]['rujukan_kode'] == '03') echo 'checked'; ?> required="required" onclick="rsrujukan(this.value)">Faskes BPJS
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div id="rujukan_pasien" style="align-self: center; position: relative;">
                                                            <?php echo $data[0]['rujukan_nama']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="align-content: center;align-self: center;">
                                                <div id="data_pasien" style="align-self: center; position: relative;">
                                                    <?php
                                                    $dataP = $db->query("select * from tbl_pasien where nomr='" . $data[0]['nomr'] . "' and status_delete='UD'");

                                                    echo '<input type="hidden" name="idmr" value="' . $dataP[0]['id'] . '">';
                                                    echo '<input type="hidden" name="nomr" value="' . $dataP[0]['nomr'] . '">';
                                                    echo '<input type="hidden" name="nodaftar" value="' . $data[0]['no_daftar'] . '">';
                                                    ?>
                                                    <table id="table-data" class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                            <th colspan="2" class="text-center">Detail Pasien</th>
                                                        </thead>
                                                        <tr>
                                                            <td style="width:140px">Nama Pasien</td>
                                                            <td><?php echo $dataP[0]['nm_pasien'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Jenis Kelamin</td>
                                                            <td><?php echo $dataP[0]['jk'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tempat Lahir</td>
                                                            <td><?php echo $dataP[0]['tmpt_lahir'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Tanggal Lahir</td>
                                                            <td><?php echo date("d F Y", strtotime($dataP[0]['tgl_lahir'])) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">Alamat</td>
                                                            <td><?php echo nl2br($dataP[0]['alamat_pasien']) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width:140px">No.Peserta</td>
                                                            <td><span id="noka"><?php echo nl2br($dataP[0]['no_peserta']) ?></span></td>
                                                        </tr>
                                                        <?php
                                                        if ($data[0]['nama_perusahaan'] == "BPJS Kesehatan" || $data[0]['nama_perusahaan'] == "bpjs kesehatan" || $data[0]['nama_perusahaan'] == "BPJS KESEHATAN") {

                                                            $no_daftar = $data[0]['no_daftar'];
                                                            $sep = $db->query("SELECT * FROM tbl_sep WHERE no_pendaftaran = '$no_daftar'");

                                                            if (count($sep) > 0) {

                                                                for ($i = 0; $i < count($sep); $i++) {
                                                                    echo '<tr>';
                                                                    echo '<td>No.SEP</td>';
                                                                    echo '<td>' . $sep[$i]['noSep'] . ' | <a href="javascript:void(0)" onclick="histori()">Hisori Pelayanan</a> | <a href="javascript:void(0)" onclick="editSep(this)" data-sep="' . $sep[$i]['noSep'] . '" data-noDaftar="' . $sep[$i]['no_daftar'] . '">Edit</a> | <a href="javascript:void(0)" onclick="hapusSep(this)" data-sep="' . $sep[$i]['noSep'] . '">Hapus</a> | <a href="javascript:void(0)" onclick="cetakSep(this)" data-sep="' . $sep[$i]['noSep'] . '">Cetak</a> | <a href="javascript:void(0)" onclick="rujuk(this)" data-sep="' . $sep[$i]['noSep'] . '">Rujuk</a> </td>';
                                                                    echo '</tr>';
                                                                }
                                                            } else {
                                                                echo '<tr>';
                                                                echo '<td>No.SEP</td>';
                                                                echo '<td><a data-id="' . $data[0]['no_daftar'] . '" onclick="createSep(this)" href="javascript:void(0)" >Create SEP</a> | <a href="javascript:void(0)" onclick="histori()">Hisori Pelayanan</a></td>';
                                                                echo '</tr>';
                                                            }
                                                        }
                                                        ?>
                                                    </table>
                                                    <span id="userName" hidden><?= $_SESSION['rg_user']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="IDDATA" id="IDDATA" value=" <?php echo md5($data[0]['id']) ?>">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data Pendaftaran" />
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div style="display: none;" id="upHistori" class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                <i class="fa fa-list"></i>
                                                Histori Pelayanan Peserta
                                            </h3>
                                        </div>
                                        <div class="col-md-6" style="text-align: right;">
                                            <button onclick="tutup()" type="button" class="btn btn-sm btn-danger">Close</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
                                    <div style="width: 3500px;">
                                        <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>NO.</td>
                                                    <td>NO.SEP</td>
                                                    <td>TGL.SEP</td>
                                                    <td>TGL.PULANG SEP</td>
                                                    <td>NO.KARTU</td>
                                                    <td>NAMA</td>
                                                    <td>JENIS PELAYANAN</td>
                                                    <td>KELAS RAWAT</td>
                                                    <td>DIAGNOSA</td>
                                                    <td>POLI</td>
                                                    <td>PPK PELAYANAN</td>
                                                    <td>NO.RUJUKAN</td>
                                                    <td>FLAG</td>
                                                    <td>ASURANSI</td>
                                                    <td>POLI TUJUAN SEP</td>
                                                </tr>
                                            </thead>
                                            <tbody id="dataHistori"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
    function CariPasien(id) {
        var url = "pages/pendaftaran/view_pasien.php";
        id = '1###' + id;
        var data = {
            id: id
        };

        $('.loading').fadeIn();
        $('#data_pasien').fadeOut();
        $('#data_pasien').load(url, data, function() {
            $('.loading').fadeOut('fast');
            $('#data_pasien').fadeIn('fast');
        });
    }

    function pilihPoli(id) {
        var data = {
            id: id
        };

        if (id == 'LANGSUNG') {
            var url = "pages/pendaftaran/view_langsung.php";
        } else {
            var url = "pages/pendaftaran/view_not_langsung.php";
        }
        var data = {
            id: id
        };
        //alert(id);
        $('#langsung').load(url, data, function() {
            $('#langsung').fadeIn('fast');
        });
    }

    function oncall_dokter(id) {
        var data = {
            id: id
        };
        var url = "pages/pendaftaran/view_oncall.php";
        $('#dokter_oncall').load(url, data, function() {
            $('#dokter_oncall').fadeIn('fast');
        });
    }

    function rsrujukan(id) {
        var data = {
            id: id
        };
        var url = "pages/pendaftaran/view_rujukan.php";
        $('#rujukan_pasien').load(url, data, function() {
            $('#rujukan_pasien').fadeIn('fast');
        });
    }

    function pilihKelas(id) {
        var data = {
            id: id
        };
        var url = "pages/pendaftaran/kelas_inap.php";
        $('#KelasInap').load(url, data, function() {
            $('#KelasInap').fadeIn('fast');
        });
    }

    function pilihRuangan(id) {
        var data = {
            id: id
        };
        var url = "pages/pendaftaran/kelas_inap_bed.php";
        $('#KelasInapBed').load(url, data, function() {
            $('#KelasInapBed').fadeIn('fast');
        });
    }

    function pilih_hubungan(id) {
        var url = "pages/pendaftaran/langsung_hubungan.php";
        var data = {
            id: id
        };
        $('#langsung_hub').load(url, data, function() {
            $('#langsung_hub').fadeIn('fast');
        });
    }

    function simpanDataDaftar(t, url) {
        var poli = document.getElementById('kd_poli').value;
        var prsh = document.getElementById('kode_perusahaan').value;
        if (poli == "" || prsh == "") {
            alert("Silahkan lengkapi data yang sudah disediakan");
        } else {
            document.getElementById('form_karyawan').action = url;
            t.submit();
        }
    }

    // penambahan
    function createSep(data) {
        var noDaftar = data.getAttribute("data-id")
        var md5Id = document.getElementById("IDDATA").value.trim();
        sessionStorage.setItem('noDaftar', noDaftar);
        sessionStorage.setItem('md5Id', md5Id);
        window.location.href = "index.php?mod=pendaftaran&submod=create_sep"
    }

    function histori() {
        $("#upHistori").show();
        var jenis_query = "Histori Pelayanan";
        var noka = document.getElementById("noka").innerHTML;
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noka: noka
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                var no = 1;
                if (data.metaData.code == 200) {
                    for (i = 0; i < data.response.histori.length; i++) {
                        if (data.response.histori[i].jnsPelayanan == 1) {
                            var jnsPelayanan = 'Rawat Inap'
                        } else {
                            var jnsPelayanan = 'Rawat Jalan'
                        }
                        html += `
                            <tr>
                                <td>${no++}.</td>
                                <td>${data.response.histori[i].noSep}</td>
                                <td>${data.response.histori[i].tglSep}</td>
                                <td>${data.response.histori[i].tglPlgSep}</td>
                                <td>${data.response.histori[i].noKartu}</td>
                                <td>${data.response.histori[i].namaPeserta}</td>
                                <td>${jnsPelayanan}</td>
                                <td>${data.response.histori[i].kelasRawat}</td>
                                <td>${data.response.histori[i].diagnosa}</td>
                                <td>${data.response.histori[i].poli}</td>
                                <td>${data.response.histori[i].ppkPelayanan}</td>
                                <td>${data.response.histori[i].noRujukan}</td>
                                <td>${data.response.histori[i].flag}</td>
                                <td>${data.response.histori[i].asuransi}</td>
                                <td>${data.response.histori[i].poliTujSep}</td>
                            </tr>
                        `;
                    }
                } else {
                    Swal.fire({
                        title: 'Perhatian',
                        text: data.metaData.message,
                        icon: 'warning'
                    });
                    html += `
                        <tr>
                            <td colspan="14">${data.metaData.message}</td>
                        </td>
                    `
                }
                $('#dataHistori').html(html);
            }
        });
    }

    function tutup() {
        $("#upHistori").hide();
    }
</script>
<script language="javascript">
    $(document).ready(function() {
        $("#nomr").select2({
            minimumInputLength: 1,
            ajax: {
                url: "pages/functions/nomr.php",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function(term) {
                    return {
                        term: term
                    };
                },
                results: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.itemName,
                                id: item.id
                            }
                        })
                    };
                },
            }
        });
    });

    function editSep(data) {
        var noDaftar = data.getAttribute("data-noDaftar");
        var noSep = data.getAttribute("data-sep");
        var md5Id = document.getElementById("IDDATA").value.trim();
        sessionStorage.setItem('noDaftar', noDaftar);
        sessionStorage.setItem('noSep', noSep);
        sessionStorage.setItem('md5Id', md5Id);
        window.location.href = "index.php?mod=pendaftaran&submod=edit_sep"
    }

    function cetakSep(data) {
        var noSep = data.getAttribute("data-sep");
        var url = "pages/pendaftaran/lib_sep/cetak_sep.php?no=" + noSep;
        window.open(url, "MsgWindow", "width=800,height=450");
    }

    function rujuk(data) {
        var noSep = data.getAttribute("data-sep");
        var md5Id = document.getElementById("IDDATA").value.trim();
        sessionStorage.setItem('noSep', noSep);
        sessionStorage.setItem('md5Id', md5Id);
        window.location.href = "index.php?mod=pendaftaran&submod=create_rujukan"
    }

    function hapusSep(data) {
        var noSep = data.getAttribute("data-sep");
        var userName = document.getElementById("userName").innerHTML
        var jenis_query = "Hapus SEP";
        Swal.fire({
            title: "Perhatian",
            text: "Apakah yakin no SEP " + noSep + " ini akan dihapus ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'ajax',
                    url: 'pages/pendaftaran/lib_sep/query.php',
                    method: "POST",
                    data: {
                        jenis_query: jenis_query,
                        noSep: noSep,
                        userName: userName
                    },
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        if (data.metaData.code == 200) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'No.SEP : ' + noSep + ' berhasil dihapus !',
                                icon: 'success'
                            }).then((result) => {
                                location.reload()
                            });
                        } else {
                            Swal.fire({
                                title: 'Ooops',
                                text: 'No.SEP : ' + noSep + ' gagal dihapus ! ' + data.metaData.message,
                                icon: 'error'
                            })
                        }
                    }
                });
            }
        });
    }
</script>
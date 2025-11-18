<script>
    let noSep = sessionStorage.getItem('noSep');
    let noDaftar = sessionStorage.getItem('noDaftar');

    getDataSep();

    function getDataSep() {
        var jenis_query = 'Data Sep';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noSep: noSep
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                document.getElementById("noSep").innerHTML = data[0].noSep
                document.getElementById("noKartu").value = data[0].noKartu
                document.getElementById("noMR").value = data[0].noMR
                document.getElementById("noTelp").value = data[0].noTelp
                getJnsPelayanan(data[0].jnsPelayanan)
                kelas(data[0].klsRawatHak)
                document.getElementById("noRujukan").value = data[0].noRujukan

                var html = ''
                html += `<option value="${data[0].asalRujukan}">Faskes ${data[0].asalRujukan}</option>`
                $("#asalRujukan").html(html);

                document.getElementById("tglSep").value = data[0].tglSep
                document.getElementById("tglRujukan").value = data[0].tglRujukan
                document.getElementById("ppkRujukan").value = data[0].ppkRujukan
                document.getElementById("catatan").value = data[0].catatan
                document.getElementById("user").value = data[0].user

                diagnosaEdit(data[0].diagAwal)
                tujuan(data[0].tujuan)
                eksekutif(data[0].eksekutif)
                cob(data[0].cob)
                katarak(data[0].katarak)
                tujuanKunj(data[0].tujuanKunj)
                assesmentPel(data[0].assesmentPel)

                document.getElementById("noSurat").value = data[0].noSurat
                kodeDPJP(data[0].kodeDPJP)
                dpjpLayan(data[0].dpjpLayan)

            }
        });
    }

    function diagnosaEdit(icd) {
        var jenis_query = "Diagnosa Edit";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                icd: icd
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += `
                        <option value="${data[i].kode_icd}">${data[i].kode_icd} - ${data[i].nama_icd}</option>
                    `;
                }
                $("#diagAwal").html(html);
            }
        });
    }

    getPPK()

    function getPPK() {
        var jenis_query = 'Kode PPK';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                document.getElementById("ppkPelayanan").value = data[0].nilai
            }
        });
    }

    let md5Id = sessionStorage.getItem('md5Id');

    function closeForm() {
        sessionStorage.clear();
        window.location.href = "index.php?mod=pendaftaran&submod=daftar_edit&id=" + md5Id
    }


    function getJnsPelayanan(kode) {
        var jenis_query = 'Jenis Pelayanan';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html += `<option value=""></option>`;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $('#jnsPelayanan').html(html);
            }
        });
    }

    function tujuan(kode) {
        var jenis_query = "Poli";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html += `<option value=""></option>`
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kd_bpjs) {
                        html += `
                            <option selected value="${data[i].kd_bpjs}">${data[i].nama_poli}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kd_bpjs}">${data[i].nama_poli}</option>
                        `;
                    }
                }
                $("#tujuan").html(html);
            }
        });
    }

    function eksekutif(kode) {
        var jenis_query = "Eksekutif";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $("#eksekutif").html(html);
            }
        });
    }

    function cob(kode) {
        var jenis_query = "COB";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $("#cob").html(html);
            }
        });
    }

    function katarak(kode) {
        var jenis_query = "Katarak";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $("#katarak").html(html);
            }
        });
    }

    function tujuanKunj(kode) {
        var jenis_query = "Tujuan Kunjungan";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html += `<option value=""></option>`
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $("#tujuanKunj").html(html);
            }
        });
    }

    function assesmentPel(kode) {
        var jenis_query = "Asesmen Pelayanan";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html += `<option value=""></option>`
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_opsi) {
                        html += `
                            <option selected value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_opsi}">${data[i].nama_opsi}</option>
                        `;
                    }
                }
                $("#assesmentPel").html(html);
            }
        });
    }

    function cekHakKelas() {
        var noKartu = document.getElementById("noKartu").value
        var jenis_query = 'Peserta';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noKartu: noKartu
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                kelas(data.response.peserta.hakKelas.kode)
            }
        });
    }

    function kelas(kdKelas) {
        var jenis_query = 'Kelas';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html += `<option value=""></option>`
                for (i = 0; i < data.length; i++) {
                    if (kdKelas == data[i].kode_bpjs) {
                        html += `
                            <option selected value="${data[i].kode_bpjs}">${data[i].nama}</option>
                        `;
                    } else {
                        html += `
                            <option value="${data[i].kode_bpjs}">${data[i].nama}</option>
                        `;
                    }
                }
                $("#klsRawatHak").html(html);
            }
        });
    }

    function openRujukan() {
        $("#upRujukan").modal("show");
        rujukanFaskes1()
    }

    function rujukanFaskes1() {
        var noKartu = document.getElementById("noKartu").value
        var jenis_query = 'Rujukan PCARE';
        document.getElementById('ket_faskes').innerHTML = "( Faskes 1 )"
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noKartu: noKartu
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                dataFaskes(data)
            }
        });
    }

    function rujukanFaskes2() {
        var noKartu = document.getElementById("noKartu").value
        var jenis_query = 'Rujukan RS';
        document.getElementById('ket_faskes').innerHTML = "( Faskes 2 )"
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noKartu: noKartu
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                dataFaskes(data)
            }
        });
    }

    function dataFaskes(data) {
        var html = '';
        var i;
        var no = 1;
        if (data.metaData.code == 200) {
            for (i = 0; i < data.response.rujukan.length; i++) {
                html += `
                <tr>
                    <td>${no++}.</td>
                    <td title="ASAL FASKES : ${data.response.rujukan[i].provPerujuk.nama}">${data.response.rujukan[i].noKunjungan}</td>
                    <td>${data.response.rujukan[i].tglKunjungan}</td>
                    <td>${data.response.rujukan[i].poliRujukan.kode}</td>
                    <td><button class="btn btn-success" onclick="setRujukan(this)" data-noRujukan="${data.response.rujukan[i].noKunjungan}" data-faskes="${data.response.asalFaskes}" data-tanggal="${data.response.rujukan[i].tglKunjungan}" data-kode="${data.response.rujukan[i].provPerujuk.kode}" data-kd_diag="${data.response.rujukan[i].diagnosa.kode}" data-nama_diag="${data.response.rujukan[i].diagnosa.nama}"><i class="fa fa-plus"></i></button></td>
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
                    <td colspan="5">${data.metaData.message}</td>
                </td>
            `
        }
        $('#daftarRujukan').html(html);
    }

    function setRujukan(data) {
        $("#upRujukan").modal("hide");
        var noRujukan = data.getAttribute("data-noRujukan");
        var faskes = data.getAttribute("data-faskes");

        if (faskes == 1) {
            var ket_faskes = "Faskes 1";
        } else if (faskes == 2) {
            var ket_faskes = "Faskes 2";
        }

        var tanggal = data.getAttribute("data-tanggal");
        var kode = data.getAttribute("data-kode");

        var kd_diag = data.getAttribute("data-kd_diag");
        var nama_diag = data.getAttribute("data-nama_diag");

        document.getElementById("noRujukan").value = noRujukan

        var html = ''
        html += `<option value="${faskes}">${ket_faskes}</option>`
        $("#asalRujukan").html(html);

        document.getElementById("tglRujukan").value = tanggal
        document.getElementById("ppkRujukan").value = kode

        var html = ''
        html += `<option value="${kd_diag}">${kd_diag} - ${nama_diag}</option>`
        $("#diagAwal").html(html);
    }

    function rujukanInternal() {
        var jenis_query = 'Data Pendaftaran';
        var ppkPelayanan = document.getElementById('ppkPelayanan').value;
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noDaftar: noDaftar
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                $("#upRujukan").modal("hide");
                document.getElementById("noRujukan").readOnly = true

                var html = ''
                html += `<option value="1">Faskes 1</option>`
                $("#asalRujukan").html(html);

                document.getElementById("tglRujukan").value = ''
                document.getElementById("ppkRujukan").value = ppkPelayanan
            }
        });
    }

    function openDiagnosa() {
        $("#upDiagnosa").modal("show");
        $('#upDiagnosa').on('shown.bs.modal', function() {
            $('#keyDiagnosa').focus();
        });
    }

    function cariDiagnosa() {
        var keyDiagnosa = document.getElementById("keyDiagnosa").value;
        var jenis_query = "Diagnosa";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                keyDiagnosa: keyDiagnosa
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += `
                        <tr>
                            <td style="width:10%">${data[i].kode_icd}</td>
                            <td style="width:82%">${data[i].nama_icd}</td>
                            <td style="width:8%">
                                <button onclick="pilihDiagnosa(this)" class="btn btn-success" data-icd="${data[i].kode_icd}" data-nama="${data[i].nama_icd}"><i class="fa fa-plus"></i></button>
                            </td>
                        </tr>
                    `;
                }
                $("#daftarDiagnosa").html(html);
            }
        });
    }

    function pilihDiagnosa(data) {
        var kode = data.getAttribute("data-icd");
        var nama = data.getAttribute("data-nama");
        $("#upDiagnosa").modal("hide");
        var html = ''
        html += `<option value="${kode}">${kode} - ${nama}</option>`
        $("#diagAwal").html(html);
    }

    function dpjpLayan(kode) {
        var jenis_query = "DPJP Layanan";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html = `<option value=""></option>`;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_bpjs) {
                        html += `<option selected value="${data[i].kode_bpjs}">${data[i].nama_dokter}</option>`;
                    } else {
                        html += `<option value="${data[i].kode_bpjs}">${data[i].nama_dokter}</option>`;
                    }
                }
                $("#dpjpLayan").html(html);
            }
        });
    }

    function kodeDPJP(kode) {
        var jenis_query = "DPJP Layanan";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;
                html = `<option value=""></option>`;
                for (i = 0; i < data.length; i++) {
                    if (kode == data[i].kode_bpjs) {
                        html += `<option selected value="${data[i].kode_bpjs}">${data[i].nama_dokter}</option>`;
                    } else {
                        html += `<option value="${data[i].kode_bpjs}">${data[i].nama_dokter}</option>`;
                    }
                }
                $("#kodeDPJP").html(html);
            }
        });
    }

    function terbitkanSep() {
        var noSep = document.getElementById("noSep").innerHTML;
        var noKartu = document.getElementById("noKartu").value;
        var tglSep = document.getElementById("tglSep").value;
        var ppkPelayanan = document.getElementById("ppkPelayanan").value;
        var jnsPelayanan = document.getElementById("jnsPelayanan").value;
        var klsRawatHak = document.getElementById("klsRawatHak").value;
        var noMR = document.getElementById("noMR").value;
        var noRujukan = document.getElementById("noRujukan").value;
        var asalRujukan = document.getElementById("asalRujukan").value;
        var tglRujukan = document.getElementById("tglRujukan").value;
        var ppkRujukan = document.getElementById("ppkRujukan").value;
        var catatan = document.getElementById("catatan").value;
        var diagAwal = document.getElementById("diagAwal").value;
        var tujuan = document.getElementById("tujuan").value;
        var eksekutif = document.getElementById("eksekutif").value;
        var cob = document.getElementById("cob").value;
        var katarak = document.getElementById("katarak").value;
        var tujuanKunj = document.getElementById("tujuanKunj").value;
        var assesmentPel = document.getElementById("assesmentPel").value;
        var noSurat = document.getElementById("noSurat").value;
        var kodeDPJP = document.getElementById("kodeDPJP").value;
        var dpjpLayan = document.getElementById("dpjpLayan").value;
        var noTelp = document.getElementById("noTelp").value;
        var user = document.getElementById("user").value;

        var jenis_query = "Edit SEP";
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noSep: noSep,
                noKartu: noKartu,
                tglSep: tglSep,
                ppkPelayanan: ppkPelayanan,
                jnsPelayanan: jnsPelayanan,
                klsRawatHak: klsRawatHak,
                noMR: noMR,
                noRujukan: noRujukan,
                asalRujukan: asalRujukan,
                tglRujukan: tglRujukan,
                ppkRujukan: ppkRujukan,
                catatan: catatan,
                diagAwal: diagAwal,
                tujuan: tujuan,
                eksekutif: eksekutif,
                cob: cob,
                katarak: katarak,
                tujuanKunj: tujuanKunj,
                assesmentPel: assesmentPel,
                noSurat: noSurat,
                kodeDPJP: kodeDPJP,
                dpjpLayan: dpjpLayan,
                noTelp: noTelp,
                user: user,
                noDaftar: noDaftar
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data.metaData.code == 200) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'No.SEP : ' + data.response.sep.noSep,
                        icon: 'success'
                    }).then((result) => {
                        printSep(data.response.sep.noSep)
                        window.location.href = "index.php?mod=pendaftaran&submod=daftar_edit&id=" + md5Id
                    });
                } else {
                    Swal.fire({
                        title: 'Ooops',
                        text: data.metaData.message,
                        icon: 'warning'
                    });
                }
            },
            error: function() {
                alert('gagal')
            }
        });
    }

    function printSep(noSep) {
        var url = "pages/pendaftaran/lib_sep/cetak_sep.php?no=" + noSep;
        window.open(url, "MsgWindow", "width=800,height=450");
    }
</script>
<script>
    let noRujukan = sessionStorage.getItem('noRujukan');
    getDataRujukan()

    function getDataRujukan() {
        var jenis_query = 'Data Rujukan';
        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noRujukan: noRujukan
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                document.getElementById("rujukKe").innerHTML = data.response.rujukan.namaPpkDirujuk
                document.getElementById("poliRujukKe").innerHTML = data.response.rujukan.namaPoliRujukan
                document.getElementById("noRujukan").value = data.response.rujukan.noRujukan
                document.getElementById("tglRujukan").value = data.response.rujukan.tglRujukan
                document.getElementById("tglRencanaKunjungan").value = data.response.rujukan.tglRencanaKunjungan

                var html = '';
                html += `<option value="${data.response.rujukan.ppkDirujuk}">${data.response.rujukan.namaPpkDirujuk}</option>`
                $("#ppkDirujuk").html(html);

                getJnsPelayanan(data.response.rujukan.jnsPelayanan)

                document.getElementById("catatan").value = data.response.rujukan.catatan

                var htmlDiag = ''
                htmlDiag += `<option value="${data.response.rujukan.diagRujukan}">${data.response.rujukan.diagRujukan} - ${data.response.rujukan.namaDiagRujukan}</option>`
                $("#diagAwal").html(htmlDiag);

                tipeRujukan(data.response.rujukan.tipeRujukan);

                var htmlPoli = '';
                htmlPoli += `<option value="${data.response.rujukan.poliRujukan}">${data.response.rujukan.namaPoliRujukan}</option>`
                $("#poliRujukan").html(htmlPoli);
            }
        });
    }

    function closeForm() {
        sessionStorage.clear();
        window.location.href = "index.php?mod=bpjskes&submod=list_rujukan";
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

    function tipeRujukan(kode) {
        var jenis_query = "Tipe Rujukan";
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
                $("#tipeRujukan").html(html);
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

    function cariFaskes() {
        $("#upCariFaskes").modal("show");
    }

    function cariFaskesRujukan() {
        var keyFaskes = document.getElementById("keyFaskes").value;
        var keyJenisFaskes = document.getElementById("keyJenisFaskes").value;
        var jenis_query = "Cari Faskes";

        if (keyFaskes == '') {
            Swal.fire({
                title: 'Perhatian',
                text: 'Inputan tidak boleh kosong!',
                icon: 'warning'
            })
            return false
        }

        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                keyFaskes: keyFaskes,
                keyJenisFaskes: keyJenisFaskes
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data.metaData.code == 200) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.response.faskes.length; i++) {
                        html += `
                            <tr>
                                <td>${data.response.faskes[i].kode}</td>
                                <td>${data.response.faskes[i].nama}</td>
                                <td><button onclick="setFaskes(this)" data-kode="${data.response.faskes[i].kode}" data-nama="${data.response.faskes[i].nama}" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                            </tr>
                        `;
                    }
                } else {
                    html += `
                            <tr>
                                <td colspan="3">${data.metaData.message}</td>
                            </tr>
                        `;
                }
                $("#daftarFaskesRujukan").html(html);
            }
        });
    }

    function setFaskes(data) {
        var kode = data.getAttribute("data-kode");
        var nama = data.getAttribute("data-nama");
        document.getElementById('rujukKe').innerHTML = nama
        var html = '';
        html += `<option value="${kode}">${nama}</option>`
        $("#ppkDirujuk").html(html);
        $("#upCariFaskes").modal("hide");
    }

    function cariPoliRujukan() {
        $("#upPoliRujukan").modal("show");
        $('#upPoliRujukan').on('shown.bs.modal', function() {
            $('#keyPoli').focus();
        });
    }

    function cariKeyPoli() {
        var keyPoli = document.getElementById("keyPoli").value;
        var jenis_query = "Cari Poli Rujukan";
        if (keyPoli.length > 2) {
            $.ajax({
                type: 'ajax',
                url: "pages/pendaftaran/lib_sep/query.php",
                method: "POST",
                data: {
                    jenis_query: jenis_query,
                    keyPoli: keyPoli
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    if (data.metaData.code == 200) {
                        var html = '';
                        var i;
                        for (i = 0; i < data.response.poli.length; i++) {
                            html += `
                            <tr>
                                <td>${data.response.poli[i].kode}</td>
                                <td>${data.response.poli[i].nama}</td>
                                <td style="width:5%"><button onclick="setpoli(this)" data-kode="${data.response.poli[i].kode}" data-nama="${data.response.poli[i].nama}" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                            </tr>
                        `;
                        }
                    } else {
                        html += `
                            <tr>
                                <td colspan="3">${data.metaData.message}</td>
                            </tr>
                        `;
                    }
                    $("#dataPoliRujukan").html(html);
                }
            });
        }
    }

    function setpoli(data) {
        var kode = data.getAttribute("data-kode");
        var nama = data.getAttribute("data-nama");
        document.getElementById("poliRujukKe").innerHTML = nama
        var html = '';
        html += `<option value="${kode}">${nama}</option>`
        $("#poliRujukan").html(html);
        $("#upPoliRujukan").modal("hide");
    }

    function terbitkanRujukan() {
        var noRujukan = document.getElementById("noRujukan").value;
        var tglRujukan = document.getElementById("tglRujukan").value;
        var tglRencanaKunjungan = document.getElementById("tglRencanaKunjungan").value;
        var ppkDirujuk = document.getElementById("ppkDirujuk").value;
        var namaPpk = document.getElementById("rujukKe").innerHTML;
        var jnsPelayanan = document.getElementById("jnsPelayanan").value;
        var catatan = document.getElementById("catatan").value;
        var diagnosa = document.getElementById("diagAwal").value;
        var tipeRujukan = document.getElementById("tipeRujukan").value;
        var poliRujukan = document.getElementById("poliRujukan").value;
        var namaPoliRujukan = document.getElementById("poliRujukKe").innerHTML;
        var user = document.getElementById("user").value;

        var jenis_query = "Edit Rujukan";

        $.ajax({
            type: 'ajax',
            url: "pages/pendaftaran/lib_sep/query.php",
            method: "POST",
            data: {
                jenis_query: jenis_query,
                noRujukan: noRujukan,
                tglRujukan: tglRujukan,
                tglRencanaKunjungan: tglRencanaKunjungan,
                ppkDirujuk: ppkDirujuk,
                namaPpk: namaPpk,
                jnsPelayanan: jnsPelayanan,
                catatan: catatan,
                diagnosa: diagnosa,
                tipeRujukan: tipeRujukan,
                poliRujukan: poliRujukan,
                namaPoliRujukan: namaPoliRujukan,
                user: user
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data.metaData.code == 200) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'No.Rujukan : ' + data.response,
                        icon: 'success'
                    }).then((result) => {
                        printRujukan(data.response)
                        window.location.href = "index.php?mod=bpjskes&submod=list_rujukan"
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

    function printRujukan(noRujukan) {
        var url = "pages/pendaftaran/lib_sep/cetak_rujukan.php?no=" + noRujukan;
        window.open(url, "MsgWindow", "width=800,height=450");
    }
</script>
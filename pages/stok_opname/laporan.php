<?php
include __DIR__ . "/../../koneksi.php";
?>
<style>
    label {
        font-weight: normal;
    }

    .pageContent {
        display: block;
        padding: 5px;
        margin-top: -10px;
        width: 100%;
        height: 75vh;
        overflow: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .pageContent::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title" style="font-weight: bold; font-size: 10pt;">Pencarian Stok Opname</h4>
            </div>
            <div class="panel-body" style="background-color: #ecf1f6ff;">

                <label for="">Tanggal Stok Opname awal*</label>
                <input type="date" required class="form-control" id="tanggal_so" name="tanggal_so">

                <label for="">Tanggal Stok Opname akhir*</label>
                <input type="date" required class="form-control" id="tanggal_so2" name="tanggal_so2">

                <br>

                <button type="button" onclick="cariLaporan()" class="btn btn-success btn-xs btn-3d"><i
                        class="fa fa-fw fa-search"></i> VIEW</button>
                <button type="button" onclick="resetPencarian()" class="btn btn-danger btn-xs btn-3d"><i
                        class="fa fa-fw fa-refresh"></i> RESET</button>
                <br><br><br>

                <table id="tableInfo" style="background-color: white;"
                    class="table table-bordered table-condensed table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID. SO</th>
                            <th>Gudang</th>
                            <th>Tanggal</th>
                            <th style="width: 15%;">#</th>
                        </tr>
                    </thead>
                    <tbody id="dataListHeader"></tbody>
                </table>

                <div class="card" id="infoPilihan" style="display: none; border-radius: 5px;">
                    <div class="card-body" style="background-color: white; padding: 8px;">

                        Tanggal SO: <label id="tglSOHeader"></label><br>
                        Gudang: <label style="display: none;" id="kodeGudangSO"></label> <label
                            id="namaGudangSO"></label><br>
                        Pilih kategori yang akan dicetak:

                    </div>
                    <div class="card-footer">
                        <br>
                        <button class="btn btn-sm btn-danger" onclick="tutupInfo()">Tutup</button>
                        <div id="buttonPilihan"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title" style="font-weight: bold; font-size: 10pt;">Laporan Stok Opname</h4>
            </div>
            <div class="panel-body" style="background-color: #ecf1f6ff;">
                <div class="pageContent">
                    <div id="pdfLaporan"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cariLaporan() {
        var tanggal_so = $("#tanggal_so").val();
        var tanggal_so2 = $("#tanggal_so2").val();
        if (!tanggal_so || !tanggal_so2) {
            alert('Harap isi tanggalnya !');
            return;
        }
        $.ajax({
            url: "pages/stok_opname/model/cariLaporan.php",
            method: "POST",
            data: {
                tanggal_so: tanggal_so,
                tanggal_so2: tanggal_so2
            },
            dataType: "json",
            async: true,
            success: function(respon) {
                var html = '';
                var i;
                var no = 1;
                for (i = 0; i < respon.length; i++) {
                    html += `
                        <tr>
                            <td>SO-${respon[i].id_so}</td>
                            <td>${respon[i].nm_wh}</td>
                            <td>${formatTanggalIndonesia(respon[i].date_created)}</td>
                            <td>
                                <button onclick="pilihan(this)" data-tgl="${respon[i].date_created}" data-kd_wh="${respon[i].kd_wh}" data-nm_wh="${respon[i].nm_wh}" class="btn btn-sm btn-success"><i class="fa fa-fw fa-search"></i></button>
                            </td>
                        </tr>
                    `
                }
                $("#dataListHeader").html(html);
            }
        })
    }

    function resetPencarian() {
        $("#tanggal_so").val('');
        $("#tanggal_so2").val('');
        $("#pdfLaporan").empty();
        $("#tableInfo").show();
        $("#infoPilihan").hide();
        $("#dataListHeader").empty();
    }

    function pilihan(e) {
        $("#tableInfo").hide();
        $("#infoPilihan").show();
        var tgl = e.getAttribute("data-tgl");
        var kd_wh = e.getAttribute("data-kd_wh");
        var nm_wh = e.getAttribute("data-nm_wh");
        document.getElementById("tglSOHeader").innerHTML = formatTanggalIndonesia(tgl);
        document.getElementById("kodeGudangSO").innerHTML = kd_wh;
        document.getElementById("namaGudangSO").innerHTML = nm_wh;
        $.ajax({
            url: "pages/stok_opname/model/getListPilihan.php",
            method: "POST",
            data: {
                tgl: tgl,
                kd_wh: kd_wh
            },
            dataType: "json",
            async: true,
            success: function(respon) {
                var html = '';
                var i;
                for (i = 0; i < respon.length; i++) {
                    html += `
                        <button onclick="viewLaporan(this)" data-tgl="${tgl}" data-kd_wh="${kd_wh}" data-jenis="${respon[i].jenis}" class="btn btn-sm btn-primary">${respon[i].jenis}</button>
                    `
                }
                html +=
                    `<button onclick="viewLaporan(this)" data-tgl="${tgl}" data-kd_wh="${kd_wh}" data-jenis="All" class="btn btn-sm btn-primary">All</button>`
                $("#buttonPilihan").html(html);
            }
        })
    }

    function tutupInfo() {
        $("#tableInfo").show();
        $("#infoPilihan").hide();
        $("#pdfLaporan").empty();
    }

    function viewLaporan(e) {
        var jenis = e.getAttribute("data-jenis");
        var tgl = e.getAttribute("data-tgl");
        var kd_wh = e.getAttribute("data-kd_wh");

        if (jenis == "All") {
            var iJenis = "";
        } else {
            var iJenis = jenis;
        }

        var url = "pages/stok_opname/print_stock_selisih.php?kd_wh=" + kd_wh +
            "&jenis=" + iJenis + "&instatus_so=&kode_obat=&nama_obat=&tgl_segment=" + tgl +
            "&nm_report=Stock+Selisih&nm_so=Final";
        var html = '';
        html += '<iframe width="100%" height="800" style="visibility:visible" src="' + url + '"></iframe>';
        $("#pdfLaporan").html(html);
    }

    function formatTanggalIndonesia(tanggal) {
        var bulanIndo = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        var tanggalSplit = tanggal.split("-"); //Y-m-d 0-1-2
        return tanggalSplit[2] + " " + bulanIndo[parseInt(tanggalSplit[1]) - 1] + " " + tanggalSplit[0];
    }
</script>
<script>
    var no_daftar = "<?= $daftar[0]['no_daftar'] ?>";
    createNomorMedic();

    function kembali() {
        window.location.href = "index.php?mod=hd&submod=hd"
    }

    function getTransaksi(id) {
        if (id == 1) {
            var transaksi = `<option value="">- Pilih Transaksi -</option>`;
            transaksi += `<option value="1" selected>Ditagihkan ke Pasien</option>`;
            transaksi += `<option value="0">Tidak Ditagihkan</option>`;
        } else if (id == 2) {
            var transaksi = `<option value="">- Pilih Transaksi -</option>`;
            transaksi += `<option value="1">Ditagihkan ke Pasien</option>`;
            transaksi += `<option value="0" selected>Tidak Ditagihkan</option>`;
        } else {
            var transaksi = `<option value="">- Pilih Transaksi -</option>`;
            transaksi += `<option value="1">Ditagihkan ke Pasien</option>`;
            transaksi += `<option value="0">Tidak Ditagihkan</option>`;
        }
        $("#transaksi").html(transaksi);
    }

    function createNomorMedic() {
        var dataPost = "Create Nomor Medic";
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: dataPost,
                no_daftar: no_daftar
            },
            dataType: 'json',
            success: function(data) {
                $('#noMedicID').html(data[0].id);
                $('#noMedic').html(data[0].no_medication);
                $('#nomr').html(data[0].nomr);
                $('#nama').html(data[0].nama);
                $('#tgl_input').html(data[0].tgl_input);

                getTransaksi(data[0].transaksi)
                getDetailSave(data[0].no_medication)
            }
        });
    }

    getDataPaket()

    function getDetailSave(noMedic) {
        var dataPost = "GET Detail Medic";
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: dataPost,
                noMedic: noMedic
            },
            dataType: 'json',
            success: function(data) {
                if (data.jumlahData > 0) {
                    $("#dataPaketSave").show();
                    $("#dataPaket").hide();

                    var html = '';
                    var totalHarga = 0;
                    for (var i = 0; i < data.jumlahData; i++) {
                        var hargaSatuan = data.body[i].harga;
                        var qty = data.body[i].qty;
                        var subtotal = hargaSatuan * qty;
                        totalHarga += subtotal;
                        html += `
                            <tr>
                                <td>${i+1}.</td>
                                <td><button class="btn btn-danger" data-qty="${qty}" data-kodeObat="${data.body[i].kode_obat}" data-id="${data.body[i].id}" onclick="hapusItem(this)"><i class="ui-icon ui-icon-circle-close"></i></button></td>
                                <td><span style="display:none" name="id[]">${data.body[i].id}</span><span style="display:none" name="kode_obat[]">${data.body[i].kode_obat}</span><span name="namaObat[]">${data.body[i].nama_obat}</span></td>
                                <td><span name="satuan[]">${data.body[i].satuan}</span></td>
                                <td><input type="number" class="form-control qty-input" value="${qty}" name="qty[]" disabled data-harga="${hargaSatuan}" oninput="updateHargaSatuan(this)"></td>
                                <td><span name="stock_akhir[]">${data.body[i].stock_akhir}</span></td>
                                <td><span name="harga[]">${formatRupiah(hargaSatuan)}</span></td>
                                <td class="subtotal"><span name="subHarga">${formatRupiah(subtotal)}</span></td>
                            </tr>
                        `;
                    }

                    $(document).on('input', '.qty-input', function() {
                        var totalHarga = 0;
                        $('.qty-input').each(function() {
                            var qty = $(this).val();
                            var hargaSatuan = $(this).data('harga');
                            var subtotal = qty * hargaSatuan;
                            totalHarga += subtotal;
                            $(this).closest('tr').find('.subtotal').html(formatRupiah(subtotal));
                        });
                        $('#totalHarga').html(formatRupiah(totalHarga));
                    });

                    html += `
                        <tr>
                            <td colspan="6" style="text-align:right;"><strong>Total Harga:</strong></td>
                            <td id="totalHarga" colspan="2">${formatRupiah(totalHarga)}</td>
                        </tr>
                    `;

                    $('#dataPaketSave').html(html);

                } else {
                    $("#dataPaketSave").hide();
                }
            }
        });
    }

    function getDataPaket() {
        var dataPost = "Get Data Paket";
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: dataPost
            },
            dataType: 'json',
            success: function(data) {
                var html = '';
                html = '<option value="">- Pilih Paket -</option>';
                for (var i = 0; i < data.jumlahData; i++) {
                    html += '<option value="' + data.body[i].id + '">' + data.body[i].nm_bhp + '</option>';
                }
                $('#idPaket').html(html);
            }
        });
    }

    $('#idPaket').change(function() {
        var id = $(this).val();
        var noMedication = $('#noMedic').html();
        var unit = $('#unit').val();
        if (id == 4) { //kode lainnya
            var dataPost = "Get List Paket By No Medic";
            $.ajax({
                url: 'pages/hd/query.php',
                type: 'post',
                data: {
                    dataPost: dataPost,
                    id: id,
                    noMedication: noMedication
                },
                dataType: 'json',
                success: function(data) {
                    if (data.jumlahData > 0) {
                        var html = '';
                        var totalHarga = 0;
                        for (var i = 0; i < data.jumlahData; i++) {
                            var hargaSatuan = data.body[i].harga_satuan;
                            var qty = data.body[i].qty;
                            var subtotal = hargaSatuan * qty;
                            totalHarga += subtotal;
                            html += `
                            <tr>
                                <td>${i+1}.</td>
                                <td><button class="btn btn-danger" disabled title="Item paket tidak bisa dihapus!" onclick="hapusBaris(this)"><i class="ui-icon ui-icon-circle-close"></i></button></td>
                                <td><span style="display:none" name="id[]">${data.body[i].id}</span><span style="display:none" name="kode_obat[]">${data.body[i].kode_obat}</span><span name="namaObat[]">${data.body[i].nama_obat}</span></td>
                                <td><span name="satuan[]">${data.body[i].satuan}</span></td>
                                <td><input type="number" class="form-control qty-input" value="${qty}" name="qty[]" data-harga="${hargaSatuan}" oninput="updateHargaSatuan(this)"></td>
                                <td><span name="stock_akhir[]">${data.body[i].stock_akhir}</span></td>
                                <td><span name="harga[]">${formatRupiah(hargaSatuan)}</span></td>
                                <td class="subtotal"><span name="subHarga">${formatRupiah(subtotal)}</span></td>
                            </tr>
                        `;
                        }

                        $(document).on('input', '.qty-input', function() {
                            var totalHarga = 0;
                            $('.qty-input').each(function() {
                                var qty = $(this).val();
                                var hargaSatuan = $(this).data('harga');
                                var subtotal = qty * hargaSatuan;
                                totalHarga += subtotal;
                                $(this).closest('tr').find('.subtotal').html(formatRupiah(subtotal));
                            });
                            $('#totalHarga').html(formatRupiah(totalHarga));
                        });

                        html += `
                        <tr>
                            <td colspan="6" style="text-align:right;"><strong>Total Harga:</strong></td>
                            <td id="totalHarga">${formatRupiah(totalHarga)}</td>
                        </tr>
                    `;
                        $("#tambahan").show();
                    } else {
                        createNomorMedic()
                        $('#dataPaket').empty();
                        $("#tambahan").show();
                    }
                    $('#dataPaket').html(html);
                }
            });
        } else {
            var dataPost = "Get List Paket";
            $.ajax({
                url: 'pages/hd/query.php',
                type: 'post',
                data: {
                    dataPost: dataPost,
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    if (data.jumlahData > 0) {
                        var html = '';
                        var totalHarga = 0;
                        for (var i = 0; i < data.jumlahData; i++) {
                            var hargaSatuan = data.body[i].harga_satuan;
                            var qty = data.body[i].qty;
                            var subtotal = hargaSatuan * qty;
                            totalHarga += subtotal;
                            html += `
                            <tr>
                                <td>${i+1}.</td>
                                <td><button class="btn btn-danger" disabled title="Item paket tidak bisa dihapus!" onclick="hapusBaris(this)"><i class="ui-icon ui-icon-circle-close"></i></button></td>
                                <td><span style="display:none" name="id[]">${data.body[i].id}</span><span style="display:none" name="kode_obat[]">${data.body[i].kode_obat}</span><span name="namaObat[]">${data.body[i].nama_obat}</span></td>
                                <td><span name="satuan[]">${data.body[i].satuan}</span></td>
                                <td><input type="number" class="form-control qty-input" value="${qty}" name="qty[]" data-harga="${hargaSatuan}" oninput="updateHargaSatuan(this)"></td>
                                <td><span name="stock_akhir[]">${data.body[i].stock_akhir}</span></td>
                                <td><span name="harga[]">${formatRupiah(hargaSatuan)}</span></td>
                                <td class="subtotal"><span name="subHarga">${formatRupiah(subtotal)}</span></td>
                            </tr>
                        `;
                        }

                        $(document).on('input', '.qty-input', function() {
                            var totalHarga = 0;
                            $('.qty-input').each(function() {
                                var qty = $(this).val();
                                var hargaSatuan = $(this).data('harga');
                                var subtotal = qty * hargaSatuan;
                                totalHarga += subtotal;
                                $(this).closest('tr').find('.subtotal').html(formatRupiah(subtotal));
                            });
                            $('#totalHarga').html(formatRupiah(totalHarga));
                        });

                        html += `
                        <tr>
                            <td colspan="6" style="text-align:right;"><strong>Total Harga:</strong></td>
                            <td id="totalHarga">${formatRupiah(totalHarga)}</td>
                        </tr>
                    `;
                        $("#tambahan").hide();
                    } else {
                        createNomorMedic()
                        $('#dataPaket').empty();
                        $("#tambahan").show();
                    }
                    $('#dataPaket').html(html);
                }
            });
        }


    });

    function tambahItem() {
        var noMedication = $('#noMedic').html();
        var obat = $("#obat").val()
        var dataPost = "Tambah Item Obat";
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                noMedication: noMedication,
                obat: obat,
                dataPost: dataPost
            },
            dataType: 'json',
            success: function(data) {
                getListByNoMedic(noMedication)
            }
        });
    }

    function getListByNoMedic(noMedication) {
        var id = 4;
        var dataPost = "Get List Paket By No Medic";
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: dataPost,
                id: id,
                noMedication: noMedication
            },
            dataType: 'json',
            success: function(data) {
                if (data.jumlahData > 0) {
                    var html = '';
                    var totalHarga = 0;
                    for (var i = 0; i < data.jumlahData; i++) {
                        var hargaSatuan = data.body[i].harga_satuan;
                        var qty = data.body[i].qty;
                        var subtotal = hargaSatuan * qty;
                        totalHarga += subtotal;
                        html += `
                            <tr>
                                <td>${i+1}.</td>
                                <td><button class="btn btn-danger" disabled title="Item paket tidak bisa dihapus!" onclick="hapusBaris(this)"><i class="ui-icon ui-icon-circle-close"></i></button></td>
                                <td><span style="display:none" name="id[]">${data.body[i].id}</span><span style="display:none" name="kode_obat[]">${data.body[i].kode_obat}</span><span name="namaObat[]">${data.body[i].nama_obat}</span></td>
                                <td><span name="satuan[]">${data.body[i].satuan}</span></td>
                                <td><input type="number" class="form-control qty-input" value="${qty}" name="qty[]" data-harga="${hargaSatuan}" oninput="updateHargaSatuan(this)"></td>
                                <td><span name="stock_akhir[]">${data.body[i].stock_akhir}</span></td>
                                <td><span name="harga[]">${formatRupiah(hargaSatuan)}</span></td>
                                <td class="subtotal"><span name="subHarga">${formatRupiah(subtotal)}</span></td>
                            </tr>
                        `;
                    }

                    $(document).on('input', '.qty-input', function() {
                        var totalHarga = 0;
                        $('.qty-input').each(function() {
                            var qty = $(this).val();
                            var hargaSatuan = $(this).data('harga');
                            var subtotal = qty * hargaSatuan;
                            totalHarga += subtotal;
                            $(this).closest('tr').find('.subtotal').html(formatRupiah(subtotal));
                        });
                        $('#totalHarga').html(formatRupiah(totalHarga));
                    });

                    html += `
                        <tr>
                            <td colspan="6" style="text-align:right;"><strong>Total Harga:</strong></td>
                            <td id="totalHarga">${formatRupiah(totalHarga)}</td>
                        </tr>
                    `;
                    $("#tambahan").show();
                } else {
                    createNomorMedic()
                    $('#dataPaket').empty();
                    $("#tambahan").show();
                }
                $('#dataPaket').html(html);
            }
        });
    }

    function formatRupiah(angka) {
        var number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp ' + rupiah;
    }

    function updateHargaSatuan(input) {
        var qty = $(input).val();
        var hargaSatuan = $(input).data('harga');
        var totalHarga = qty * hargaSatuan;
        $(input).closest('tr').find('td:last').html(formatRupiah(totalHarga));
    }

    function simpan() {
        var postData = "Simpan Data Medication";
        var noMedicID = $('#noMedicID').html();
        var noMedic = $('#noMedic').html();
        var unit = $('#unit').val();
        var idPaket = $('#idPaket').val();
        var labelPaket = $('#idPaket option:selected').text();
        var transaksi = $('#transaksi').val();

        var id = [];
        $('span[name="id[]"]').each(function() {
            id.push($(this).html());
        });
        var kode_obat = [];
        $('span[name="kode_obat[]"]').each(function() {
            kode_obat.push($(this).html());
        });
        var namaObat = [];
        $('span[name="namaObat[]"]').each(function() {
            namaObat.push($(this).html());
        });
        var satuan = [];
        $('span[name="satuan[]"]').each(function() {
            satuan.push($(this).html());
        });
        var stock_akhir = [];
        $('span[name="stock_akhir[]"]').each(function() {
            stock_akhir.push($(this).html());
        });
        var harga = [];
        $('span[name="harga[]"]').each(function() {
            harga.push($(this).html().replace(/[^\d]/g, ''));
        });
        var qty = [];
        $('.qty-input').each(function() {
            qty.push($(this).val());
        });

        if (idPaket == '' || !transaksi != '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap inputan diisi.',
                confirmButtonText: 'OK'
            });
            return
        }

        var totalHarga = $('#totalHarga').html().replace(/[^\d]/g, '');
        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: postData,
                noMedicID: noMedicID,
                noMedic: noMedic,
                idPaket: idPaket,
                unit: unit,
                labelPaket: labelPaket,
                transaksi: transaksi,
                totalHarga: totalHarga,
                id: id,
                kode_obat: kode_obat,
                namaObat: namaObat,
                jenis: "OBT-MEDICATION",
                satuan: satuan,
                harga: harga,
                qty: qty,
                stock_akhir: stock_akhir
            },
            dataType: 'json',
            success: function(data) {
                createNomorMedic();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil...',
                    text: 'Paket berhasil disimpan.',
                    confirmButtonText: 'OK'
                });
            }
        });
    }

    function hapusBaris(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    function hapusItem(data) {
        var id = data.getAttribute("data-id");
        var kodeObat = data.getAttribute("data-kodeObat");
        var qty = data.getAttribute("data-qty");
        var postData = "Hapus Item Save";

        $.ajax({
            url: 'pages/hd/query.php',
            type: 'post',
            data: {
                dataPost: postData,
                id: id,
                kodeObat: kodeObat,
                qty: qty
            },
            dataType: 'json',
            success: function(data) {
                createNomorMedic();
            }
        });
    }
</script>
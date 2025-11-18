<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Purchasing</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Informasi Stock Obat</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Informasi Stock Obat per Periode
                    </h3>
                </div>
                <div class="box-content">
                    <div style="text-align: left; margin-left: 10px; margin-top: 0px; margin-bottom: 10px;">
                        Tentukan Periode <input type="date" id="start1" name="start1" value="<?php echo date("Y-m-01") ?>" style="height: 25px;" /> s/d <input type="date" value="<?php echo date("Y-m-d") ?>" id="start2" name="start2" style="height: 25px;" />
                        <select id="obat" name="obat" size="1" style="width: 380px; height: 25px;">
                            <option value="">--Pilih Obat--</option>
                            <?php
                            $dt = $db->query("select kode_obat, nama_obat, jenis from tbl_obat where nama_obat <> '' order by nama_obat");
                            for ($i = 0; $i < count($dt); $i++) {
                                echo '<option value="' . $dt[$i]['kode_obat'] . '">' . $dt[$i]['nama_obat'] . ' (' . $dt[$i]['jenis'] . ')' . '</option>';
                            }
                            ?>
                        </select>
                        <select id="gudang" name="gudang" size="1" style="width: 170px; height: 25px;">
                            <option value="">--Pilih Gudang--</option>
                            <option value="APOTIK">Apotik</option>
                            <option value="GUDANG">Gudang Medik</option>
                            <option value="FISIOTERAPI">Fisioterapi</option>
                            <option value="KEPERAWATAN">Keperawatan</option>
                        </select>
                        &nbsp; &nbsp;<input type="submit" class="btn btn-darkblue rounded" value=" View!! " onclick="TampilLaporan()" />
                    </div>
                    <div id="DetailJasaDokter">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script language="javascript">
    function TampilLaporan() {
        var url = "pages/laporan/stock_view.php";
        var d1 = document.getElementById('start1').value;
        var d2 = document.getElementById('start2').value
        var obat = document.getElementById('obat').value
        var gudang = document.getElementById('gudang').value
        var data = {
            d1: d1,
            d2: d2,
            obat: obat,
            gudang: gudang
        };

        document.getElementById('DetailJasaDokter').innerHTML = 'Tunggu sebentar ....';
        $('#DetailJasaDokter').load(url, data, function() {
            $('#DetailJasaDokter').fadeIn('fast');
        });
    }

    $('#obat').select2({
        placeholder: 'Pilih obat...',
        allowClear: true
    });
</script>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Paket MCU</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Paket  Media Check Up (MCU)
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i>Daftar Paket Media Check Up (MCU)
                                    </h3>
                                    <a href="index.php?mod=mcu&submod=paket_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Paket MCU</a>

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Nama Paket</th>
                                                <th rowspan="2">COA</th>
                                                <th rowspan="2">COA Beban</th>
                                                <th rowspan="2">Berlaku Mulai</th>
                                                <th rowspan="2">Berlaku Hingga</th>
                                                <th colspan="2" style="text-align: center;">Total Tarif</th>
                                                <th rowspan="2" style="width:80px">Option</th>
                                            </tr>
                                            <tr>
                                                <th>Standard</th>
                                                <th>Asuransi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $data = $db->query("select * from tbl_paketmcu_header", 0);

                                            for ($i = 0; $i < count($data); $i++) {
                                                $totalTarif = $db->query("select sum(standard) jml_standard, sum(asuransi) jml_asuransi from tbl_paketmcu_detail where paketmcu_id='".$data[$i]['id']."'", 0);
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i + 1 ?></td>
                                                    <td><?php echo $data[$i]['nama'] ?></td>
                                                    <td><?php echo $data[$i]['coa_kode'].' - '.$data[$i]['coa_nama'] ?></td>
                                                    <td><?php echo $data[$i]['coa_beban_kode'].' - '.$data[$i]['coa_beban_nama'] ?></td>
                                                    <td><?php echo date("d-M-Y", strtotime($data[$i]['mulai'])) ?></td>
                                                    <td><?php echo date("d-M-Y", strtotime($data[$i]['sampai'])) ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($totalTarif[0]['jml_standard']) ?></td>
                                                    <td style="text-align: right;"><?php echo number_format($totalTarif[0]['jml_asuransi']) ?></td>
                                                    <td class="text-center">
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Detail Paket MCU" href="index.php?mod=mcu&submod=paket_detail&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-plus"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=mcu&submod=paket_edit&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Hapus Modul MCU" href="#" onclick="return window.location = 'pages/mcu/paket_hapus.php?id=<?php echo md5($data[$i]['id']) ?>';">
                                        			<span class="ui-icon ui-icon-circle-close"></span>
                                    			    </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
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

<script>
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    })

    function jadiAktif(id) {
		if (confirm("Apakah Anda yakin akan me NON Aktifkan Modul MCU ini?") == true) {
			window.location = "pages/mcu/module_aktif.php?id=" + id;
		}
    }

</script>
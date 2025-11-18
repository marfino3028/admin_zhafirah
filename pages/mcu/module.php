<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Pendaftaran</a>
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
                    <h3>
                        <i class="fa fa-bars"></i>
                        Modul Media Check Up
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i>Daftar Modul Media Check Up (MCU)
                                    </h3>
                                    <a href="index.php?mod=mcu&submod=madule_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Modul MCU</a>

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Nama Modul</th>
                                                <th rowspan="2">Membutuhkan<br>Dokter</th>
                                                <th style="text-align: center;" colspan="3">Tarif</th>
                                                <th rowspan="2">Urutan</th>
                                                <th rowspan="2">Komponen</th>
                                                <th rowspan="2">Keterangan</th>
                                                <th style="width:80px" rowspan="2">Option</th>
                                            </tr>
                                            <tr>
                                                <th>Dokter</th>
                                                <th>Rumah Sakit</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $data = $db->query("select * from tbl_modul_mcu where status_aktif='AKTIF'", 0);

                                            for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i + 1 ?></td>
                                                    <td><?php echo $data[$i]['nama'] ?></td>
                                                    <td><?php echo $data[$i]['butuhdokter'] ?></td>
                                                    <td><?php echo number_format($data[$i]['dokter']) ?></td>
                                                    <td><?php echo number_format($data[$i]['rs']) ?></td>
                                                    <td><?php echo number_format($data[$i]['total']) ?></td>
                                                    <td><?php echo $data[$i]['urutan'] ?></td>
                                                    <td><?php echo $data[$i]['komponen'] ?></td>
                                                    <td><?php echo $data[$i]['keterangan'] ?></td>
                                                    <td class="text-center">
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=mcu&submod=module_edit&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Hapus Modul MCU" href="#" onclick="return window.location = 'pages/mcu/modul_hapus.php?id=<?php echo md5($data[$i]['id']) ?>';">
                                        			<span class="ui-icon ui-icon-circle-close"></span>
                                    			    </a>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Hapus Modul MCU" href="#" onclick="jadiAktif('<?php echo md5($data[$i]['id']) ?>')">
                                        			aktif
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
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Dokter</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Dokter
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i> Daftar/List Dokter
                                    </h3>
                                    <a href="index.php?mod=master&submod=dokter_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Dokter</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
				    <p style="margin-left: 5%; margin-top: 10px; font-size: 20px; font-weight: bold;">Daftar Dokter yang masih DRAFT</p>
                                    <table id="table-data-draft" class="table table-hover table-bordered table-striped table-condensed" style="margin-left: 3%; margin-bottom: 20px;; width: 94%;">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Nama Dokter</th>
                                            <th>Poli</th>
                                            <th style="text-align: right;">Tarif Dokter</th>
                                            <th>NPWP</th>
                                            <th style="text-align: right;">Proffessional Fee</th>
                                            <th>&nbsp</th>
                                            <th style="width:70px">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select a.*, b.nama_poli from tbl_dokter_draft a left join tbl_poli b on b.kd_poli=a.kd_poli where a.status_delete='UD' and a.status_publish='DRAFT' order by a.id", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kode_dokter'].' - '.$data[$i]['nama_dokter']?></td>
                                                <td><?php echo $data[$i]['nama_poli']?></td>
                                                <td align="right"><?php echo number_format($data[$i]['tarif_dokter'])?></td>
                                                <td><?php echo $data[$i]['npwp']?></td>
                                                <td align="right"><?php echo number_format($data[$i]['professional_fee'])?></td>
                                                <td style="text-align: center; cursor: pointer;" title="Konfirm Master Dokter agar tidak menjadi Draft Lagi" onclick="konfirmasiDokter('<?php echo md5($data[$i]['id'])?>')">confirm?</td>
                                                <td class="text-center">DRAFT</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered nomargin">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <th>Poli</th>
                                            <th>Tarif Dokter</th>
                                            <th>Tarif Jamsostek</th>
                                            <th>NPWP</th>
                                            <th>Proffesional Fee</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select a.*, b.nama_poli from tbl_dokter a left join tbl_poli b on b.kd_poli=a.kd_poli where a.status_delete='UD' order by a.id", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $start + $i + 1;
                                            ?>
                                            <tr>
                                                <td class="center"><?php echo $no?></td>
                                                <td><?php echo $data[$i]['nama_dokter']?></td>
                                                <td><?php echo $data[$i]['nama_poli']?></td>
                                                <td align="right"><?php echo number_format($data[$i]['tarif_dokter'])?></td>
                                                <td align="right"><?php echo number_format($data[$i]['tarif_jamsostek'])?></td>
                                                <td><?php echo $data[$i]['npwp']?></td>
                                                <td align="right"><?php echo number_format($data[$i]['professional_fee'])?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=dokter_edit&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/dokter_delete.php?id=<?php echo $data[$i]['id']?>';">
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
<script language="javascript">
	function konfirmasiDokter(id) {
		if (confirm("Apakah Anda yakin akan meng-konfirmasi Dokter ini?") == true) {
			window.location = "pages/master/dokter_confirm.php?id=" + id;
		}
	}
</script>

<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
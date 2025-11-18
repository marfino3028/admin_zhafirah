<?php
	$sub = $db->query("select * from tbl_pegawai where id='".$_GET['id']."'");
	$t1 = explode("-", $sub[0]['tgl_lahir']);
	$sub[0]['tgl_lahir'] = $t1[1].'/'.$t1[2].'/'.$t1[0];

	$t2 = explode("-", $sub[0]['tgl_masuk']);
	$sub[0]['tgl_masuk'] = $t2[1].'/'.$t2[2].'/'.$t2[0];
	
	//$nsbu = $db->queryItem("select nama from tbl_sbu where id='".$sub[0]['kode_']."'");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Master Data</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Perusahaan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Perusahaan
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i> Daftar Klinik/Perusahaan
                                    </h3>
                                    <a href="index.php?mod=master&submod=perusahaan_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Perusahaan</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">
				    <p style="margin-left: 5%; margin-top: 10px; font-size: 20px; font-weight: bold;">Daftar Perusahaan/Klinik yang masih DRAFT</p>
                                    <table id="table-data-draft" class="table table-hover table-bordered table-striped table-condensed" style="margin-left: 3%; margin-bottom: 20px;; width: 94%;">
                                        <thead>
                                        <tr>
                                            <th style="width:40px">No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat Perusahaan</th>
                                            <th>PIC</th>
                                            <th>No. Telp</th>
                                            <th style="width:70px">&nbsp;</th>
                                            <th style="width:70px">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select * from tbl_perusahaan_draft where status_delete='UD' and status_publish='DRAFT' order by id desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kode_perusahaan'].' - '.$data[$i]['nama_perusahaan']?></td>
                                                <td><?php echo $data[$i]['alamat_perusahaan']?></td>
                                                <td><?php echo $data[$i]['pic_contact']?></td>
                                                <td><?php echo $data[$i]['telp']?></td>
                                                <td style="text-align: center; cursor: pointer;" title="Konfirm Perusahaan agar tidak menjadi Draft Lagi" onclick="konfirmasiPerusahaan('<?php echo md5($data[$i]['id'])?>')">confirm?</td>
                                                <td class="text-center">DRAFT</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <table id="table-data" class="table table-hover table-nomargin dataTable table-bordered table-striped table-condensed nomargin">
                                        <thead>
                                        <tr>
                                            <th style="width:40px; text-align: center;">No</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Alamat Perusahaan</th>
                                            <th>Akun Bank</th>
                                            <th style="width:70px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $data = $db->query("select * from tbl_perusahaan where status_delete='UD' order by id", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['kode_perusahaan'].' - '.$data[$i]['nama_perusahaan']?></td>
                                                <td><?php echo $data[$i]['alamat_perusahaan']?></td>
                                                <td><?php echo $data[$i]['bank_name'].'-'.$data[$i]['norek_provider']?></td>
                                                <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=perusahaan_edit&id=<?php echo md5($data[$i]['id'])?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/perusahaan_delete.php?id=<?php echo $data[$i]['id']?>';">
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
	function konfirmasiPerusahaan(id) {
		if (confirm("Apakah Anda yakin akan meng-konfirmasi Perusahaan ini?") == true) {
			window.location = "pages/master/perusahaan_confirm.php?id=" + id;
		}
	}
</script>

<script>
    $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
</script>
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
                <a href="javascript:void(0)">Tarif Layanan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Tarif Layanan
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
                                    </h3>
                                    <a href="index.php?mod=master&submod=tarif_layanan_new"  class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data Tarif Layanan</a>
                                </div>
                                <div class="box-content nopadding" style="padding-bottom: 50px!important;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable dataTable-grouping table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:30px">No</th>
                                            <th>Jenis Tarif</th>
                                            <th>Nama Tindakan</th>
					    <th style="width:40px">Group Tarif</th>
                                            <th style="width:40px">Kategori</th>
                                            <th style="width:50px">Tarif</th>
                                            <th style="width:120px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $db->query("select * from tbl_jns_tarif where status_delete='UD'", 0);
                                        for ($i = 0; $i < count($data); $i++) {

                                            ?>
                                            <?php
                                            if ($_POST['search'] == "")
                                                $sub = $db->query("select a.*, b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.status_delete='UD' and b.status_delete='UD' and a.kode_jns_tarif='".$data[$i]['kode_jns_tarif']."' order by a.kode_kat_pelayanan");
                                            else
                                                $sub = $db->query("select a.*, b.nama_kat_pelayanan from tbl_tarif a left join tbl_kat_pelayanan b on b.kode_kat_pelayanan=a.kode_kat_pelayanan where a.status_delete='UD' and b.status_delete='UD' and a.kode_jns_tarif='".$data[$i]['kode_jns_tarif']."' and a.nama_pelayanan like '%".$_POST['search']."%' order by a.kode_kat_pelayanan");

                                            for ($j = 0; $j < count($sub); $j++) {
                                                if ($sub[$j]['tarif_min'] < $sub[$j]['tarif_max']) $sub[$j]['tarif_min'] = number_format($sub[$j]['tarif_min']).' - '.number_format($sub[$j]['tarif_max']);
                                                else $sub[$j]['tarif_min'] = number_format($sub[$j]['tarif_min']);
                                                ?>
                                                <tr>
                                                    <td><?php echo $j+1?></td>
                                                    <td><?=$data[$i]['nama_jns_tarif']?></td>
                                                    <td><?php echo $sub[$j]['nama_pelayanan']?></td>
						    <td><?php echo $sub[$j]['nm_gt']?></td>
                                                    <td><?php echo $sub[$j]['nama_kat_pelayanan']?></td>
                                                    <td><?php echo $sub[$j]['tarif_min']?></td>
                                                    <td class="text-center">
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Tarif Per Kelas" href="index.php?mod=master&submod=tarif_kelas&id=<?php echo $sub[$j]['id']?>">
                                                        <span class="glyphicon-show_thumbnails_with_lines"></span>
                                                    </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=master&submod=tarif_layanan_edit&id=<?php echo $sub[$j]['id']?>">
                                                            <span class="glyphicon-edit"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/master/tarif_layanan_delete.php?id=<?php echo $sub[$j]['id']?>';">
                                                            <span class="glyphicon-bin"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
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
        order: [[1, 'asc']],
        rowGroup: {
            dataSrc: [ 1, 3 ]
        },
        columnDefs: [ {
            targets: [ 1 ],
            visible: false
        } ],
        responsive: true
    })
</script>
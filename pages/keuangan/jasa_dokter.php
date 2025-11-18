<?php
	if ($_GET['search'] != "") $_POST['search'] = $_GET['search'];
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Input Jasa Dokter</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Jasa Dokter
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Data Jasa Dokter
                                    </h3>
                                    <a href="index.php?mod=keuangan&submod=input_jasaDokter_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Jasa Dokter</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">No</th>
                                            <th>Nama Dokter</th>
                                            <th>Periode Waktu</th>
                                            <th style="width:100px">Total Honor</th>
                                            <th style="width:100px">Option</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $start = $_GET['start'];
                                        $apage = $_GET['apage'];
                                        $number = $_GET['number'];
                                        if(!isset($start)) $start=0;
                                        if(!isset($apage)) $apage=3;

                                        if ($_POST['search'] == "")
                                            $data_nr = $db->queryItem("select count(a.id) from tbl_obygn a where a.status_delete='UD'", 0);
                                        else
                                            $data_nr = $db->queryItem("select a.no_gigi, a.nomr, a.nama, a.id, a.total_harga_obygn from tbl_obygn a where a.status_delete='UD' and a.nama like '%".$_POST['search']."%'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=poli&submod=kandunganInput";
                                        else
                                            $page->link="index.php?mod=poli&submod=kandunganInput&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select * from tbl_bayar_dokter  order by id desc", 0);
                                        else
                                            $data = $db->query("select * from tbl_bayar_dokter a order by a.id desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $no = $start + $i + 1;
                                            $tarif = $db->query("select sum(tarif) as tarif, sum(biaya_dokter) as dokter, sum((tarif-biaya_dokter)) as upk from tbl_obygn_detail where obygnID='".$data[$i]['id']."'");
                                            ?>
                                            <tr>
                                                <td style="width: 30px"><?php echo $no?></td>
                                                <td><?php echo $data[$i]['nama_dokter']?></td>
                                                <td style="text-align: center"><?php echo date("d-M-Y", strtotime($data[$i]['tgl_start'])).' s/d '.date("d-m-Y", strtotime($data[$i]['tgl_end']))?></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total_jasa']-$data[$i]['npwp'])?></div></td>
                                                <td class="text-center">
						<?php
							if ($data[$i]['status_payment'] == 'SDH') {
								echo 'Sudah Dibayar';
							}
							else {
						?>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" href="#"  title="Print Pembayaran Dokter" onclick="BayarDokter('<?php echo $data[$i]['no_bayar']?>')">
                                                        <span class="ui-icon ui-icon-print"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Daftar Pasien Terbayarkan" href="index.php?mod=keuangan&submod=pasien&id=<?php echo $data[$i]['id']?>">
                                                        <span class="ui-icon ui-icon-wrench"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/keuangan/jasa_dokter_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                        <span class="ui-icon ui-icon-circle-close"></span>
                                                    </a>
                                                    <a class="btn_no_text btn" style="border-radius: 4px;" title="Bayar Jasa Dokter" href="#" onclick="return window.location = 'index.php?mod=keuangan&submod=bayar_dokter&id=<?php echo md5($data[$i]['id'])?>';">
                                                        <span class="ui-icon ui-icon-calendar"></span>
                                                    </a>
						<?php
							}
						?>
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
            $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>
<script language="javascript">
	function BayarDokter(id) {
		var w = 550;
		var h = 500;
		var l = (screen.width - w) / 2;
		var t = (screen.height - h) / 2;
		var windowprops = "location=no,scrollbars=yes,menubars=no,toolbars=no, toolbox=no,resizable=yes" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;
		
		var URL = 'pages/keuangan/print_pembayaran_dokter.php?id=' + id;
		popup = window.open(URL,"",windowprops);
	}
</script>
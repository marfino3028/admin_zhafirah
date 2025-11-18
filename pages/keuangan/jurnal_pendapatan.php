<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Keuangan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Jurnal Otomatis Pendapatan</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Jurnal Otomatis Pendapatan
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

                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:30px">No</th>
                                            <th style="width:70px">Tanggal</th>
                                            <th style="width:70px">No. Jurnal</th>
                                            <th>Deskripsi</th>
                                            <th style="width:40px">Kode Akun</th>
                                            <th>Nama Akun</th>
                                            <th style="width:65px">Debet</th>
                                            <th style="width:65px">Kredit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $start = $_GET['start'];
                                        $apage = $_GET['apage'];
                                        $number = $_GET['number'];
                                        if(!isset($start)) $start=0;
                                        if(!isset($apage)) $apage=5;

                                        if ($_POST['search'] == "")
                                            $data_nr = $db->queryItem("select count(id) from tbl_jurnal_otm where status_delete='UD'", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(id) from tbl_jurnal_otm where deskripsi like '%".$_POST['search']."%' and status_delete='UD'", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=keuangan&submod=jurnal_pendapatan";
                                        else
                                            $page->link="index.php?mod=keuangan&submod=jurnal_pendapatan&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "") {
                                            $data = $db->query("select * from tbl_jurnal_otm where status_delete='UD' order by id desc", 0);
                                        }
                                        else {
                                            $data = $db->query("select * from tbl_jurnal_otm where deskripsi like '%".$_POST['search']."%' and status_delete='UD' order by id desc", 0);
                                        }
                                        for ($i = 0; $i < count($data); $i++) {
                                            $kode_nama = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode']."'");
                                            $kode_nama_inv = $db->queryItem("select nm_coa from tbl_coa where kd_coa='".$data[$i]['kode_inv']."'");
                                            ?>
                                            <tr>
                                                <td rowspan="2"><?php echo $i+1?></td>
                                                <td rowspan="2"><?php echo date("d-m-Y", strtotime($data[$i]['tanggal_transaksi']))?></td>
                                                <td rowspan="2"><?php echo $data[$i]['no_jurnal']?></td>
                                                <td rowspan="2"><?php echo $data[$i]['deskripsi']?></td>
                                                <td><?php echo $data[$i]['kode']?></td>
                                                <td><?php echo $kode_nama?></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['nilai'])?></div></td>
                                                <td align="right"><div align="right">0</div></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $data[$i]['kode_inv']?></td>
                                                <td> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo $kode_nama_inv?></td>
                                                <td align="right"><div align="right">0</div></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['nilai'])?></div></td>
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
            // $('#table-data').DataTable({responsive: true, columnDefs:[{targets: [0],orderable: false}]})
        </script>
<script language="javascript">
	function HapusDataJurnal(id, no) {
		var r = confirm("Apakan Anda Yakin akan Menghapus Jurnal ini " + no +"?");
		if (r == true) {
		  window.location = "pages/keuangan/jurnal_delete.php?id=" + id;
		}
	}
</script>
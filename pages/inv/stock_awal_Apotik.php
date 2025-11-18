<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Obat Apotik
                </a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Stock Awal: Obat Apotik
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
                                        List / Daftar Stock Awal Apotik
                                    </h3>
                                    <a href="index.php?mod=inv&submod=stock_awal_input" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Tambah Data</a>
                                </div>
                                <div class="box-content" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-striped dataTable table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align: center;vertical-align: center;">Nama Obat</th>
                                            <th colspan="12" style="text-align: center;vertical-align: center;">Tahun <?php echo date("Y")?></th>
                                        </tr>
                                        <tr>
                                            <?php
                                            $bln = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des');
                                            for ($i = 0; $i < count($bln); $i++) {
                                                echo '<th style="text-align: center;">'.$bln[$i].'</th> ';
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $start = $_GET['start'];
                                        $apage = $_GET['apage'];
                                        $number = $_GET['number'];
                                        if(!isset($start)) $start=0;
                                        if(!isset($apage)) $apage=10;

                                        if ($_POST['search'] == "")
                                            $data_nr = $db->queryItem("select count(tmp.id) from (select a.kode_obat as id from tbl_stock_awal_apotik a group by a.tahun, a.kode_obat order by a.nama_obat) tmp", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(tmp.id) from (select a.kode_obat as id from tbl_stock_awal_apotik a where a.nama_obat like '%".$_POST['search']."%' group by a.tahun, a.kode_obat order by a.nama_obat) tmp", 0);
                                        $nrdata = $data_nr;

                                        if(!isset($number)) $number=$nrdata;
                                        $page=new pages();
                                        if ($_POST['search'] == "")
                                            $page->link="index.php?mod=pendaftaran&submod=index";
                                        else
                                            $page->link="index.php?mod=pendaftaran&submod=index&search=".$_POST['search'];

                                        $page->start=$start;
                                        $page->apage=$apage;
                                        $page->number=$number;
                                        $page->total();
                                        $pagehtml=$page->html;

                                        if ($_POST['search'] == "")
                                            $data = $db->query("select a.kode_obat, a.nama_obat, a.tahun from tbl_stock_awal_apotik a order by a.nama_obat", 0);
                                        else
                                            $data = $db->query("select a.kode_obat, a.nama_obat, a.tahun from tbl_stock_awal_apotik a where a.nama_obat like '%".$_POST['search']."%' order by a.nama_obat desc", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data[$i]['nama_obat'].' ('.$data[$i]['kode_obat'].')'?></td>
                                                <?php
                                                for ($j = 0; $j < count($bln); $j++) {
                                                    $blnKe = $j + 1;
                                                    $nilai_stok = $db->queryItem("select nilai from tbl_stock_awal_apotik where tahun='".$data[$i]['tahun']."' and bulan='".$blnKe."' and kode_obat='".$data[$i]['kode_obat']."'", 0);
                                                    if ($nilai_stok > 0) $nilai_stok_txt = number_format($nilai_stok);
                                                    else $nilai_stok_txt = '-';
                                                    echo '<td style="text-align: center;">'.$nilai_stok_txt.'</td>';
                                                }
                                                ?>
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
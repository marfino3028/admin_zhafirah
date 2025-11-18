<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Warehouse</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Penerimaan Obat</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-bars"></i>
                        Data Penerimaan Obat
                    </h3>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-table"></i>
					Daftar Penerimaan Obat
                                    </h3>
                                    <a href="index.php?mod=inv&submod=penerimaan_obat_input" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Input Penerimaan Obat</a>
                                </div>
                                <div class="box-content nopadding" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width:20px">No</th>
                                            <th style="width:120px">No. Penerimaan</th>
                                            <th style="width:90px">No. Faktur</th>
                                            <th style="width:60px">Tgl Faktur</th>
                                            <th style="width:90px">Total</th>
                                            <th>Vendor</th>
                                            <th>Supplier</th>
                                            <th style="width:70px">OPT</th>
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
                                            $data_nr = $db->queryItem("select count(tmp.id) from (select a.kode_obat as id from tbl_stock_awal a group by a.tahun, a.kode_obat order by a.nama_obat) tmp", 0);
                                        else
                                            $data_nr = $db->queryItem("select count(tmp.id) from (select a.kode_obat as id from tbl_stock_awal a where a.nama_obat like '%".$_POST['search']."%' group by a.tahun, a.kode_obat order by a.nama_obat) tmp", 0);
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
                                            $data = $db->query("select * from tbl_penerimaan where status_delete='UD' order by tgl_faktur desc", 0);
                                        else
                                            $data = $db->query("select * from tbl_penerimaan where status_delete='UD' where no_faktur like '%".$_POST['search']."%' ", 0);
                                        for ($i = 0; $i < count($data); $i++) {
                                            $data[$i]['total_harga'] = $db->queryItem("select sum(total) from tbl_penerimaan_detail where no_penerimaan='".$data[$i]['no_penerimaan']."' and status_delete='UD'");
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1?></td>
                                                <td><?php echo $data[$i]['no_penerimaan']?></td>
                                                <td><?php echo $data[$i]['no_faktur']?></td>
                                                <td><?php echo date("d/m/Y", strtotime($data[$i]['tgl_faktur']))?></td>
                                                <td align="right"><div align="right"><?php echo number_format($data[$i]['total_harga'])?></div></td>
                                                <td align="right"><div align="left"><?php echo $data[$i]['nama_vendor']?></div></td>
                                                <td align="right"><div align="left"><?php echo $data[$i]['nama_supplier']?></div></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($data[$i]['status_update'] == 'NOUPDATE') {
                                                        ?>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=inv&submod=penerimaan_obat_input_detail&id=<?php echo md5($data[$i]['id'])?>">
                                                            <span class="ui-icon ui-icon-wrench"></span>
                                                        </a>
                                                        <a class="btn_no_text btn" style="border-radius: 4px;" title="Delete" href="#" onclick="return window.location = 'pages/inv/penerimaan_obat_delete.php?id=<?php echo $data[$i]['id']?>';">
                                                            <span class="ui-icon ui-icon-circle-close"></span>
                                                        </a>
                                                        <?php
                                                    }
                                                    else echo 'UPDATE';
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
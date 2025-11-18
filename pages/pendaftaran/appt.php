<?php
    if ($_POST['start1'] == "") $_POST['start1'] = date("Y-m-d");
    if ($_POST['start2'] == "") $_POST['start2'] = date("Y-m-d");
?>
<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Booking Hemodialisa</a>
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
                        Booking HD
                    </h3>
                </div>
                <div class="box-title">
                    <div class="box">
                        <form action="index.php?mod=pendaftaran&submod=appt" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered form-column" name="form_karyawan" id="form_karyawan">
                            Periode <input type="date" id="start" name="start1" value="<?php echo $_POST['start1'] ?>" style="height: 25px;" /> s/d <input type="date" value="<?php echo $_POST['start2'] ?>" id="start2" name="start2" style="height: 25px;" /> &nbsp; &nbsp;
                            <select id="metode" name="metode" size="1" style="width: 170px; height: 25px;">
                                    <option value="">--Pilih Account Booking--</option>
                                    <option value="Walk-In">Walk-In</option>
                                    <option value="Mobile Apps">Mobile Apps</option>
                            </select>
                            </select> &nbsp; &nbsp;
                            <input type="submit" class="btn btn-darkblue rounded" value=" View!! " />
			    <div style="float: right; margin-right: 50px;">
                            <a href="index.php?mod=hd&submod=hd_mesin" style="margin-right: 15px;">
                            <button type="button" class="btn btn-primary">Ketersediaan Mesin</button></a></div>
                        </form>
                    </div>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small" style="padding-bottom: 50px!important;">
                                <div class="box-title">
                                    <h3 style="padding-right: 50px;">
                                        <i class="fa fa-table"></i>List / Daftar Booking Hemodialisa (HD)
                                    </h3>
                                    <a href="index.php?mod=pendaftaran&submod=appt_pasienNew" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Booking HD Pasien Baru</a>
                                    <a href="index.php?mod=pendaftaran&submod=appt_new" class="btn btn-sm btn-small btn-darkblue rounded pull-right"><span class="fa fa-plus-circle"></span> Booking HD Pasien Lama</a>

                                </div>
                                <div class="box-content" style="overflow-x:auto;">

                                    <table id="table-data" class="table table-hover table-responsive table-nomargin dataTable table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:40px">No</th>
                                                <th style="width:70px">No.MR</th>
                                                <th style="width:70px">Tgl.Appt</th>
                                                <th>Nama Pasien</th>
                                                <th>User Input</th>
                                                <th style="width:70px">Poli</th>
                                                <th style="width:70px">Dokter</th>
                                                <th style="width:70px">Sumber Appt</th>
                                                <th style="width:70px">Status</th>
                                                <th style="width:90px">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $data = $db->query("select * from tbl_perjanjian where status_delete='UD' and tgl_daftar >= '".$_POST['start1']."' and tgl_daftar <= '".$_POST['start2']."' and status_daftar='BLM' order by id desc", 0);

                                            for ($i = 0; $i < count($data); $i++) {
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i + 1 ?></td>
                                                    <td>
                                                        <?php 
                                                            if ($data[$i]['nomr'] == 'OTC') {
                                                                echo '<a href="index.php?mod=pendaftaran&submod=otc&id='.md5($data[$i]['id']).'">'.$data[$i]['nomr'].'</a>'; 
                                                            }
                                                            else {
                                                                echo '<a href="index.php?mod=pendaftaran&submod=otc_daftar&id='.md5($data[$i]['id']).'">'.$data[$i]['nomr'].'</a>'; 
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $data[$i]['tgl_daftar'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if ($data[$i]['nomr'] == 'OTC') {
                                                                echo '<a href="index.php?mod=pendaftaran&submod=otc&id='.md5($data[$i]['id']).'">'.$data[$i]['nama'].'</a>'; 
                                                            }
                                                            else {
                                                                echo '<a href="index.php?mod=pendaftaran&submod=otc_daftar&id='.md5($data[$i]['id']).'">'.$data[$i]['nama'].'</a>'; 
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $data[$i]['user_input'] ?></td>
                                                    <td><?php echo $data[$i]['nama_poli'] ?></td>
                                                    <td><?php echo $data[$i]['nama_dokter'] ?></td>
                                                    <td><?php echo $data[$i]['sumber'] ?></td>
                                                    <td>
							<?php 
								if ($data[$i]['status_pasien'] == "CANCLE") echo "<span style=\"color: red; \"><strong>CANCEL</strong></span><br>".$data[$i]['mesinHD_nama']; 
								else {
									if ($data[$i]['status_pasien'] == "OPEN" and $data[$i]['mesinHD_nama'] == "") {
										echo 'WAITING';
									}
									else {
										if ($data[$i]['status_pasien'] == "OPEN") {
											echo 'BOOKING<br>'.$data[$i]['mesinHD_nama'];
										}
										else {
											echo $data[$i]['status_pasien'].'<br>'.$data[$i]['mesinHD_nama'];
										}
									}
								}
							?>
						    </td>
                                                    <td class="text-center" style="width: 140px;">
                                                        <?php
								if ($data[$i]['status_pasien'] == "CANCLE") {
									echo "";
								}
								else {

                                                        if ($data[$i]['nomr'] == 'OTC') {
                                                        ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=pendaftaran&submod=appt_pasien_edit&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                        <?php
                                                        }
                                                        else {
                                                        ?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Edit" href="index.php?mod=pendaftaran&submod=appt_edit&id=<?php echo md5($data[$i]['id']) ?>">
                                                                <span class="ui-icon ui-icon-wrench"></span>
                                                            </a>
                                                        <?php
                                                        }
							?>
                                                            <a class="btn_no_text btn" style="border-radius: 4px;" title="Pembatalan Pendaftaran Pasien" href="#" onclick="return window.location = 'pages/pendaftaran/appt_batal.php?id=<?php echo md5($data[$i]['id']) ?>';">
                                                                <span class="ui-icon ui-icon-circle-close"></span>
                                                            </a>
                                                            <a class="btn_no_text" title="Kirim Notifikasi Appointment Melalui WhatsApp" href="#" onclick="return window.location = 'pages/pendaftaran/wa_perjanjian.php?id=<?php echo md5($data[$i]['id'])?>';">
                                                                <img src="images/wa_logo.png" width="16" style="margin-top: 7px; margin-left: -15px;">
                                                            </a>
                                                            <a class="btn_no_text" title="Antrian Appointment Melalui WhatsApp dan Print" href="#" onclick="CetakKartu('<?php echo md5($data[$i]['id'])?>')">
                                                                <img src="images/antrian.png" width="16" style="margin-top: 7px; margin-left: -15px;">
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
    $('#table-data').DataTable({
        responsive: true,
        columnDefs: [{
            targets: [0],
            orderable: false
        }]
    })

        function CetakKartu(id) {
            var w = 300;
            var h = 350;
            var l = (screen.width - w) / 2;
            var t = (screen.height - h) / 2;
            var windowprops = "location=no,scrollbars=no,menubars=no,toolbars=no, toolbox=no,resizable=no" + ",left=" + l + ",top=" + t + ",width=" + w + ",height=" + h;

            var URL = 'pages/pendaftaran/wa_antrian.php?id=' + id;
            if (id != 0) {
                popup = window.open(URL,"",windowprops);
            }
        }
</script>
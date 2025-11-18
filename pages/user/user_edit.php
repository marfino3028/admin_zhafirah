<?php
	$dataUser = $db->query("select * from tbl_user where md5(id)='".$_GET['id']."'");
?>

<link rel="stylesheet" href="https://codyhouse.co/codyframe/main/css/reset.css">
<link rel="stylesheet" href="https://codyhouse.co/codyframe/main/css/typography.css">
<link id="cd-base-part-1" rel="stylesheet" href="https://codyhouse.co/codyframe/main/css/reset.css">

<script>
      if('CSS' in window && CSS.supports('color', 'var(--color-var)')) {
        document.write('<link rel="stylesheet" href="https://codyhouse.co/app/components/source-v4/password-strength/dist/password-strength.css?v=10000000210">');
      } else {
        document.write('<link rel="stylesheet" href="https://codyhouse.co/app/components/source-v4/password-strength/dist/password-strength-ie.css">');
      }
    </script>
<noscript>
      <link rel="stylesheet" href="https://codyhouse.co/app/components/source-v4/password-strength/dist/password-strength.css?v=10000000210">
    </noscript>

<link id="cd-cdf-util" rel="stylesheet" href="https://codyhouse.co/codyframe/main/css/util.css?v=1">

<div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="javascript:void(0)">Hak Akses</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">
                    USER MANAGEMENT

                </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="javascript:void(0)">Edit Data User</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box box-color box-bordered box-small blue">
                                <div class="box-title">
                                    <h3>
                                        <i class="fa fa-edit"></i>
                                        Form Edit Data User
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <form method="post" action="pages/user/user_update.php" enctype="multipart/form-data" class="form-horizontal form-bordered" name="form_karyawan" id="form_karyawan" >
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Jenis User</label>
                                            <div class="col-sm-3">
						<select id="status_demo" name="status_demo" class='chosen-select form-control'>
                        	<?php
								if ($dataUser[0]['jenis_akun'] == 'REGULER') {
									echo '<option value="REGULER" selected>Akun Reguler</option><option value="DEMO">Akun Demo</option><option value="DOKTER">Akun Dokter</option>';
								}
								elseif ($dataUser[0]['jenis_akun'] == 'DEMO') {
									echo '<option value="REGULER">Akun Reguler</option><option value="DEMO" selected>Akun Demo</option><option value="DOKTER">Akun Dokter</option>';
								}
								elseif ($dataUser[0]['jenis_akun'] == 'DOKTER') {
									echo '<option value="REGULER">Akun Reguler</option><option value="DEMO">Akun Demo</option><option value="DOKTER" selected>Akun Dokter</option>';
								}
							?>
						</select>
                                            </div>
                                            <label for="textfield" class="control-label col-sm-3" style="text-align: right;">Pilih Nama Dokter<br><small>(apabila bukan akun Dokter bisa dikosongkan)</small></label>
                                            <div class="col-sm-4">
						<select id="dokter" name="dokter" class='chosen-select form-control'>
						    <option value="">--Pilih Dokter--</option>
                            <?php
								$dokter = $db->query("select * from tbl_dokter where status_delete='UD'");
								for ($i = 0; $i < count($dokter); $i++) {
									if ($dataUser[0]['code'] == $dokter[$i]['kode_dokter']) {
										echo '<option value="'.$dokter[$i]['kode_dokter'].'" selected>'.$dokter[$i]['kode_dokter'].' - '.$dokter[$i]['nama_dokter'].'</option>';
									}
									else {
										echo '<option value="'.$dokter[$i]['kode_dokter'].'">'.$dokter[$i]['kode_dokter'].' - '.$dokter[$i]['nama_dokter'].'</option>';
									}
								}
							?>
						</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">USER ID</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="userid" name="userid" class="form-control" Placeholder="User ID" value="<?php echo $dataUser[0]['userid']?>" required="required" />
                                            </div>
                                            <label for="textfield" class="control-label col-sm-2" style="text-align: right;">Berlaku Hingga</label>
                                            <div class="col-sm-3">
                                                <input type="date" id="berlaku" name="berlaku" class="form-control" value="<?php echo date("Y-m-d", strtotime($dataUser[0]['hingga']))?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">NIP/NIK & Telp</label>
                                            <div class="col-sm-4">
                                                <input type="text" id="nip" name="nip" class="form-control" Placeholder="NIP/NIK" required="required" value="<?php echo $dataUser[0]['nip']?>" />
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" id="telp" name="telp" class="form-control" Placeholder="Telp WA" required="required" value="<?php echo $dataUser[0]['telp']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Nama & Email</label>
                                            <div class="col-sm-5">
                                                <input type="text" id="nama" name="nama" class="form-control" required="required" Placeholder="Nama" value="<?php echo $dataUser[0]['nama']?>" />
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" id="email" name="email" class="form-control" required="required" Placeholder="Alamat Email" value="<?php echo $dataUser[0]['email']?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="textfield" class="control-label col-sm-2">Ganti Password</label>
                                            <div class="col-sm-10">
                                                <div class="password-strength flex flex-column-reverse gap-2xs js-password-strength">
                                                    <div>
                                                        <p class="sr-only">Password requirements:</p>
                                                        
                                                    </div>
                                                <div> 
                                                <label class="form-label margin-bottom-2xs" for="input-password">Ganti Password (kosongkan bila menggunakan Password yang lama)</label>
                                                <div class="password js-password">
                                                    <input class="password__input form-control width-100% js-password-strength__input js-password__input" type="password" name="input-password" id="input-password"> <button class="password__btn flex flex-center js-password__btn"><span class="password__btn-label" aria-label="Show password" title="Show password"><svg class="icon block" viewBox="0 0 32 32"><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none"><path d="M1.409,17.182a1.936,1.936,0,0,1-.008-2.37C3.422,12.162,8.886,6,16,6c7.02,0,12.536,6.158,14.585,8.81a1.937,1.937,0,0,1,0,2.38C28.536,19.842,23.02,26,16,26S3.453,19.828,1.409,17.182Z" stroke-miterlimit="10"></path><circle cx="16" cy="16" r="6" stroke-miterlimit="10"></circle></g></svg></span><span class="password__btn-label" aria-label="Hide password" title="Hide password"><svg class="icon block" viewBox="0 0 32 32"><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none"><path data-cap="butt" d="M8.373,23.627a27.659,27.659,0,0,1-6.958-6.445,1.938,1.938,0,0,1-.008-2.37C3.428,12.162,8.892,6,16.006,6a14.545,14.545,0,0,1,7.626,2.368" stroke-miterlimit="10" stroke-linecap="butt"></path><path d="M27,10.923a30.256,30.256,0,0,1,3.591,3.887,1.937,1.937,0,0,1,0,2.38C28.542,19.842,23.026,26,16.006,26A12.843,12.843,0,0,1,12,25.341" stroke-miterlimit="10"></path><path data-cap="butt" d="M11.764,20.243a6,6,0,0,1,8.482-8.489" stroke-miterlimit="10" stroke-linecap="butt"></path><path d="M21.923,15a6.005,6.005,0,0,1-5.917,7A6.061,6.061,0,0,1,15,21.916" stroke-miterlimit="10"></path><line x1="2" y1="30" x2="30" y2="2" fill="none" stroke-miterlimit="10"></line></g></svg></span></button></div><div class="margin-top-2xs js-password-strength__meter-wrapper"><div class="grid gap-2xs text-sm items-center"><div class="password-strength__meter col-6@xs bg-contrast-lower js-password-strength__meter" min="0" max="4" value="0" aria-hidden="true"><span class="block height-100%"></span></div><p class="col-6@xs text-right@xs color-contrast-medium" aria-live="polite" aria-atomic="true">Password strength: <span class="color-contrast-high js-password-strength__value"></span></p></div></div></div></div>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="hidden" name="id" value ="<?php echo md5($dataUser[0]['id'])?>">
                                            <input type="submit" name="simpan" id="simpan" class="btn btn-sm btn-small btn-primary rounded" value="Simpan Data User" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://codyhouse.co/app/assets/js/min/iframe-min.js?v=206"></script> 
<script src="https://codyhouse.co/codyhouse-framework/main/assets/js/util.js?v=204"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

<script src="https://codyhouse.co/app/components/source-v4/password-strength/dist/password-strength.min.js?v=10000000210"></script>

</div>
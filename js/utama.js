$(document).ready(function() {
	$("#tanggal").datepicker();
});

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
        //etc
        return 1;
    }
    return 2;
}

function simpan_data_pegawai_edit(t) {
	var foto = document.getElementById('foto').value;
	cek_foto = isImage(foto);
	
	if (cek_foto == 2 && foto != "") {
		alert("Silahkan gunakan foto yang akan diupload hanya dengan gambar");
		document.getElementById('simpan').value = 'Simpan Pegawai';
		document.getElementById('simpan').disabled = false;
	}
	else {
		document.getElementById('form_karyawan').action = 'pages/input/pegawai_update.php';
		t.submit();
	}
}

function hapus_data_pegawai_edit(t) {
	document.getElementById('form_karyawan').action = 'pages/input/pegawai_delete.php';
	t.submit();
}

function simpan_keluarga(t) {
	document.getElementById('form_karyawan').action = 'pages/input/pegawai_keluarga_insert.php';
	t.submit();
}

function simpanData(t, url) {
	document.getElementById('form_karyawan').action = url;
	t.submit();
}

function simpan_data_pegawai(t) {
	
	document.getElementById('simpan').value = 'Tunggu sebentar ...';
	document.getElementById('simpan').disabled = true;
	
	var nip = document.getElementById('nip').value;
	var nama = document.getElementById('nama').value;
	var gender = document.getElementById('gender').value;
	var tempat = document.getElementById('tempat_lahir').value;
	var ttl = document.getElementById('tgl_lahir').value;
	var agama = document.getElementById('agama').value;
	var alamat = document.getElementById('alamat').value;
	var email = document.getElementById('email').value;
	var foto = document.getElementById('foto').value;
	cek_foto = isImage(foto);
	
	if (nip == "" || nama == "" || gender == "" || email == "") {
		alert("Silahkan Isi dan lengkapi seluruh field yang telah kami sediakan");
		document.getElementById('simpan').value = 'Simpan Pegawai';
		document.getElementById('simpan').disabled = false;
	}
	else if (cek_foto == 2) {
		alert("Silahkan gunakan foto yang akan diupload hanya dengan gambar");
		document.getElementById('simpan').value = 'Simpan Pegawai';
		document.getElementById('simpan').disabled = false;
	}
	else {
		document.getElementById('form_karyawan').action = 'pages/input/pegawai_insert.php';
		t.submit();
	}
}

function login() {
	document.getElementById('pesanSuks').innerHTML = "";
	var username = document.getElementById('userid').value;
	var password = document.getElementById('password').value;
	var shiftUser = document.getElementById('shift').value;
	
	if (username == "" || password == "") {
		Notiflix.Notify.failure('Masukan Username / Password Anda');
	}
	if (shiftUser == "") {
		Notiflix.Notify.failure('Pilih Shift Waktu Anda Bekerja');
	}
	else {
	
		var url  = 'pages/logedin.php';
		var data = {username:username, password:password, shiftUser:shiftUser};
		Notiflix.Loading.dots();
		setTimeout(function () {
			Notiflix.Loading.remove();
			$('.sukses').load(url,data, function(){
				$('.sukses').slideDown(500);
			});
		}, 450);
	}
}

function cari_pegawai(nama) {
	var nama = document.getElementById("cari").value;
	var url = "pages/cari/index.php";
	var data = {id:nama};
	
	$('.loading').fadeIn();
	$('#isi-utama').fadeOut();
	$('#isi-utama').load(url,data, function(){
		$('.loading').fadeOut('fast');
		$('#isi-utama').fadeIn('fast');
	});
}

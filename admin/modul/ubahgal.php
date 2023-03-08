<?php

require_once('../config/koneksi.php');
require_once('../modul/database.php');

include '../modul/gallery.php';

$koneksi = new Database($host, $user, $pass, $dbase);
$galery = new Gallery($koneksi);


$idfoto = $_POST['idfoto'];
$namaFoto = $_POST['namafoto'];

$foto = $_FILES['filefoto']['name'];

$eKStensi = explode(".", $_FILES['filefoto']['name']);
$namabaru = $namaFoto . "." . end($eKStensi);
$sumberfoto = $_FILES['filefoto']['tmp_name'];

if ($foto == '') {
	$galery->ubahGallery("Update gallery set nama='$namaFoto' Where id='$idfoto'");
	echo "
		<script>
			window.location='?pages=gallery';
			
		</script>";
} else {
	$fotoAwal = $galery->tampilGallery($idfoto)->fetch_object()->gambar;
	unlink('../img/testi/' . $fotoAwal);
	$upload = move_uploaded_file($sumberfoto, '../img/testi/' . $namabaru);
	if ($upload) {
		$galery->ubahGallery("UPDATE `gallery` SET `nama`='$namaFoto', `gambar`='$namabaru' WHERE `id`='$idfoto'");
		echo "
		<script>
			window.location='?pages=gallery';
			
		</script>";
	} else {
		echo "
		<script>					
			
		</script>";
	}
}
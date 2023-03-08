<?php
require_once('../config/koneksi.php');
require_once('../modul/database.php');
include '../modul/kelas.php';

$koneksi = new Database($host, $user, $pass, $dbase);
$kelas = new Kelas($koneksi);

$idfoto = $_POST['idfoto'];
$namafoto = $_POST['namafoto'];
$deskripsi = $_POST['ubahdes'];
$foto = $_FILES['filefoto']['name'];

$eksteni = explode(".", $_FILES['filefoto']['name']);
$namabaru = $namafoto . "." . end($eksteni);
$sumberfile = $_FILES['filefoto']['tmp_name'];

if ($foto == "") {
    $kelas->ubahKelas("Update class set nama='$namafoto', deskripsi='$deskripsi' Where id='$idfoto'");
    echo "<script>window.location='?pages=kelas'</script>";
    //header('Location: ?pages=kelas');
} else {
    $fotoAwal = $kelas->tampilKelas($idfoto)->fetch_object()->foto;
    unlink('../img/cover/' . $fotoAwal);
    $upload = move_uploaded_file($sumberfile, '../img/cover/' . $namabaru);
    if ($upload) {
        $kelas->ubahKelas("UPDATE `class` SET `nama`='$namafoto', `deskripsi`='$deskripsi', `foto`='$namabaru' WHERE `id`='$idfoto'");
        echo   "<script>
                    window.location='?pages=kelas'
                    toastr.success
                </script>";
        //header('Location: ?pages=kelas');
    } else {
        echo "<script>alert('ubah gagal')</script>";
    }
}
?>
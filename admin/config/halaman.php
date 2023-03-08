<?php
error_reporting(0);

if ($_GET['pages'] =='dashboard') {
    include('pages/dashboard/index.php');
}elseif ($_GET['pages'] == 'kelas') {
    include('pages/kelas/index.php');
}elseif ($_GET['pages'] == 'gallery') {
    include('pages/gallery/index.php');
}
?>
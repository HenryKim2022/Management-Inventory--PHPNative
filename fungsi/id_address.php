<?php
require_once(__DIR__ . '/../fungsi/koneksi.php');

///// fungsi/id_address.php?alamat_dom=
$cekdb = mysqli_query($conn, "SELECT tb_pegawai.alamat_dom FROM tb_pegawai");
$data = mysqli_fetch_all($cekdb, MYSQLI_ASSOC);
echo json_encode($data);

/////
///// https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/indonesia-region.min.json
// $file = __DIR__ . '/../dist/assets/id/indonesian-wordlist.lst';
// $lines = file($file, FILE_SKIP_EMPTY_LINES);
// echo json_encode($lines);
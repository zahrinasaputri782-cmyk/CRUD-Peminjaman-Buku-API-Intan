<?php
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan_intan");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

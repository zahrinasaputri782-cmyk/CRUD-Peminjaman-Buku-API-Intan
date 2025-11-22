<?php
include "db.php";


$id = $_GET['id'];

// ambil id buku
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id=$id"));
$id_buku = $data['id_buku'];

// tambah stok buku
mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id=$id_buku");

// update status
mysqli_query($koneksi, "UPDATE peminjaman SET status='Dikembalikan' WHERE id=$id");

header("Location: index.php");

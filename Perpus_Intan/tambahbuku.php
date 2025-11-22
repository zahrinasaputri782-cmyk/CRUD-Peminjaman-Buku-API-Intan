<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Tambah Buku</h2>

    <form method="post">
        <input type="text" name="judul" placeholder="Judul" required>
        <input type="text" name="penulis" placeholder="Penulis" required>
        <input type="number" name="tahun" placeholder="Tahun" required>
        <input type="number" name="stok" placeholder="Stok" required>

        <button name="save">Simpan</button>
    </form>

    <?php
    if (isset($_POST['save'])) {
        mysqli_query($koneksi, "INSERT INTO buku VALUES(
            '',
            '$_POST[judul]',
            '$_POST[penulis]',
            '$_POST[tahun]',
            '$_POST[stok]'
        )");

        echo "<script>alert('Buku ditambah'); location='index.php';</script>";
    }
    ?>
</div>

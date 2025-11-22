<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Pinjam Buku</h2>

    <form method="post">
        <input type="text" name="nama" placeholder="Nama Peminjam" required>

        <select name="id_buku" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0");
            while ($b = mysqli_fetch_array($buku)) {
                echo "<option value='$b[id]'>$b[judul]</option>";
            }
            ?>
        </select>

        <button name="save">Simpan</button>
    </form>

    <?php
    if (isset($_POST['save'])) {

        // kurangi stok
        mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id=$_POST[id_buku]");

        mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(
            '',
            '$_POST[nama]',
            '$_POST[id_buku]',
            NOW(),
            'Dipinjam'
        )");

        echo "<script>alert('Peminjaman berhasil'); location='index.php';</script>";
    }
    ?>
</div>

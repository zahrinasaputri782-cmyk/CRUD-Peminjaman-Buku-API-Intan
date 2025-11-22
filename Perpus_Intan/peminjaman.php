<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Transaksi Peminjaman</h2>

    <a class="btn" href="tambahbuku.php">+ Pinjam Buku</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Peminjam</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $query = "
            SELECT peminjaman.*, buku.judul 
            FROM peminjaman 
            JOIN buku ON buku.id = peminjaman.id_buku
            ORDER BY peminjaman.id DESC
        ";

        $data = mysqli_query($koneksi, $query);
        while ($d = mysqli_fetch_array($data)) { ?>
            <tr>
                <td><?= $d['id'] ?></td>
                <td><?= $d['nama'] ?></td>
                <td><?= $d['judul'] ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td><?= $d['status'] ?></td>
                <td>
                    <?php if ($d['status'] == 'Dipinjam') { ?>
                        <a class="btn" href="kembalikan.php?id=<?= $d['id'] ?>">Kembalikan</a>

                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

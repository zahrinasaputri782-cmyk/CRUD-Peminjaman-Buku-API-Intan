<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <!-- DATA BUKU -->
    <div class="card">
        <h3>Data Buku</h3>

        <a class="btn" href="tambahbuku.php">+ Tambah Buku</a>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
                while ($d = mysqli_fetch_array($data)) { ?>
                    <tr>
                        <td><?= $d['id'] ?></td>
                        <td><?= $d['judul'] ?></td>
                        <td><?= $d['penulis'] ?></td>
                        <td><?= $d['tahun'] ?></td>
                        <td><?= $d['stok'] ?></td>
                        <td>
                            <a class="btn" href="editbuku.php?id=<?= $d['id'] ?>">Edit</a>
                            <a class="btn" href="hapusbuku.php?id=<?= $d['id'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- TRANSAKSI PEMINJAMAN -->
    <div class="card">
        <h3>Transaksi Peminjaman</h3>

        <a class="btn" href="tambahpeminjaman.php">+ Pinjam Buku</a>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "
                    SELECT peminjaman.*, buku.judul 
                    FROM peminjaman
                    JOIN buku ON buku.id = peminjaman.id_buku
                    ORDER BY peminjaman.id DESC
                ";
                $pinjam = mysqli_query($koneksi, $sql);

                while ($p = mysqli_fetch_assoc($pinjam)) { ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nama'] ?></td>
                        <td><?= $p['judul'] ?></td>
                        <td><?= $p['tanggal'] ?></td>
                        <td>
                            <?php if ($p['status'] == "Dipinjam") { ?>
                                <span class="status-pinjam">Dipinjam</span>
                            <?php } else { ?>
                                <span class="status-kembali">Dikembalikan</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($p['status'] == "Dipinjam") { ?>
                                <a class="btn btn-kembalikan" href="kembalikan.php?id=<?= $p['id'] ?>">
                                    Kembalikan
                                </a>
                            <?php } else { ?>
                                <span style="opacity: 0.6;">Selesai</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

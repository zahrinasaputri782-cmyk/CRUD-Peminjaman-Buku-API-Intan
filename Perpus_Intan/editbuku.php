<?php include "db.php"; ?>
<link rel="stylesheet" href="style.css">

<?php
$id  = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM buku WHERE id=$id"));
?>

<div class="container">
    <h2>Edit Buku</h2>

    <form method="post">
        <input type="text" name="judul" value="<?= $data['judul'] ?>" required>
        <input type="text" name="penulis" value="<?= $data['penulis'] ?>" required>
        <input type="number" name="tahun" value="<?= $data['tahun'] ?>" required>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

        <button name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        mysqli_query($koneksi, "UPDATE buku SET
            judul='$_POST[judul]',
            penulis='$_POST[penulis]',
            tahun='$_POST[tahun]',
            stok='$_POST[stok]'
        WHERE id=$id");

        echo "<script>alert('Buku diupdate'); location='index.php';</script>";
    }
    ?>
</div>

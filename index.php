<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once('navbar.php');
?>

<body>
    <h3>Input Produk</h3>
    <form action="function_transaksi.php" method="post">
        <label for="">Kode Produk</label>
        <input type="text" name="kd_produk">
        <br>
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk">
        <br>
        <label for="">stok</label>
        <input type="number" name="stok">
        <br>
        <label for="">Harga</label>
        <input type="number" name="harga">
        <br>
        <button type="submit" name="tambah_produk">Tambah Produk </button>
    </form>
    <hr>
    <h3>Data Produk</h3>
    <table border="2px">
        <thead>
            <th>kode produk</th>
            <th>Nama produk</th>
            <th>stok</th>
            <th>harga</th>
            <th>aksi</th>
        </thead>
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM produk");
        while ($data = mysqli_fetch_array($tampil)) {
            $id_produk = $data['id_produk'];
            $kd = $data['kd_produk'];
            $nama = $data['nama_produk'];
            $stok = $data['stok'];
            $harga = $data['harga'];
        ?>
            <tbody>

                <td><?= $kd ?></td>
                <td><?= $nama ?></td>
                <td><?= $stok ?></td>
                <td><?= $harga ?></td>
                <td>
                    <a href="function_transaksi.php?hps_produk=<?= $id_produk ?>">hapus</a>
                    <a href="edit_produk.php?edit=<?= $id_produk ?>">edit</a>
                </td>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>
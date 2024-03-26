<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('location:login.php');
};

if (isset($_GET['id_psn'])) {
    $id_psn = $_GET['id_psn'];
    $tampil_nama_plg = mysqli_query($conn, "SELECT * FROM penjualan pnj,pelanggan plg WHERE pnj.id_plg=plg.id_plg AND id_penjualan='$id_psn' ");
    if (mysqli_num_rows($tampil_nama_plg) > 0) {
        $np = mysqli_fetch_array($tampil_nama_plg);
        $nama_plg = $np['nama_plg'];
    } else {
        $nama_plg = "";
    };
} else {
    header('location:penjualan.php');
};
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
    <h3>Detail Transaksi</h3>
    <h4>Nama Customor: <?= $nama_plg ?></h4>
    <form action="function_transaksi.php" method="post">
        <label for="">pilih Produk</label>
        <select name="id_produk" id="">
            <?php
            $getpro = mysqli_query($conn, "SELECT * From produk WHERE id_produk NOT IN (SELECT id_produk FROM detail_penjualan WHERE id_penjualan='$id_psn')");
            while ($data = mysqli_fetch_array($getpro)) {
                $id_produk = $data['id_produk'];
                $nama_produk = $data['nama_produk'];
                $stok = $data['stok'];

            ?>
                <option value="<?= $id_produk; ?>">
                    <?= $nama_produk ?>- (stok: <?= $stok ?>)
                </option>
            <?php } ?>
        </select>
        <br>
        <label for="">jumlah</label>
        <input type="number" name="jumlah">
        <input type="hidden" name="id_psn" value="<?= $id_psn; ?>">
        <br>
        <button type="submit" name="tmbh_prdk_pesanan">Tambah </button>
    </form>
    <hr>
    <h3>Data Produk</h3>
    <table border="2px">
        <thead>
            <th>Nama produk</th>
            <th>id produk</th>
            <th>harga satuan</th>
            <th>jumlah</th>
            <th>subtotal</th>
            <th>aksi</th>
        </thead>
        <?php
        $id_psn = $_GET['id_psn'];
        $tampil = mysqli_query($conn, "SELECT * FROM detail_penjualan dp,produk pr WHERE dp.id_produk=pr.id_produk  AND id_penjualan='$id_psn' ");
        while ($data = mysqli_fetch_array($tampil)) {
            $id_detail = $data['id_detail'];
            $id_psn = $data['id_penjualan'];
            $id_produk = $data['id_produk'];
            $jumlah = $data['jumlah'];
            $harga = $data['harga'];
            $nama_produk = $data['nama_produk'];
            $subtotal = $jumlah * $harga;
            
            if (!isset($totalharga)) {
                $totalharga = 0;
            }
            $totalharga += $subtotal;

        ?>
            <tbody>

                <td><?= $nama_produk ?></td>
                <td><?= $id_produk ?></td>
                <td><?= $harga ?></td>
                <td><?= $jumlah ?></td>
                <td><?= $subtotal ?></td>
                <td>
                    <!-- <a href="function_transaksi.php?<?= $id_produk ?>">hapus</a> -->

                </td>
            </tbody>
        <?php } ?>
    </table>
    <hr>
    <form action="function_transaksi.php" method="post">
        <input type="hidden" name="id_psn" value="<?= $_GET['id_psn'] ?>">
        <label for="">total harga</label>
        <input type="number" name="totalharga" value="<?= $totalharga ?>">
        <br>
        <label for="">Bayar</label>
        <input type="number" name="bayar">
        <br>
        <button name="hitung_bayar">submit</button>
    </form>
</body>

</html>
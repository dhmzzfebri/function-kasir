<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

$id=$_GET['id'];
// $kd_penjualan = $_GET['kd_penjualan'];
$query = mysqli_query($conn, "SELECT * FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_plg = penjualan.id_plg WHERE id_penjualan = $id");
$data = mysqli_fetch_array($query);
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
    <h3>Detail Pesanan</h3>
    <hr>
    <h3>Nama Pelanggan: <?= $data['nama_plg']?></h3>
    <table border="2px">
        <thead>
            <th>Nama produk</th>
            <th>harga</th>
            <th>jumlah</th>
            <th>sub total</th>
            <th>aksi</th>
        </thead>
        <?php
         $tampil = mysqli_query($conn, "SELECT * FROM detail_penjualan JOIN produk JOIN penjualan ON produk.id_produk = detail_penjualan.id_produk AND penjualan.id_penjualan = detail_penjualan.id_penjualan  WHERE detail_penjualan.id_penjualan='$id'");
        while ($data_psn = mysqli_fetch_array($tampil)) {
            $nama= $data_psn['nama_produk'];
            $harga = $data_psn['harga'];
            $jumlah = $data_psn['jumlah'];
            $sub_total = $data_psn['sub_total'];
            $total = $data_psn['total_harga'];
        ?>
            <tbody>

                <td><?= $nama ?></td>
                <td><?= $harga ?></td>
                <td><?= $jumlah ?></td>
                <td><?= $sub_total ?></td>
                <td>
                    <a href="function_transaksi.php?hps_pesanan=<?= $id ?>">hapus</a>
                    <a href="detail_pesanan.php?id=<?= $id ?>">edit</a>
                </td>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>
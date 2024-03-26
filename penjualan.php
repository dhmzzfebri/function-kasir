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
    <h3>Transaksi</h3>
    <form action="function_transaksi.php" method="post">
        <label for="">pilih pelanggan</label>
        <br>
        <select name="id_plg" id="">
            <?php
            $getplg = mysqli_query($conn, "SELECT * From pelanggan");
            while ($data_plg = mysqli_fetch_array($getplg)) {
                $id_plg = $data_plg['id_plg'];
                $nama_plg = $data_plg['nama_plg'];
                $alamat = $data_plg['alamat'];

            ?>
                <option value="<?= $id_plg ?>"><?= $nama_plg ?>- <?= $alamat ?></option>
            <?php } ?>

        </select>
        <br>
        <br>
        <button type="submit" name="tambah_pesanan">Tambah Pesanan </button>
    </form>
    <hr>
    <h3>Data Pembelian</h3>
    <table border="2px">
        <thead>
            <th>kode produk</th>
            <th>Nama produk</th>
            <th>harga</th>
            <th>aksi</th>
        </thead>
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM penjualan LEFT JOIN pelanggan ON pelanggan.id_plg = penjualan.id_plg");
        while ($data = mysqli_fetch_array($tampil)) {
            $id = $data['id_penjualan'];
            $id_plg = $data['id_plg'];
            $tanggal = $data['tanggal'];
            $nama = $data['nama_plg'];
            $total = $data['total_harga'];
        ?>
            <tbody>

                <td><?= $tanggal ?></td>
                <td><?= $nama ?></td>
                <td><?= $total ?></td>
                <td>
                    <a style="color: red;" href="function_transaksi.php?hps_pesanan=<?= $id ?>">hapus</a>
                    <a style="color: green;" href="detail_pesanan.php?id=<?= $id ?>">detail</a>
                </td>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>
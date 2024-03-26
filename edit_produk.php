<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

$id_produk = $_GET['edit'];
$query ="SELECT * FROM produk WHERE id_produk='$id_produk' ";
$produk = mysqli_query($conn,$query);
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
    <?php foreach($produk as $data){?>
    <form action="function_transaksi.php" method="post">
        <input type="hidden"  name="id_produk" value="<?= $data['id_produk'] ?>">
        <label for="">Kode Produk</label>
        <input type="text" value="<?= $data['kd_produk'];?>" name="kd_produk">
        <br>
        <label for="">Nama Produk</label>
        <input type="text" value="<?=$data['nama_produk'];?>" name="nama_produk">
        <br>
        <label for="">stok</label>
        <input type="number" value="<?=$data['stok'];?>" name="stok">
        <br>
        <label for="">Harga</label>
        <input type="number" value="<?=$data['harga'];?>" name="harga">
        <br>
        <button type="submit" name="edit_produk">Edit Produk </button>
    </form>
    <?php }?>
    <hr>
</body>

</html>
<?php
session_start();
require_once('koneksi.php');
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}

$id_plg = $_GET['edit'];
$query = "SELECT * FROM pelanggan WHERE id_plg='$id_plg' ";
$plg = mysqli_query($conn, $query);
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
    <h3>Update Pelanggan</h3>
    <form action="function_user.php" method="post">
        <?php foreach ($plg as $data) { ?>
            <input type="hidden" value="<?= $data['id_plg'] ?>" name="id_plg">
            <label for="">nama pelanggan</label>
            <input type="text" value="<?= $data['nama_plg'] ?>" name="nama_plg">
            <br>
            <label for="">alamat</label>
            <input type="text" value="<?= $data['alamat'] ?>" name="alamat">
            <br>
            <label for="">no telp</label>
            <input type="number" value="<?= $data['no_tlp'] ?>" name="no_tlp">
            <br>
            <button type="submit" name="update_pelanggan">Update pelanggan </button>
        <?php } ?>
    </form>
</body>

</html>
<?php
session_start();
require_once('koneksi.php');
if(!isset($_SESSION['username'])){
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
    <h3>Input Pelanggan</h3>
    <form action="function_user.php" method="post">
        <label for="">nama pelanggan</label>
        <input type="text" name="nama_plg">
        <br>
        <label for="">alamat</label>
        <input type="text" name="alamat">
        <br>
        <label for="">no telp</label>
        <input type="number" name="no_tlp">
        <br>
        <button type="submit" name="tambah_pelanggan">Tambah pelanggan </button>
    </form>
    <hr>
    <h3>Data Pelanggan</h3>
    <table border="2px">
        <thead>
            <th>nama pelanggan</th>
            <th>alamat</th>
            <th>no telp</th>
            <th>aksi</th>
        </thead>
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM pelanggan");
        while ($data = mysqli_fetch_array($tampil)) {
            $id_plg= $data['id_plg'];
            $nama = $data['nama_plg'];
            $alamat = $data['alamat'];
            $no_tlp = $data['no_tlp'];
        ?>
            <tbody>

                <td><?= $nama ?></td>
                <td><?= $alamat ?></td>
                <td><?= $no_tlp ?></td>
                <td>
                    <a href="function_user.php?hps_plg=<?=$id_plg?>">hapus</a>
                    <a href="edit_pelanggan.php?edit=<?=$id_plg?>">edit</a>
                </td>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>
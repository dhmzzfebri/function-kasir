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
    <h3>Input User</h3>
    <form action="function_user.php" method="post">
        <label for="">nama</label>
        <input type="text" name="nama">
        <br>
        <label for="">Username</label>
        <input type="text" name="username">
        <br>
        <label for="">password</label>
        <input type="password" name="password">
        <br>
        <select name="level" id="">
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
        </select>
        <br>
        <button type="submit" name="tambah_user">Tambah Petugas </button>
    </form>
    <hr>
    <h3>Data User</h3>
    <table border="2px">
        <thead>
            <th>nama</th>
            <th>username</th>
            <th>level</th>
            <th>aksi</th>
        </thead>
        <?php
        $tampil = mysqli_query($conn, "SELECT * FROM user");
        while ($data = mysqli_fetch_array($tampil)) {
            $id = $data['id_user'];
            $nama = $data['nama'];
            $username = $data['username'];
            $level = $data['level'];
        ?>
            <tbody>

                <td><?= $nama ?></td>
                <td><?= $username ?></td>
                <td><?= $level ?></td>
                <td>
                    <a href="function_user.php?hps_user=<?=$id?>">hapus</a>
                </td>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>
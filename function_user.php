<?php
session_start();
require_once('koneksi.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $hasil = mysqli_query($conn, $query);
    if (mysqli_num_rows($hasil) == 1) {
        $data = mysqli_fetch_assoc($hasil);
        $_SESSION['username'] = $data['username'];
        $_SESSION['password'] = $data['password'];
        $_SESSION['level'] = $data['level'];
        header("location:index.php");
    } else {
        echo "<script>
                alert('login gagal')
            </script>";
        header("location:login.php");
    };
}

if (isset($_POST['tambah_user'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];
    $query = "INSERT INTO user (nama,username,password,level) VALUES ('$nama','$username','$password','$level')";
    $hasil = mysqli_query($conn, $query);
    header("location:registrasi.php");
}
if (isset($_GET['hps_user'])) {
    $id = $_GET['hps_user'];
    $query = "DELETE FROM user WHERE id_user='$id'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('berhasil menghapus petugas');
        window.location.href='registrasi.php';
        </script>";
    } else {
        echo " <script>
        alert('gagal menghapus');
        window.location.href='registrasi.php';
        </script>";
    };
}

if (isset($_POST['tambah_pelanggan'])) {
    $nama_plg = $_POST['nama_plg'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $query = "INSERT INTO pelanggan (nama_plg,alamat,no_tlp) VALUES('$nama_plg','$alamat','$no_tlp')";
    if (mysqli_query($conn, $query)) {
        echo "
        <script> 
            alert('berhasil menambahkan pelanggan baru');
            window.location.href='pelanggan.php'
        </script>";
    } else {
        echo "
        <script>
            alert('gagal menambah produk');
            window.location.href='pelanggan.php';
        </script>";
    }
}
if (isset($_POST['update_pelanggan'])) {
    $id_plg = $_POST['id_plg'];
    $nama_plg = $_POST['nama_plg'];
    $alamat = $_POST['alamat'];
    $no_tlp = $_POST['no_tlp'];
    $query = "UPDATE pelanggan SET nama_plg='$nama_plg',alamat='$alamat',no_tlp='$no_tlp' WHERE id_plg='$id_plg' ";
    if (mysqli_query($conn, $query)) {
        echo "
        <script> 
            alert('berhasil mengUPDATE pelanggan');
            window.location.href='pelanggan.php'
        </script>";
    } else {
        echo "
        <script>
            alert('gagal UPDATE pelanggan');
            window.location.href='pelanggan.php';
        </script>";
    }
}

if (isset($_GET['hps_plg'])) {
    $id_plg = $_GET['hps_plg'];
    $query = "DELETE FROM pelanggan WHERE id_plg='$id_plg'";
    if (mysqli_query($conn, $query)) {
        echo "<script>
        alert('berhasil menghapus pelanggan');
        window.location.href='pelanggan.php';
        </script>";
    } else {
        echo " <script>
        alert('gagal menghapus');
        window.location.href='pelanggan.php';
        </script>";
    };
}

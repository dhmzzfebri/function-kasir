<?php
require_once('koneksi.php');
if (isset($_POST['tambah_produk'])) {
    $kd = $_POST['kd_produk'];
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $query = "INSERT INTO produk (kd_produk,nama_produk,stok,harga) VALUES ('$kd','$nama_produk','$stok','$harga')";
    if (mysqli_query($conn, $query)) {
        echo "
        <script> 
            alert('berhasil menambah produk baru');
            window.location.href='index.php'
        </script>";
    } else {
        echo "
        <script>
            alert('gagal menambah produk');
        </script>";
    }
}
if (isset($_POST['edit_produk'])) {
    $idp = $_POST['id_produk'];
    $kd = $_POST['kd_produk'];
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $query = "UPDATE produk SET nama_produk = '$nama_produk',kd_produk = '$kd',stok = '$stok',harga = '$harga'
    WHERE id_produk = '$idp'";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil mengupdate produk');
        window.location.href='index.php';
        </script> ";
    } else {
        echo " <script>
        alert('gagal mengUPDATE produk');
        window.location.href='index.php';
        </script> ";
    };
}

if (isset($_GET['hps_produk'])) {
    $id_produk = $_GET['hps_produk'];
    $query = "DELETE FROM produk where id_produk='$id_produk' ";
    if (mysqli_query($conn, $query)) {
        echo "<script> 
        alert('berhasil menghapus produk');
        window.location.href= 'index.php' ;
        </script>";
    } else {
        echo "<script> alert('Produk gagal Dihapus'); </script>";
    }
}

if (isset($_POST['tambah_pesanan'])) {
    $id_plg = $_POST['id_plg'];
    $query = "INSERT INTO penjualan (id_plg) VALUES ('$id_plg') ";
    if (mysqli_query($conn, $query)) {
        $id_pesanan = mysqli_insert_id($conn);
        echo " <script>
            alert('berhasil menambahkan pesanan');
            window.location.href='detail_penjualan.php?id_psn=$id_pesanan';
        </script> ";
    } else {
        echo "gagal menambah pesanan";
    };
}
if (isset($_GET['hps_pesanan'])) {
    $id_pesanan = $_GET['hps_pesanan'];
    $query = "DELETE FROM penjualan WHERE id_penjualan='$id_pesanan' ";
    if (mysqli_query($conn, $query)) {
        echo " <script>
        alert('berhasil menghapus data penjualan');
        window.location.href='penjualan.php?id_psn=$id_pesanan';
    </script> ";
    } else {
        echo " <script>
        alert('Gagal menghapus');
        window.location.href='penjualan.php?id_psn=$id_pesanan';
    </script> ";
    }
}

if (isset($_POST['tmbh_prdk_pesanan'])) {
    $id_produk = $_POST['id_produk'];
    $id_psn = $_POST['id_psn'];
    $jumlah = $_POST['jumlah'];

    $query_hitung_stok = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'");
    $data_stok = mysqli_fetch_array($query_hitung_stok);
    $stok_sekarang = $data_stok['stok'];
    $harga = $data_stok['harga'];

    if ($stok_sekarang >= $jumlah) {
        $sisa_stok = $stok_sekarang - $jumlah;
        $subtotal = $jumlah * $harga;
        $query_insert_detail = "INSERT INTO detail_penjualan (id_penjualan,id_produk,jumlah,sub_total)  VALUES ('$id_psn','$id_produk','$jumlah',$subtotal)";
        $query_update_stok = "UPDATE produk SET stok='$sisa_stok' WHERE id_produk='$id_produk' ";
        $insert_result = mysqli_query($conn, $query_insert_detail);
        $update_result = mysqli_query($conn, $query_update_stok);
        if ($insert_result && $update_result) {
            echo " <script>
            alert('Barang pesanan BERHASIL di tambahkan');
            window.location.href='detail_penjualan.php?id_psn=$id_psn ';
            </script> ";
        } else {
            echo " <script>
            alert('Barang pesanan GAGAL di tambahkan');
            window.location.href='detail_penjualan.php?id_psn=$id_psn ';
            </script> ";
        };
    } else {
        echo " <script>
        alert('Stok produk tidak Memncukupi');
        window.location.href='detail_penjualan.php?id_psn=$id_psn ';
        </script> ";
    }
}

if (isset($_POST['hitung_bayar'])) {
    $id_psn = $_POST['id_psn'];
    $bayar = $_POST['bayar'];
    $query = mysqli_query($conn, "SELECT SUM(sub_total) AS total_subtotal FROM detail_penjualan WHERE id_penjualan='$id_psn'");
    $data = mysqli_fetch_assoc($query);
    $total_subtotal = $data['total_subtotal'];
    $kembalian = $bayar - $total_subtotal;
    if ($bayar < $total_subtotal) {
        echo "<script> alert('Uang Kurang! Tolong masukan uang yang pas'); </script>";
        echo "<script> window.location.href = 'detail_penjualan.php?id_psn=$id_psn'; </script>";
    } else {
        $query_update_stok = "UPDATE penjualan SET total_harga='$total_subtotal', bayar='$bayar' WHERE id_penjualan='$id_psn'";
        $update_result = mysqli_query($conn, $query_update_stok);
        echo "<script> alert('Pembayaran berhasil!'); </script>";
        echo "<script> window.location.href = 'nota.php?id_psn=$id_psn'; </script>";
    }
}

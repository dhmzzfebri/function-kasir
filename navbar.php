<div>
    <?php if (($_SESSION['level'] == "admin")) { ?>

        <a class="button" style="margin-right: 20px;" href="index.php">Home</a>
        <a class="button" style="margin-right: 20px;" href="penjualan.php">Transaksi</a>
        <a class="button" style="margin-right: 20px;" href="registrasi.php">Petugas</a>
    <?php } else { ?>
        <a class="button" style="margin-right: 20px;" href="index.php">Home</a>
        <a class="button" style="margin-right: 20px;" href="penjualan.php">Transaksi</a>
        <a class="button" style="margin-right: 20px;" href="pelanggan.php">Pelanggan</a>
    <?php } ?>
    <a class="button" style="margin-right: 20px;" href="logout.php">Logout</a>
</div>
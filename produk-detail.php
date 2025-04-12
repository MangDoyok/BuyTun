<?php
include 'koneksi.php';

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($koneksi, "select * from produk where nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($koneksi, "select * from produk where kategori_id='$produk[kategori_id]'and id!='$produk[id]' limit 4");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyTun | Details</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <!-- Detail Produk -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-2">
                    <img src="img/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $produk['nama']; ?></h1>
                    <p><?php echo $produk['detail']; ?></p>
                    <p class="fs-4 harga">
                        Rp<?php echo $produk['harga']; ?>
                    </p>
                    <p class="fs-5">
                        Stok : <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                    </p>
                    <p class="fs-5">
                        Nomor WA :
                        <strong>
                            <a href="https://wa.me/<?php echo $produk['nomor']; ?>?text=Halo,%20saya%20mau%20pesan%20<?php echo ($produk['nama']); ?>..." target="_blank">
                                <?php echo $produk['nomor']; ?>
                            </a>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terkait -->
    <div class="container-fluid py-5">
        <div class="container">
            <h2 class="text-center mb-5">Produk Terkait</h2>
            <div class="row">
                <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
                    <div class="col-md-6 col-lg-3 mb-3">
                        <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                            <img src="img/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-img" alt="">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>



    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
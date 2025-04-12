<?php
include 'koneksi.php';

$queryKategori = mysqli_query($koneksi, "select * from kategori");

// get produk by produk yang di cari
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($koneksi, "select * from produk where nama like '%$_GET[keyword]%'");
}

// get produk by kategori
else if (isset($_GET['kategori'])) {
    $queryGetKategoriId = mysqli_query($koneksi, "select id from kategori where nama = '$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);

    $queryProduk = mysqli_query($koneksi, "select * from produk where kategori_id = '$kategoriId[id]'");
}

// default
else {
    $queryProduk = mysqli_query($koneksi, "select * from produk");
}

$countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buytun | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <!-- Banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Produk</h1>
        </div>
    </div>

    <!-- Body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                            <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                        </a>
                    <?php } ?>

                </ul>
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Produk</h3>
                <div class="row">
                        <?php 
                            if ($countData < 1) {
                                ?>
                                <h4 class="text-center my-5">Nama produk tidak ada</h4>
                                <?php
                            }
                        ?>


                    <?php while($produk = mysqli_fetch_array($queryProduk)){ ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="img-box">
                                <img src="img/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo$produk['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo$produk['detail']; ?></p>
                                <p class="card-text harga">Rp<?php echo$produk['harga']; ?>,00</p>
                                <a href="produk-detail.php?nama=<?php echo$produk['nama']; ?>" class="text-white"><button type="button" class="btn btn-success warna4">Lihat Detail</button></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
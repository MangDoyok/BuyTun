<?php
include 'koneksi.php';
$queryProduk = mysqli_query($koneksi, "select id, nama, harga, foto, detail from produk limit 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuyTun</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "navbar.php" ?>

    <!-- Banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Toko Online nya</h1>
            <h3>Anak BUTUN</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Ayam Geprek" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna1 text-black">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>

                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="img-box">
                                <img src="img/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                                <p class="card-text harga">Rp<?php echo $data['harga']; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="text-white"><button type="button" class="btn btn-success warna4">Lihat Detail</button></a>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-success mt-3" href="produk.php">See More</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid warna3 py-3">
        <div class="container text-center">
            <h4>Tentang Kami</h4>
            <p class="mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi porro ullam recusandae possimus asperiores, qui omnis dolor molestiae inventore fugit. Mollitia porro tempore, officiis ipsam recusandae maiores laudantium vero nemo. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium nam sed quidem. Iste, doloremque neque dolorum, quaerat dolor magni repudiandae blanditiis rem dolores eum repellat veniam incidunt vel obcaecati reprehenderit. lorem</p>
        </div>
        <?php include 'footer.php'; ?>
    </div>

    
     

    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include '../koneksi.php';
include 'session.php';
$queryKategori = mysqli_query($koneksi, "select * from kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/index.php" class="no-decoration text-muted">
                        <i class="fas fa-home"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-10 col-md-5">
            <h3>Tambah Kategori</h3>
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="Masukan nama kategori" class="form-control">
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $cekInput = mysqli_query($koneksi, "select nama from kategori where nama='$kategori'");
                    $cekSama = mysqli_num_rows($cekInput);
                    
                    if($cekSama>0){
            ?>
                        <div class="alert alert-warning" role="alert">
                            Kategori sudah ada!
                        </div>
            <?php
                    }else {
                        $aksiTambah=mysqli_query($koneksi,"insert into kategori (nama) values ('$kategori')");
                        if ($aksiTambah) {
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil disimpan
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php"/>
            <?php
                        }else {
                            echo mysqli_error($koneksi);
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($jumlahKategori==0) {
                        ?>
                                <tr>
                                    <td colspan="3" class="text-center">Data Tidak Ada</td>
                                </tr>      
                        <?php
                            }else {
                                $no=1;
                                while ($data=mysqli_fetch_array($queryKategori)) {
                        ?>
                                    <tr>
                                        <td><?php echo$no;?></td>
                                        <td><?php echo$data['nama'];?></td>
                                        <td>
                                            <a href="edit-kategori.php?E=<?php echo$data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                $no++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>
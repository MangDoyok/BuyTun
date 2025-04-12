<?php
include '../koneksi.php';
include 'session.php';
$id = $_GET['E'];
$query = mysqli_query($koneksi, "select * from kategori where id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h2>Edit Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form control" value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                } else {
                    $query = mysqli_query($koneksi, "select * from kategori where nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori sudah ada!
                        </div>
                        <?php
                    } else {
                        $aksiTambah = mysqli_query($koneksi, "update kategori set nama='$kategori' where id='$id'");

                        if ($aksiTambah) {
                        ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil diedit
                            </div>
                            <meta http-equiv="refresh" content="1; url=kategori.php" />
            <?php
                        } else {
                            echo mysqli_error($koneksi);
                        }
                    }
                }
            }

            if(isset($_POST['hapus'])){
                $queryCheck = mysqli_query($koneksi, "select * from produk where kategori_id='$id'");
                $dataCount = mysqli_num_rows($queryCheck);
                
                if($dataCount >0){
                    ?>
                       <div class="alert alert-warning mt-3" role="alert">
                                Kategori tidak bisa dihapus karna ada isinya
                        </div> 
                    <?php
                    die();
                }

                $aksiHapus = mysqli_query($koneksi, "delete from kategori where id='$id'");
                if ($aksiHapus) {
                    ?>
                        <div class="alert alert-primary mt-3" role="alert">
                                Kategori berhasil dihapus
                        </div>
                        <meta http-equiv="refresh" content="0; url=kategori.php" />
                    <?php
                }else {
                    echo mysqli_error($koneksi);
                }
            }
            ?>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
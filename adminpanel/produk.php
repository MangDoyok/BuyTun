<?php
include '../koneksi.php';
include 'session.php';
$queryProduk = mysqli_query($koneksi, "select a.*, b.nama AS nama_kategori from produk a join kategori b on a.kategori_id=b.id");
$jumlahProduk = mysqli_num_rows($queryProduk);
$queryKategori = mysqli_query($koneksi, "select * from kategori");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

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
                Produk
            </li>
        </ol>
    </nav>


    <!-- tambah produk -->
    <div class="my-5 col-10 col-md-5">
        <h3>Tambah Produk</h3>

        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
            </div>
            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="">Pilih Satu</option>
                    <?php
                    while ($data = mysqli_fetch_array($queryKategori)) {
                    ?>
                        <option value="
                                <?php echo $data['id']; ?>">
                            <?php echo $data['nama']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <div>
                <label for="foto">Foto Produk</label>
                <input type="file" name="foto" id="foto" class="form-control" required>
            </div>
            <div>
                <label for="detail">Deskripsi</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>
            <div>
                <label for="nomor">Nomor WA yang Dapat Dihubungi</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" class="form-control" name="nomor" id="nomor" placeholder="Masukkan nomor tanpa 0 di awal" required>
                </div>
            </div>

            <div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
            $nomor = "+62" . htmlspecialchars($_POST['nomor']);

            $target_dir = "../img/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_type = $random_name . "." . $imageFileType;

            if ($nama == '' || $kategori == '' || $harga == '' || $nomor == '') {
        ?>
                <div class="alert alert-warning" role="alert">
                    Nama, kategori, harga, dan nomor wajib di isi!
                </div>
                <?php
            } else {
                if ($nama_file != '') {
                    if ($image_size > 10000000) {
                ?>
                        <div class="alert alert-warning" role="alert">
                            Ukuran foto tidak boleh lebih dari 10Mb!
                        </div>
                        <?php
                    } else {
                        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                        ?>
                            <div class="alert alert-warning" role="alert">
                                Foto harus bertipe PNG, JPG atau JPEG!
                            </div>
                    <?php
                        } else {
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_type);
                        }
                    }
                }

                $queryTambah = mysqli_query($koneksi, "insert into produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok, nomor) values ('$kategori','$nama','$harga','$new_type','$detail','$ketersediaan_stok','$nomor')");

                if ($queryTambah) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil disimpan
                    </div>
                    <meta http-equiv="refresh" content="1; url=produk.php" />
        <?php
                } else {
                    echo mysqli_error($koneksi);
                }
            }
        }

        ?>
    </div>

    <div class="mt-3 mb-5">
        <h2>List Produk</h2>

        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Ketersediaan Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahProduk == 0) {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">Data Tidak Ada</td>
                        </tr>
                        <?php
                    } else {
                        $no = 1;
                        while ($data = mysqli_fetch_array($queryProduk)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['harga']; ?></td>
                                <td><?php echo $data['ketersediaan_stok']; ?></td>
                                <td><a href="edit-produk.php?E=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a></td>
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
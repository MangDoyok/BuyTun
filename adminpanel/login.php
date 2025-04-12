<?php
session_start();
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<style>
    .main {
        height: 100vh;
    }

    .login {
        width: 300px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div class="mt-3 text-center" style="width: 300px;">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                // Cek apakah username ada di database
                $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
                $countdata = mysqli_num_rows($query);

                if ($countdata > 0) {
                    // Jika username ditemukan, periksa password
                    $data = mysqli_fetch_array($query);
                    if ($password == $data['password']) {
                        // Login berhasil
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: index.php');
                    } else {
                        // Username benar tapi password salah
                        echo '<div class="alert alert-danger" role="alert">
                                Password salah!
                              </div>';
                    }
                } else {
                    // Username tidak ditemukan (dan otomatis password salah)
                    echo '<div class="alert alert-danger" role="alert">
                            Akun tidak ditemukan!
                          </div>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
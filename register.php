<?php
@ob_start();
session_start();
require 'config.php';

if(isset($_POST['daftar'])) {
    $nm_member = strip_tags($_POST['nm_member']);
    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);
    $passHash = hash('sha256', $pass);

    // Nilai default untuk kolom lain
    $alamat_member = "";
    $telepon = "";
    $email = "";
    $gambar = "1714378963av2.png";
    $nik = "";

    // Menambahkan entri baru ke tabel member
    $sql_member = "INSERT INTO member (nm_member, alamat_member, telepon, email, gambar, nik) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_member = $config->prepare($sql_member);
    $stmt_member->execute([$nm_member, $alamat_member, $telepon, $email, $gambar, $nik]);
    $id_member = $config->lastInsertId();

    // Menambahkan entri ke tabel login
    $sql_login = "INSERT INTO login (id_member, user, pass) VALUES (?, ?, ?)";
    $stmt_login = $config->prepare($sql_login);
    $stmt_login->execute([$id_member, $user, $passHash]);

    if($stmt_login) {
        echo '<script>alert("Pendaftaran Berhasil"); window.location="login.php";</script>';
    } else {
        echo '<script>alert("Pendaftaran Gagal"); history.go(-1);</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Daftar Akun</h3>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="nm_member">Nama Lengkap:</label>
                                <input type="text" id="nm_member" name="nm_member" class="form-control" required placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="user">Username:</label>
                                <input type="text" id="user" name="user" class="form-control" required placeholder="Masukkan Username ID">
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" id="pass" name="pass" class="form-control" required placeholder="Masukkan Password">
                            </div>
                            <div class="row justify-content-center">
                            <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke JavaScript Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>


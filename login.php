<?php
@ob_start();
session_start();
require 'config.php';

if(isset($_POST['proses'])){
    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);
    $passHash = hash('sha256', $pass);

    $sql = 'SELECT member.*, login.user, login.pass
            FROM member INNER JOIN login ON member.id_member = login.id_member
            WHERE user = ? AND pass = ?';
    $row = $config->prepare($sql);
    $row->execute([$user, $passHash]);
    $jum = $row->rowCount();
    if($jum > 0){
        $hasil = $row->fetch();
        $_SESSION['admin'] = $hasil;
        echo '<script>alert("Login Sukses");window.location="index.php"</script>';
    } else {
        echo '<script>alert("Login Gagal");history.go(-1);</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login - SmartPoS</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="sb-admin/css/custom.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="wrapper"> <!-- Wrapper untuk mengatur layout -->
        <div class="content"> <!-- Konten utama -->
            <div class="container">
                <!-- Outer Row -->
                <div class="row justify-content-center">
                    <div class="col-md-5 mt-5">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="h4 text-gray-900 mb-4"><b>Login SmartPoS</b></h4>
                                    </div>
                                    <form class="form-login" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="user"
                                                placeholder="User ID" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="pass"
                                                placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-block" name="proses" type="submit"><i
                                                class="fa fa-lock"></i>
                                            MASUK</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forget_password.php">Lupa Password ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Buat Akun ?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'admin/template/footer.php'; ?>
        <!-- End of Footer -->
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>
</html>
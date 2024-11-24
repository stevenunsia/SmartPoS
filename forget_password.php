<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Lupa Password ?</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Masukkan email Anda untuk menerima instruksi reset password.</p>
                        <form action="validasi_email.php" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="Masukkan Email yang Terdaftar di Program">
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Link ke JavaScript Bootstrap -->
    <script src="path/to/bootstrap.bundle.min.js"></script>
</body>
</html>

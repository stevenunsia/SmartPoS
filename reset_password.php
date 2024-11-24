<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <form action="update_password.php" method="POST">
                            <input type="hidden" name="id_member" value="<?php echo htmlspecialchars($_GET['id_member']); ?>">
                            <div class="form-group">
                                <label for="password">Masukkan Password Baru:</label>
                                <input type="password" id="password" name="password" class="form-control placeholder="Masukkan Password Baru"" required>
                            </div>
                            <div class="row justify-content-center">
                            <button type="submit" name="reset" class="btn btn-primary">Reset Password</button>
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

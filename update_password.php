<?php
session_start();
require 'config.php';

if(isset($_POST['reset'])) {
    $id_member = $_POST['id_member'];
    $newPassword = hash('sha256', $_POST['password']); // Menggunakan SHA-256 untuk hashing password

    // Update password pengguna
    $sql = "UPDATE login SET pass = ? WHERE id_member = ?";
    $stmt = $config->prepare($sql);
    if($stmt->execute([$newPassword, $id_member])) {
        echo "<script>alert('Password Anda telah direset. Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Reset password gagal.'); window.location='forget_password.php';</script>";
    }
}
?>

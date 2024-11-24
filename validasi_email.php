<?php
session_start();
require 'config.php'; // Pastikan file ini menghubungkan ke database Anda dengan benar

if(isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Periksa apakah email ada di database
    $sql = "SELECT member.id_member, login.id_member FROM member JOIN login ON member.id_member = login.id_member WHERE member.email = ?";
    $stmt = $config->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user) {
        // Email ditemukan, arahkan ke halaman reset password
        header("Location: reset_password.php?id_member=" . urlencode($user['id_member']));
        exit();
    } else {
        // Email tidak ditemukan, kirim alert dan arahkan ke halaman login
        echo "<script>alert('Email tidak terdaftar.'); window.location='login.php';</script>";
    }
}
?>

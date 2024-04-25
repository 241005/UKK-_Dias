<?php

include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

// Periksa apakah email sudah terdaftar
$email_check_query = "SELECT * FROM user WHERE email = '$email'";
$hasil = mysqli_query($conn, $email_check_query);

if (mysqli_num_rows($hasil) > 0) {
    // Jika Email Sudah Ada Gabisa Dipakai Emailnya
    echo "<script> 
    alert('Email sudah terdaftar!');
    location.href='../register.php'; 
    </script>";
} else {
    // Proses Memasukan Data Ke Database
    $sql = "INSERT INTO user (`username`, `password`, `email`, `namalengkap`, `alamat`) VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script> 
        alert('Pendaftaran Berhasil');
        location.href='../login.php'; 
        </script>";
    } else {
        echo "<script> 
        alert('Gagal mendaftar. Silakan coba lagi.');
        location.href='../register.php'; 
        </script>";
    }
}

?>

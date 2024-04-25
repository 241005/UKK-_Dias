<?php
session_start();
include 'koneksi.php';

// Aksi Tambah Album //
if(isset($_POST['tambah'])){
    $namaalbum=$_POST['namaalbum'];
    $deskripsi=$_POST['deskripsi'];
    $tanggaldibuat=date("Y-m-d");
    $userid=$_SESSION['userid'];

    $sql=mysqli_query($conn,"insert into album values('','$namaalbum','$deskripsi','$tanggaldibuat','$userid')");

    echo "<script>
    alert('Data Berhasil Disimpan!');
    location.href='../admin/album.php';
    </script>";
}

// Aksi Edit Album //
if(isset($_POST['edit'])){
    $albumid=$_POST['albumid'];
    $namaalbum=$_POST['namaalbum'];
    $deskripsi=$_POST['deskripsi'];
    $tanggaldibuat=date("Y-m-d");
    $userid=$_SESSION['userid'];

    $sql=mysqli_query($conn,"update album set namaalbum='$namaalbum',deskripsi='$deskripsi',tanggaldibuat='$tanggaldibuat' where albumid='$albumid'");

    echo "<script>
    alert('Data Berhasil Diperbarui!');
    location.href='../admin/album.php';
    </script>";
}

// Aksi Hapus Album //
if(isset($_POST['hapus'])){
    $albumid=$_POST['albumid'];

    $sql=mysqli_query($conn,"delete from album where albumid='$albumid'");

    echo "<script>
    alert('Data Berhasil Dihapus!');
    location.href='../admin/album.php';
    </script>";
}

?>
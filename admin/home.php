<?php
session_start();
include "../config/koneksi.php";
$userid=$_SESSION['userid'];
if ($_SESSION['status'] != 'login'){
echo "<script>
alert('Anda Belum Login');
location.href='../index.php';
</script>";
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style> 
    body, html {
      height: 100%;
    }
    .bg {
      /* Photo yang digunakan */
      background-image: url('../wp/1341414.png');

      /* Tinggi */
      height: 100%;

      /* Posisi foto */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
  	.div a {
      text-align: center;
  	}

    </style>
</head>
<body>

<?php 
  $query = mysqli_query($conn, "SELECT * FROM user WHERE userid='$userid'");
    while ($data = mysqli_fetch_array($query)){
    ?>

<nav class="navbar bg-body-tertiary">
  <div class="container">
    <div class="mt-2 mb-2">
      <a class="navbar-brand" href="index.php">Gallery Foto</a>
      <a href="home.php" class="navbar-brand">Home</a>
      <a href="album.php" class="navbar-brand">Album</a>
      <a href="foto.php" class="navbar-brand">Foto</a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><strong><?php echo $data['namalengkap']?></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a href="index.php" class="btn btn-outline-secondary m-1">Gallery Foto</a>
          </li> 
          <li class="nav-item">
            <a href="album.php" class="btn btn-outline-primary m-1">Tambah Album</a>
          </li> 
          <li class="nav-item">
            <a href="foto.php" class="btn btn-outline-primary m-1">Tambah Foto</a>
          </li> 
          <li class="nav-item">
            <a href="../config/proses_logout.php" class="btn btn-outline-danger m-1">Logout</a>
          </li> 
        </ul>  
      </div>
    </div>
    </div>
  </div>
</nav>

<div class="container mt-3">
  <!-- Jenis Album -->
  <a href="home.php" class="btn btn-outline-secondary m-1"> Album : </a>
    <?php
    $album = mysqli_query($conn, "SELECT * FROM album WHERE userid='$userid'");
    while($row = mysqli_fetch_array($album)) { ?>
    <a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary"> <?php echo $row['namaalbum'] ?> </a>
    <?php } ?>
</div>

<div class="bg">
<div class="container mt-3">
    <div class="row">  
    <!-- Menampilkan Foto Dri Album yang dipilih dengan album id-->
    <?php 
    if(isset($_GET['albumid'])){
        $albumid = $_GET['albumid'];
        $query = mysqli_query($conn, "SELECT * FROM foto WHERE userid='$userid' AND albumid ='$albumid'");
        while($data = mysqli_fetch_array($query)){ ?>
        <div class="col-md-3 mt-2">
            <div class="card">
                <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
            </div>
        </div>

    <!-- Menampilkan Foto Dari album -->
    <?php } }else{

    $query = mysqli_query($conn, "SELECT * FROM foto WHERE userid = '$userid'");
    while ($data = mysqli_fetch_array($query)){
    ?>
    <div class="col-md-3 mt-2">
        <div class="card">
            <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
        </div>
    </div>
    <?php } } } ?> 
    </div>
</div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Gallery Foto</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
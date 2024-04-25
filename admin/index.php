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
            <a href="home.php" class="btn btn-outline-secondary m-1">Home</a>
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

<div class="bg">
<div class="container mt-3">
  <div class="row">
  <!-- Semua Foto dari album para User -->  
  <?php 
  $query = mysqli_query($conn, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
    while ($data = mysqli_fetch_array($query)){
    ?>
        <div class="col-md-3">
          <!-- Button trigger modal -->
          <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?> ">

            <div class="card mb-2">
                <!-- Tampilan Foto -->
                <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>" style="height: 12rem;">
                <!-- Icon Like & Komentar -->
                <div class="card-footer text-center">
                    <!-- Like Foto -->
                    <?php 
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($conn, "SELECT * FROM  likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                    if(mysqli_num_rows($ceksuka) == 1) { ?>
                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>

                    <?php }else{ ?>
                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>

                    <?php }
                    $like = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). ' Suka';
                    ?>
                    <!-- Komentar -->
                    <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?> "><i class="fa-regular fa-comment"></i></a>
                    <?php
                    $komen = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($komen). ' Komentar';
                    ?>
                </div>
            </div>
          </a>
          <!-- Modal Komentar -->
          <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" title="<?php echo $data['judulfoto']?>">
                    </div>
                    <div class="col-md-4">
                      <div class="m-2">
                        <div class="overflow-auto">
                          <div class="sticky-top">
                            <strong><?php echo $data['judulfoto'] ?></strong>
                            <span class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                            <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                            <span class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
                          </div>
                          <hr>
                          <p>Deskripsi</p>
                          <p align="left">
                            <strong><?php echo $data['namalengkap'].' '?></strong>
                            <?php echo $data['deskripsifoto'] ?>
                          </p>
                          <hr>
                          <div class="sticky-bottom">
                            <form action="../config/proses_komentar.php" method="post">
                              <div class="input-group">
                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar">
                                <div class="input-group-prepend">
                                  <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <hr>
                          <?php
                          $fotoid = $data['fotoid'];
                          $komentar = mysqli_query($conn, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'");
                          while($row = mysqli_fetch_array($komentar)){
                          ?>
                          <p align="left">
                            <strong><?php echo $row['namalengkap'] ?></strong>
                            <?php echo $row['isikomentar'] ?>
                          </p>
                          <?php } ?>
                          <hr>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } } ?>
  </div>
</div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Gallery Foto</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
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
    <?php 
    $query = mysqli_query($conn, "SELECT * FROM user WHERE userid='$userid'");
        while ($data = mysqli_fetch_array($query)){
    ?>
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
<?php } ?>

<div class="bg">
<div class="container">
<div class="row">
    <div class="col-md-4">
        <div class="card mt-2">
            <div class="card-header">Tambah Album</div>
            <div class="card-body">
                <form action="../config/proses_album.php" method="post">
                    <!-- Nama Album -->
                    <label class="form-label mt-1">Nama Album</label>
                    <input type="text" name="namaalbum" class="form-control mt-1" required>
                    <!-- Deskripsu Album -->
                    <label class="form-label mt-1">Deskripsi</label>
                    <textarea class="form-control mt-1" name="deskripsi" required></textarea>
                    <!-- Button -->
                    <button type="submit" class="btn btn-primary mt-3" name="tambah">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mt-2">
            <!-- Edit Album -->
            <div class="card-header">Data Album</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Album</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 1;
                        $sql=mysqli_query($conn,"SELECT * FROM album WHERE userid='$userid'");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                        <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['namaalbum']?></td>
                        <td><?php echo $data['deskripsi']?></td>
                        <td><?php echo $data['tanggaldibuat']?></td>
                        <td>

                            <!-- Aksi Edit -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>"> Edit </button>

                            <!-- Modal -->
                            <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../config/proses_album.php" method="post">
                                        <input type="hidden" name="albumid" value="<?php echo $data['albumid']?>">
                                        <!-- Nama Album -->
                                        <label class="form-label mt-1">Nama Album</label>
                                        <input type="text" name="namaalbum" value="<?php echo $data['namaalbum']?>" class="form-control mt-1" required>
                                        <!-- Deskripsu Album -->
                                        <label class="form-label mt-1">Deskripsi</label>
                                        <textarea class="form-control mt-1" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="edit" class="btn btn-primary mt-2">Edit Data</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>

                            <!-- Aksi Hapus -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>"> Hapus </button>

                            <!-- Modal -->
                            <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../config/proses_album.php" method="post">
                                        <input type="hidden" name="albumid" value="<?php echo $data['albumid']?>">
                                        Apakah Anda Yakin Ingin Menghapus Ini Data <strong> <?php echo $data['namaalbum'] ?></strong> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                            
                        </td>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
<p>&copy; UKK RPL 2024 | Gallery Foto</p>
</footer>

<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
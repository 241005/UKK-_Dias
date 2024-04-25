<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <title>Contoh Background Warna</title>
    <style> 
    body, html {
      height: 100%;
    }
    .bg {
      /* Photo yang digunakan */
      background-image: url('wp/pxfuel (3).jpg');

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

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gallery Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
      </div>
      <a href="login.php" class="btn btn-outline-success m-1">Login</a>
    </div>
  </div>
</nav>  
<div class="bg">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="margin: 150px 10px">
                <div class="card-body bg-light">
                    <div class="text-center">
                        <h5>Register Gess</h5>
                    </div>
                    <form action="config/proses_register.php" method="post">
                        <!-- Username -->
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <!-- Password -->
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <!-- Email -->
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                        <!-- Nama Lengkap -->
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namalengkap" class="form-control" required>
                        <!-- Alamat -->
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                        <!-- Button -->
                        <div class="d-grid mt-2">
                            <button class="btn btn-primary" type="submit" name="kirim">Kirim</button>
                        </div>
                    </form>
                    <hr>
                    <p>Belum punya akun kah? <a href="login.php">Login disini!</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Gallery Foto</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
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
    }.centered-card {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
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
      <a href="register.php" class="btn btn-outline-primary m-1">Register</a>
    </div>
  </div>
</nav>  

<div class="bg">
<center>
<h1>
  <p style="font-family: lemon; font-size: 200%;">Welcome</p>
</h1>
</center>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">        
            <div class="card" style="margin: 150px 10px">
                <div class="card-body bg-light">
                    <div class="text-center">
                        <h5>Login Gess</h5>
                    </div>
                    <form action="config/proses_login.php" method="post">
                          <!-- Username -->
                          <label class="form-label">Username</label>
                          <input type="text" name="username" class="form-control" required>
                          <!-- Password -->
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" required>
                          <!-- Button -->
                          <div class="d-grid mt-2">
                            <button class="btn btn-primary" type="submit" name="kirim">Masuk</button>
                        </div>
                    </form>
                    <hr>
                    <p>Belum punya akun kah? <a href="register.php">Regist disini!</a></p>
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
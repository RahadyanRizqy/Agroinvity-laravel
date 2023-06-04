<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="kopi.png" alt="">
        <div class="text">
          <span class="text-1">Selamat Datang di <br> AGROINVITY</span>
          <span class="text-2">Solusi Permasalahan Administrasi</span>
        </div>
      </div>
      <div class="back">
        <img src="kopi.png" alt="">
        <div class="text">
          <span class="text-1">Selamat Datang di <br> AGROINVITY</span>
          <span class="text-2">Solusi Permasalahan Administrasi</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Masuk</div>
          <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Masukkan Alamat Email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Masukkan Password" required>
              </div>
              <div class="text"><a href="#">Lupa password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Masuk">
              </div>
              <div class="text sign-up-text">Belum punya akun? <label for="flip">Daftar Sekarang</label></div>
            </div>
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Daftar</div>
        <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Masukkan nama lengkap" required>
              </div>
              <div class="input-box">
                <i class="fas fa-phone"></i>
                <input type="text" placeholder="Masukkan Nomor Hp" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Masukkan email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Masukkan password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Daftar">
              </div>
              <div class="text sign-up-text">Sudah Punya Akun? <label for="flip">Masuk Sekarang</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>

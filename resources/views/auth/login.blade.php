<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login ABC</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <div class="container">
    <header>
      <h1 class="logo">ABC</h1>
    </header>

    <div class="login-wrapper">
      <div class="image-section">
        <img src="{{ asset('images/gambar_login.png') }}" alt="Orang duduk di depan komputer">
      </div>

      <div class="form-section">
        <h2 class="title">MASUK</h2>
        <p class="subtitle">Untuk tetap terhubung dengan kami, silahkan masuk dengan akun anda</p>

        <form action="{{ url('/login') }}" method="POST" class="login-form">
  @csrf
  <input type="email" placeholder="Email" name="email" required>
  <div class="password-field">
    <input type="password" placeholder="Password" name="password" required>
    <span class="toggle-password">&#128065;</span>
  </div>
  <button type="submit">Masuk</button>
</form>

      </div>
    </div>
  </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PIMS - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <main class="login-container">
    <div class="login-card">
      <div class="card-body">
        <div class="brand-wrapper">
          <img src="{{ asset('images/logo4.png') }}" alt="PIMS Logo">
          <span class="pims-title">PIMS</span>
          <span class="pims-subtitle">PITAHC Integrated Management System</span>
        </div>
        <p class="login-card-description">Sign into your account</p>
        <form method="post" action="{{ url('/login') }}">
          @csrf
          <div class="mb-3">
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" onclick="showPassword('password')">
            <label class="form-check-label">Show Password</label>
          </div>
          <button type="submit" name="login" id="login" class="btn btn-block login-btn w-100">Login</button>
        </form>
        <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
        <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
        <nav class="login-card-footer-nav">
          <a href="#!">Terms of use.</a>
          <a href="#!">Privacy policy</a>
        </nav>
      </div>
    </div>
  </main>
  <script>
    function showPassword(id) {
      var x = document.getElementById(id);
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</body>
</html>

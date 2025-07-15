<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PIMS - Register</title>
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
        <p class="login-card-description">Create your account</p>
        <form method="post" action="{{ url('/register') }}" name="registration">
          @csrf
          <div class="mb-3">
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" value="{{ old('last_name') }}" placeholder="Last name" required autocomplete="family-name">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
              <strong>Full name is required.</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" value="{{ old('first_name') }}" placeholder="First name" required autocomplete="given-name">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
              <strong>Full name is required.</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" value="{{ old('middle_name') }}" placeholder="Middle name" autocomplete="additional-name">
          </div>
          <div class="mb-3">
            <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype password" required autocomplete="new-password">
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" onclick="showPassword()">
            <label class="form-check-label">Show Password</label>
          </div>
          <button type="submit" name="register" id="register" class="btn btn-block login-btn w-100">Register</button>
        </form>
        <p class="login-card-footer-text"><a href="{{ route('login') }}" class="text-reset">I already have an account</a></p>
      </div>
    </div>
  </main>
  <script>
    function showPassword() {
      var x = document.getElementById('password');
      var y = document.getElementById('password_confirmation');
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
  </script>
</body>
</html>

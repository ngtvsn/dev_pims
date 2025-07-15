<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PIMS - Reset Password</title>
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
        <p class="login-card-description">Set your new password</p>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            @php
                if (!isset($token)) {
                    $token = \Request::route('token');
                }
            @endphp

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-block login-btn w-100">Reset Password</button>
        </form>
        <p class="login-card-footer-text">Remember your password? <a href="{{ route('login') }}" class="text-reset">Login here</a></p>
        <nav class="login-card-footer-nav">
          <a href="#!">Terms of use.</a>
          <a href="#!">Privacy policy</a>
        </nav>
      </div>
    </div>
  </main>
</body>
</html>

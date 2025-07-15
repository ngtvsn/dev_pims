<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PIMS - Philippine Institute of Traditional and Alternative Health Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand">
        <img src="{{ asset('images/logo4.png') }}" alt="PIMS Logo">
        <span class="ms-2 fw-bold">PIMS</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://pitahc.gov.ph/contact-us/" target="_blank">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/login') }}">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero">
    <div class="container">
      <h1>Philippine Institute of Traditional and Alternative Health Care</h1>
      <p>Integrated Management Systems</p>
      <a href="{{ url('/login') }}" class="btn btn-primary">Access Your Account</a>
    </div>
  </header>

  <!-- Services Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title">Our Services</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card service-card">
            <div class="card-body text-center">
              <h5 class="card-title">Customer Satisfaction Survey</h5>
              <p class="card-text">Provide feedback to help us improve our services.</p>
              <a href="{{ route('css-form') }}" class="btn btn-outline-success">Go to Form</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card">
            <div class="card-body text-center">
              <h5 class="card-title">ICT Service Requests</h5>
              <p class="card-text">Submit and track requests for ICT-related support.</p>
              <a href="{{ url('/login') }}" class="btn btn-outline-success">Go to Requests</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card service-card">
            <div class="card-body text-center">
              <h5 class="card-title">Document Tracking</h5>
              <p class="card-text">Track the status and movement of your documents.</p>
              <a href="{{ url('/login') }}" class="btn btn-outline-success">Track Documents</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section class="py-5 about-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="section-title text-start" style="margin-bottom: 20px;">About PITAHC</h2>
          <p>The Philippine Institute of Traditional and Alternative Health Care (PITAHC) advocates for the development and use of traditional and alternative health-care in the country. Our goal is to improve the quality and delivery of health care services to Filipinos by integrating traditional and alternative health care into the national health care delivery system.</p>
          <a href="https://pitahc.gov.ph" target="_blank" class="btn btn-secondary">Learn More</a>
        </div>
<div class="col-md-6 text-center">
  <img src="{{ asset('images/logo4.png') }}" class="img-fluid rounded about-logo">
</div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="footer py-4">
    <div class="container text-center">
      <p>&copy; 2024 <strong><a href="https://pitahc.gov.ph">Philippine Institute of Traditional and Alternative Health Care</a></strong>. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

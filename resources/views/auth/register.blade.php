<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background-color: #ccc; /* Light gray background */
    }
    .navbar {
      height: 60px;
      background-color: #a06c24;
    }
    .reg-container {
      min-height: calc(100vh - 60px);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .reg-box {
      background-color: #e0e0e0;
      padding: 2rem;
      border-radius: 8px;
      width: 100%;
      max-width: 600px;
    }
    #step2 { display: none; }
    .btn-gold {
      background-color: #a06c24;
      border-color: #a06c24;
    }
    .btn-gold:hover {
      background-color: #8d5c1f;
      border-color: #8d5c1f;
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('images/recipenest-logo.png') }}" alt="RecipeNest Logo" style="height:40px;">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Home & Login Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
        </li>
      </ul>

    </div>
  </div>
</nav>

<!-- STEPS 1 & 2 Registration Form -->
<div class="reg-container">
  <div class="reg-box">
    <h3 class="mb-4 text-center">Registration</h3>
    <!-- Step 1 & 2 share the same form to gather data,
         then POST to a controller or route that processes
         these fields and redirects to /profile-setup. -->
    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- STEP 1 -->
      <div id="step1">
        <!-- Name fields -->
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label for="first_name" class="form-label fw-bold">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>
          <div class="col-md-6">
            <label for="surname" class="form-label fw-bold">Surname</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
          </div>
        </div>
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <!-- Password & Confirm -->
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="col-md-6">
            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>
        </div>
        <!-- Phone -->
        <div class="mb-4">
          <label for="phone" class="form-label fw-bold">Phone No.</label>
          <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <!-- Next Button -->
        <div class="text-end">
          <button type="button" class="btn btn-gold px-4 py-2" onclick="showStep2()">
            Next
          </button>
        </div>
      </div>

      <!-- STEP 2 -->
      <div id="step2">
        <!-- DOB -->
        <div class="mb-3">
          <label for="date_of_birth" class="form-label fw-bold">Date of Birth</label>
          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
        </div>
        <!-- Role -->
        <div class="mb-4">
          <label for="role" class="form-label fw-bold">Role</label>
          <select class="form-select" id="role" name="role" required>
            <option value="user" selected>User</option>
            <option value="chef">Chef</option>
          </select>
        </div>

        <!-- Final "Continue" Button -->
        <div class="text-end">
          <button type="submit" class="btn btn-gold px-4 py-2">
            Continue
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  function showStep2() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

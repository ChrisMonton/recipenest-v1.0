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
    /* Style for error messages */
    .error {
      color: red;
      font-size: 0.9rem;
      margin-top: 5px;
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
    <!-- The form gathers data and then POSTs to a route that processes registration -->
    <form method="POST" action="{{ route('register') }}" id="registrationForm">
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
            <div id="passwordError" class="error"></div>
          </div>
        </div>
        <!-- Phone with country code selection -->
        <div class="mb-4">
          <label for="phone" class="form-label fw-bold">Phone No.</label>
          <div class="input-group">
            <select name="phone_code" id="phone_code" class="form-select" required>
              <option value="+1">+1</option>
              <option value="+44">+44</option>
              <option value="+91">+91</option>
              <!-- Add more codes as needed -->
            </select>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
          </div>
          <div id="phoneError" class="error"></div>
        </div>
        <!-- Next Button -->
        <div class="text-end">
          <button type="button" class="btn btn-gold px-4 py-2" onclick="showStep2()">Next</button>
        </div>
      </div>

      <!-- STEP 2 -->
      <div id="step2">
        <!-- DOB -->
        <div class="mb-3">
          <label for="date_of_birth" class="form-label fw-bold">Date of Birth</label>
          <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
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
          <button type="submit" class="btn btn-gold px-4 py-2">Continue</button>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  // Function to validate step 1 and show step 2
  function showStep2() {
      // Clear any previous errors
      document.getElementById('passwordError').innerText = "";
      document.getElementById('phoneError').innerText = "";

      var firstName = document.getElementById('first_name').value.trim();
      var surname = document.getElementById('surname').value.trim();
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('password_confirmation').value;
      var phone = document.getElementById('phone').value.trim();
      var phoneCode = document.getElementById('phone_code').value.trim();

      if(!firstName || !surname || !email || !password || !confirmPassword || !phone || !phoneCode) {
          alert("All fields in step 1 are required.");
          return;
      }

      if(password !== confirmPassword) {
          document.getElementById('passwordError').innerText = "Passwords do not match.";
          return;
      }

      // If validation passes, move to step 2
      document.getElementById('step1').style.display = 'none';
      document.getElementById('step2').style.display = 'block';
  }

  // Add event listener so that pressing the Enter key in Step 1 triggers showStep2()
  document.getElementById('step1').addEventListener('keypress', function(e) {
      if (e.key === "Enter") {
          e.preventDefault();
          showStep2();
      }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

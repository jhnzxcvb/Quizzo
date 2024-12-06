<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizzo Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap');

    body {
      background-color: #172540;
      color: #ffffff;
      font-family: 'Arial', sans-serif;
      height: 80vh;
      margin: 0;
    }

    .container {
      max-width: 1200px;
      margin-top: 5rem;
    }

    .welcome-section {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      height: 100%;
    }

    .welcome-title {
      font-size: 5rem;
      font-weight: bold;
      margin-bottom: 0;
      font-family: 'Arial', sans-serif;
      color: #ffffff;
      letter-spacing: 2px;
    }

    .quizzo-title {
      font-size: 12rem;
      font-family: 'Caveat', cursive;
      color: #2EAEDC;
      margin-top: -10px;
      letter-spacing: 5px;
    }

    .form-section {
      background-color: #00A9E0;
      border-radius: 50px;
      height: 600px;
      padding: 60px;
      box-shadow: 10px 10px 15px rgba(0, 0, 0, 1);
    }

    .logo-container {
      transform: translateY(-20%);
      margin-left: 105px;
      margin-bottom: -60px;
      width: 150px;
      height: 150px;
      background-color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      object-fit: cover;
    }

    .form-control {
      border-radius: 5px;
      border: none;
      padding: 10px 20px;
    }

    a.btn-link {
      color: white;
    }

    a.btn-link:hover {
      color: black;
      text-decoration: underline;
    }

    .btn-primary {
      width: 100%;
      border-radius: 50px;
      background-color: #003366;
      border: none;
      padding: 10px;
    }

    .btn-primary:hover {
      background-color: #C24E27;
    }

    .form-check-label,
    a {
      color: #ffffff;
    }

    .password-toggle {
      cursor: pointer;
    }

    a:hover {
      color: black;
      text-decoration: underline;
    }

    .btn-back {
      border-radius: 30px;
      background-color: #003366;
      border: none;
      color: white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      font-size: 12px;
      font-weight: bold;
    }

    .btn-back i {
      margin-right: 5px;
    }

    .btn-back:hover {
      background-color: #C24E27; /* Darker shade for hover */
      cursor: pointer;
    }

    .btn-back:focus {
      outline: none;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <!-- Welcome Section -->
      <div class="col-md-6 welcome-section">
        <h1 class="welcome-title">WELCOME TO</h1>
        <h1 class="quizzo-title">QUIZZO!</h1>
      </div>

      <!-- Form Section -->
      <div class="col-md-5">
        <div class="form-section">
          <div class="logo-container">
            <img src="images/logo.jpg" alt="Logo">
          </div>
          <h2 class="text-center mt-5">LOGIN YOUR QUIZZO ACCOUNT</h2>
          <form action="login_process.php" method="POST">
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="bi bi-person"></i>
                </span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
              </div>
            </div>
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text">
                  <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                  <i id="password-icon" class="bi bi-eye-slash"></i>
                </span>
              </div>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="d-flex justify-content-between mt-3">
              <a href="#" class="btn btn-link p-0">Forgot Password?</a>
              <a href="reg.php" id="sign-up-button">Sign Up</a>
            </div>
            <!-- Customized Back Button -->
            <button type="button" class="btn-back mt-3" onclick="goBack()">
              <i class="bi bi-chevron-left"></i> Back
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword(fieldId) {
      var passwordField = document.getElementById(fieldId);
      var icon = document.getElementById('password-icon');

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      } else {
        passwordField.type = "password";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      }
    }

    function goBack() {
      window.location.href = 'index.php'; // Go to index.php
    }
  </script>
</body>

</html>

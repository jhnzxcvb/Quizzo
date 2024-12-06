<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizzo Signup</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Updated Bootstrap Icons CDN -->
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
      margin-top: 4rem;
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
      font-size: 50px;
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
      padding: 1px 60px;
      box-shadow: 10px 10px 15px rgba(0, 0, 0, 1);
      margin-right: 50px;
    }

    .form-control {
      border-radius: 20px;
      border: solid black 2px;
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
      background-color: #003366; /* Navy Blue */
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

    h2{
      font-size: 30px;
      padding-bottom: 5px;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <div class="col-md-6">
        <div class="form-section">
          <h2 class="text-center mt-5">CREATE YOUR QUIZZO ACCOUNT</h2>
          <form action="register.php" method="POST">
            <!-- First Name -->
            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" aria-label="First Name" required>
                </div>
              </div>
              <!-- Last Name -->
              <div class="col-md-6">
                <div class="mb-4">
                  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" aria-label="Last Name" required>
                </div>
              </div>
            </div>

            <!-- Institutional Email -->
            <div class="mb-4">
              <input type="email" class="form-control" id="insti_email" name="insti_email" placeholder="Institutional Email" aria-label="Institutional Email" required>
            </div>

            <!-- Username -->
            <div class="mb-4">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username (Student/Instructor ID)" aria-label="Username" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
              <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" aria-label="Password" required>
                <span class="input-group-text password-toggle" onclick="togglePassword('password')">
                  <i id="password-icon" class="bi bi-eye-slash"></i>
                </span>
              </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
              <div class="input-group">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" required>
                <span class="input-group-text password-toggle" onclick="togglePassword('confirmPassword')">
                  <i id="confirm-password-icon" class="bi bi-eye-slash"></i>
                </span>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100">Create Account</button>

            <!-- Login Redirect -->
            <p class="text-center mt-3">Already have an account? 
              <a href="login.php" id="login-button">Login</a>
            </p>
          </form>
        </div>
      </div>

      <!-- Welcome Section (Right Side) -->
      <div class="col-md-6 welcome-section">
        <h1 class="welcome-title">REGISTER TO JOIN THE WORLD OF</h1>
        <h1 class="quizzo-title">QUIZZO!</h1>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function togglePassword(fieldId) {
      var passwordField = document.getElementById(fieldId);
      var icon = document.getElementById(fieldId === 'password' ? 'password-icon' : 'confirm-password-icon');
      
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
  </script>
</body>
</html>

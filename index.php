<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizzo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    body {
      background: linear-gradient(to bottom, #172540 60%, #00A9E0 40%);
      font-family: 'Poppins', sans-serif;
      color: white;
    }

    h1 {
      font-size: 10rem;
      font-weight: bold;
      text-transform: uppercase;
      text-align: center;
    }

    .tagline {
      text-align: center;
      font-size: 1.5rem;
      color: white;
      margin-top: 0px;
      letter-spacing: 1px;
    }

    .button-group {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
      gap: 1.5rem;
    }

    .button-group button {
      padding: 0.75rem 2rem;
      border-radius: 50px;
      border: none;
      font-size: 1.2rem;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      position: relative;
    }

    .button-group .btn-primary {
      background-color: black;
      width: 150px;
      color: white;
    }

    .button-group .btn-primary:hover {
      background-color: white;
      color: black;
    }

    .button-group .btn-secondary {
      background-color: transparent;
      width: 150px;
      height: 50px;
      border: solid black 2px;
      color: white;
    }

    .button-group .btn-secondary:hover {
      background-color: white;
      color: black;
    }

    .button-group button a {
      text-decoration: none;
      color: inherit;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: inherit;
      font-weight: inherit;
    }

    .content {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="content">
    <h1>QUIZZO!</h1>
    <p class="tagline">Challenge What You Know!</p>
    <div class="button-group">
      <button type="button" class="btn btn-primary">
        <a href="login.php">Login</a>
      </button>
      <button type="button" class="btn btn-secondary">
        <a href="reg.php">Sign Up</a>
      </button>
    </div>
  </div>
</body>
</html>

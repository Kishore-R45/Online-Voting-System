<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PHP Voting System - Login</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #f0f0f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 50px 20px;
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      color: #00d9ff;
      margin-bottom: 20px;
      font-size: 2.5rem;
    }

    .form-card {
      background-color: rgba(255, 255, 255, 0.05);
      padding: 40px;
      border-radius: 15px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      transition: transform 0.3s ease;
    }

    .form-card:hover {
      transform: translateY(-5px);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #ffffff;
      font-size: 1.8rem;
    }

    input, select {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border-radius: 10px;
      border: none;
      background-color: #1e293b;
      color: #ffffff;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    input:focus, select:focus {
      outline: none;
      background-color: #334155;
      box-shadow: 0 0 0 2px #00d9ff;
    }

    .login-btn {
      width: 100%;
      padding: 12px;
      background-color: #00d9ff;
      border: none;
      border-radius: 10px;
      color: white;
      font-weight: bold;
      font-size: 1rem;
      margin-top: 20px;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .login-btn:hover {
      background-color: #00b2d6;
    }

    p {
      text-align: center;
      margin-top: 15px;
    }

    a {
      color: #00d9ff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>
  <h1>Voting System</h1>
  <div class="form-card">
    <h2>Login</h2>
    <form action="./actions/login.php" method="POST">
      <input type="text" name="username" placeholder="Enter your username" required />
      <input type="text" name="mobile" placeholder="Enter your mobile number" required maxlength="10" minlength="10" />
      <input type="password" name="password" placeholder="Enter your password" required />
      <select name="std" required>
        <option value="Group">Group</option>
        <option value="Voter">Voter</option>
      </select>
      <button type="submit" class="login-btn">Login</button>
      <p>Don't have an account? <a href="./Partials/registration.php">Register here</a></p>
    </form>
  </div>
<?php include 'Partials/footer.php'; ?>
</body>

</html>

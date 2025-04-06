<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting system - Registration Page</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(to right, #141e30, #243b55);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f0f0f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
        }

        h1 {
            color: #00c6ff;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
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
            color: #ffffff;
            margin-bottom: 30px;
            text-align: center;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border-radius: 10px;
            border: none;
            background-color: #1f2937;
            color: #ffffff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            background-color: #374151;
            box-shadow: 0 0 0 2px #00c6ff;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #00c6ff;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #009ee3;
        }

        p {
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #00c6ff;
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
        <h2>Register Account</h2>
        <form action="../actions/register.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Enter your username" required>
            <input type="text" name="mobile" placeholder="Enter your mobile number" required>
            <input type="password" name="password" placeholder="Enter your password" required>
            <input type="password" name="cpassword" placeholder="Confirm Password" required>
            <input type="file" name="photo">
            <select name="std" required>
                <option value="Group">Group</option>
                <option value="Voter">Voter</option>
            </select>
            <button type="submit" name="Registerme" class="submit-btn">Register</button>
            <p>Already have an account? <a href="../">Login here</a></p>
        </form>
    </div>
    
</body>
<?php include 'footer.php'; ?>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="../backend/assets/images/Icon.png">
    <title>SI-KOPMA UPNVY</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #1abc9c, #16a085, #27ae60, #2ecc71);
            background-size: 400% 400%;
            animation: gradientBackground 10s ease infinite;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 300px;
            box-shadow: 15px 15px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 50px;
            color: #fff;
        }
        .input-group {
            position: relative;
            margin: 30px 0;
        }
        .input-group input {
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .input-group input:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
        }
        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .input-group input:focus + label,
        .input-group input:valid + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #000;
        }
        .input-group .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }
        button{
            background: #059212;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
            padding: 10px;
            margin: 30px 0px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }
        button[name='user']{
            margin-top: 5px;
            margin-bottom: 15px;
        }
        button[name='admin']{
            margin-bottom: 5px;
        }
        button:hover {
            background: rgba(255, 255, 255, 0.5);
            color: #059212;
        }
        @media (max-width: 600px) {
            .login-container {
                padding: 15px;
            }
            .input-group input {
                padding: 10px 8px;
                font-size: 14px;
            }
            .input-group label {
                left: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Selamat Datang</h2>
        <form action="../config/login.php" method="post">
            <div class="input-group">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePassword()"><i class="bi bi-eye"
                id="toggleIcon"></i></span>
            </div>
            <button type="submit" name="admin">Login Admin</button>
            <button type="submit" name="user">Login User</button>
        </form>
    </div>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>

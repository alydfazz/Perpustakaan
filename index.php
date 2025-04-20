<?php
session_start();

if (isset($_COOKIE['user']) && isset($_COOKIE['pass'])) {
    $_SESSION['user'] = $_COOKIE['user'];
    $_SESSION['pass'] = $_COOKIE['pass'];
    header("Location: utama.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container label {
            margin-bottom: 5px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="ceklogin.php" method="POST">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" required>
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required>
            <label for="remember">
                <input type="checkbox" id="remember" name="remember" value="1"> Remember Me
            </label>
            <input type="submit" value="Login">
        </form>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
</body>
</html>


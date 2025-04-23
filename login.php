<?php
session_start();
require 'database_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = ""; 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($connection, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);

        if ($user['password'] === $password) {
            if (trim(strtolower($user['status'])) === 'inactive') {
                $message = "Your account is deactivated.";
            } else {
                $_SESSION['user'] = $user;

                if ($user['role'] === 'admin') {
                    header("Location: dashboard_admin.php");
                    exit;
                } else {
                    header("Location: dashboard_user.php");
                    exit;
                }
            }
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Invalid email or password.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="container">
    <h2>Login</h2>
    
    <?php if (!empty($message)) : ?>
        <p style="color: red; text-align: center;"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        Don't have an account? <a href="register.php">Register here</a>
    </p>
</div>

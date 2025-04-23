<?php
require_once 'database_connection.php';
session_start();

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role'];
    $status   = $_POST['status'];

    $query = "INSERT INTO users (name, email, password, role, status) 
              VALUES ('$name', '$email', '$password', '$role', '$status')";

    if ($connection->query($query)) {
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'status' => $status
        ];
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="container">
  <h2>Register</h2>
  <form method="POST" action="register.php">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="status" required>
      <option value="active">Active</option>
      <option value="inactive">Inactive</option>
    </select>
    <select name="role" required>
      <option value="user">User</option>
      <option value="editor">Editor</option>
    </select>
    <button type="submit" name="register">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login here</a></p>
</div>


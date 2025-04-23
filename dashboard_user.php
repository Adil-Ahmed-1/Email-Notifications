<?php
require_once 'require/auth.php';
if ($_SESSION['user']['role'] !== 'user') header("Location: login.php");

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f9fc;
      margin: 0;
      padding: 0;
    }

    .dashboard-header {
      background-color: #1e1e1e;
      color: #f8b400;
      font-size: 36px;
      font-weight: bold;
      padding: 20px;
      margin-top: 20px;
      text-align: center;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .logout-btn {
      float: right;
      background-color: #007bff;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      border-radius: 6px;
      margin: 15px;
      font-weight: bold;
    }

    .logout-btn span {
      font-weight: normal;
      margin-left: 5px;
    }

    .welcome-message {
      font-size: 22px;
      margin: 30px 50px 0;
      font-weight: bold;
    }

    .user-heading {
      text-align:center;
      background-color:#00cfff;
      font-size: 24px;
      font-weight: bold;
      padding: 15px;
      margin-top: 20px;
      border-radius: 10px;
      width: 300px;
      margin-left: auto;
      margin-right: auto;
    }

    .container {
      width: 90%;
      margin: 30px auto;
    }

    table {
      margin: 30px auto;
      border-collapse: collapse;
      width: 100%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      background-color: white;
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background-color: #e0e0e0;
    }

    td {
      font-weight: bold;
    }

    .status-active {
      color: green;
    }

    .status-inactive {
      color: red;
    }
  </style>
</head>
<body>

<a href="login.php" class="logout-btn">Logout</a>

<div class="dashboard-header">User Dashboard</div>

<h2 class="welcome-message">Welcome, <?= htmlspecialchars($user['name']) ?>.</h2>

<div class="user-heading">Your Info</div>

<div class="container">
  <table id="userTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= htmlspecialchars($user['name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= htmlspecialchars($user['password']) ?></td>
        <td><?= ucfirst(htmlspecialchars($user['role'])) ?></td>
        <td class="<?= $user['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
          <?= ucfirst(htmlspecialchars($user['status'])) ?>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>

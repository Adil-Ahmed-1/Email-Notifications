<?php
require_once("require/auth.php");
if ($_SESSION['user']['role'] !== 'admin') header("Location: login.php");

require 'database_connection.php';
$result = $connection->query("SELECT * FROM users");

$adminName = $_SESSION['user']['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fefefe;
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
      background-color:#007bff;
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
    table {
      margin: 30px auto;
      border-collapse: collapse;
      width: 90%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    .status-active {
      color: green;
      font-weight: bold;
    }
    .status-inactive {
      color: red;
      font-weight: bold;
    }
    .btn-action {
      padding: 6px 14px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn-activate {
      background-color: green;
      color: white;
    }
    .btn-inactivate {
      background-color: crimson;
      color: white;
    }
  </style>
</head>
<body>

<a href="login.php" class="logout-btn">Logout </a>

<div class="dashboard-header">Admin Dashboard</div>

<h2 class="welcome-message">Welcome, <?= htmlspecialchars($adminName) ?>.</h2>

<div class="user-heading">All Users.</div>

<table>
<tr>
  <th>ID</th>
  <th>Full Name</th>
  <th>Email</th>
  <th>Password</th>
  <th>Role</th>
  <th>Status</th>
  <th>Action</th>
</tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($row['id']) ?></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['email']) ?></td>
  <td><?= htmlspecialchars($row['password']) ?></td>
  <td><strong><?= htmlspecialchars(ucfirst($row['role'])) ?></strong></td>
  <td id="status-<?= $row['id'] ?>" class="<?= $row['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
    <?= htmlspecialchars(ucfirst($row['status'])) ?>
  </td>
  <td>
    <button 
      class="btn-action <?= $row['status'] === 'active' ? 'btn-inactivate' : 'btn-activate' ?>"
      onclick="toggleStatus(<?= $row['id'] ?>, '<?= $row['status'] ?>')">
      <?= $row['status'] === 'active' ? 'InActive' : 'Active' ?>
    </button>
  </td>
</tr>
<?php endwhile; ?>
</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleStatus(userId, currentStatus) {
    var action = currentStatus === 'active' ? 'deactivate' : 'activate';

    var ajax_request = new XMLHttpRequest();
    ajax_request.onreadystatechange = function () {
        if (ajax_request.readyState == 4 && ajax_request.status == 200) {
            // plain text response
            var responseText = ajax_request.responseText;

            var statusCell = document.getElementById("status-" + userId);
            var isActivating = action === "activate";

            statusCell.innerText = isActivating ? "active" : "inactive";
            statusCell.className = isActivating ? "status-active" : "status-inactive";

            var btn = statusCell.nextElementSibling.querySelector("button");
            btn.innerText = isActivating ? "Inactivate" : "Activate";
            btn.className = "btn-action " + (isActivating ? "btn-inactivate" : "btn-activate");
            btn.setAttribute("onclick", "toggleStatus(" + userId + ", '" + (isActivating ? "active" : "inactive") + "')");

            // SweetAlert success notification
            Swal.fire({
                icon: 'success',
                title: 'Status Updated',
                text: responseText,
                confirmButtonColor: '#3085d6'
            });
        }
    };
    ajax_request.open("POST", "ajax_process.php", true);
    ajax_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax_request.send("action=" + action + "&id=" + userId);
}
</script>

</body>
</html>

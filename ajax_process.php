<?php
require_once("database_connection.php");
require_once("require/mail.php");

if (isset($_POST['id']) && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];
    $new_status = ($action === 'activate') ? 'active' : 'inactive';

    $connection->query("UPDATE users SET status='$new_status' WHERE id=$id");

    $result = $connection->query("SELECT email FROM users WHERE id=$id");
    $user = $result->fetch_assoc();

    $capitalStatus = strtoupper(substr($new_status, 0, 1)) . substr($new_status, 1);
    $subject = "Account " . $capitalStatus;
    $message = "Your account has been $new_status by admin.";

    sendMail($user['email'], $subject, $message);

    echo "User ID $id is now $new_status and email notification sent.";
} else {
    echo "Invalid request.";
}
?>

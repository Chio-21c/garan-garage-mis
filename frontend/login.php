<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli("localhost", "root", "", "garan_garage");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'Admin') {
                header("Location: dashboard_admin.php");
            } elseif ($user['role'] == 'Staff') {
                header("Location: dashboard_staff.php");
            } else {
                header("Location: dashboard.php"); // fallback
            }
            exit();
        } else {
            echo "<p>Invalid password</p>";
        }
    } else {
        echo "<p>User not found</p>";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
</body>
</html>

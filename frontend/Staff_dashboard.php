<?php
session_start();
if ($_SESSION['role'] != 'Staff') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Staff Dashboard</title></head>
<body>
<h1>Staff Dashboard</h1>
<nav>
    <a href="assign_job.php">Assign Job</a> |
    <a href="view_jobs.php">View Jobs</a> |
    <a href="view_vehicles.php">View Vehicles</a> |
    <a href="logout.php">Logout</a>
</nav>
</body>
</html>

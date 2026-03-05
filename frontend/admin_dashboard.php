<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
<h1>Admin Dashboard</h1>
<nav>
    <a href="add_staff.php">Add Staff</a> |
    <a href="add_vehicle.php">Register Vehicle</a> |
    <a href="assign_job.php">Assign Job</a> |
    <a href="view_jobs.php">View Jobs</a> |
    <a href="view_vehicles.php">View Vehicles</a> |
    <a href="logout.php">Logout</a>
</nav>
</body>
</html>

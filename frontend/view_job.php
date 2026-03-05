<?php
session_start();
if ($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'Staff') {
    echo "<p>Access denied. Only Admin and Staff can view jobs.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Job Cards</title></head>
<body>
<h2>Job Cards</h2>
<?php
$json = file_get_contents("http://localhost:5000/jobs");
$jobs = json_decode($json, true);

echo "<table border='1'>
        <tr><th>ID</th><th>Vehicle</th><th>Staff</th><th>Description</th><th>Date</th><th>Status</th></tr>";
foreach ($jobs as $j) {
    echo "<tr>
            <td>{$j['id']}</td>
            <td>{$j['license_plate']}</td>
            <td>{$j['staff']}</td>
            <td>{$j['job_description']}</td>
            <td>{$j['job_date']}</td>
            <td>{$j['status']}</td>
          </tr>";
}
echo "</table>";
?>
</body>
</html>

<?php
session_start();
if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Staff') {
    // allowed
} else {
    echo "<p>Access denied. Only Admin and Staff can assign jobs.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Assign Job</title></head>
<body>
<h2>Assign Job</h2>
<form method="POST">
    Vehicle ID: <input type="number" name="vehicle_id" required><br>
    Staff ID: <input type="number" name="staff_id" required><br>
    Job Description: <textarea name="job_description" required></textarea><br>
    Job Date: <input type="date" name="job_date" required><br>
    <button type="submit">Assign</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        "vehicle_id" => $_POST['vehicle_id'],
        "staff_id" => $_POST['staff_id'],
        "job_description" => $_POST['job_description'],
        "job_date" => $_POST['job_date']
    ];
    $ch = curl_init("http://localhost:5000/jobs");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    echo "<p>Job assigned successfully!</p>";
}
?>
</body>
</html>

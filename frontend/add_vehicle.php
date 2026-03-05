<?php
session_start();
if ($_SESSION['role'] != 'Admin') {
    echo "<p>Access denied. Only Admin can register vehicles.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Vehicle</title></head>
<body>
<h2>Register Vehicle</h2>
<form method="POST">
    Owner Name: <input type="text" name="owner_name" required><br>
    Phone: <input type="text" name="phone"><br>
    Email: <input type="email" name="email"><br>
    Address: <input type="text" name="address"><br>
    Vehicle Model: <input type="text" name="vehicle_model" required><br>
    License Plate: <input type="text" name="license_plate" required><br>
    Service Date: <input type="date" name="service_date" required><br>
    <button type="submit">Save</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add owner
    $owner = [
        "name" => $_POST['owner_name'],
        "phone" => $_POST['phone'],
        "email" => $_POST['email'],
        "address" => $_POST['address']
    ];
    $ch = curl_init("http://localhost:5000/owners");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($owner));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $ownerData = json_decode($response, true);
    $owner_id = $ownerData['id'];

    // Add vehicle
    $vehicle = [
        "owner_id" => $owner_id,
        "vehicle_model" => $_POST['vehicle_model'],
        "license_plate" => $_POST['license_plate'],
        "service_date" => $_POST['service_date']
    ];
    $ch = curl_init("http://localhost:5000/vehicles");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($vehicle));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    echo "<p>Vehicle registered successfully!</p>";
}
?>
</body>
</html>

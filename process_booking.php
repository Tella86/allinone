<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = 'Elon2508/*-';
$dbname = 'repair_services';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_type = $_POST['service_type'];
    $location = $_POST['location'];
    
    $sql = "INSERT INTO bookings (service_type, location, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $status = 'pending';
    $stmt->bind_param("sss", $service_type, $location, $status);

    if ($stmt->execute()) {
        echo "<p>Service booked successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>
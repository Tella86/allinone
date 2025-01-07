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
    $comments = $_POST['comments'];
    $status = 'pending';

    $sql = "INSERT INTO bookings (service_type, location, comments, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $service_type, $location, $comments, $status);

    if ($stmt->execute()) {
        echo "<p>Service booked successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>

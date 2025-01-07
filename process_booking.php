<?php
// Database connection
$conn = new mysqli("localhost", "root", "Elon2508/*-", "repair_services");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $location = $conn->real_escape_string($_POST['location']);
    $service_id = $conn->real_escape_string($_POST['service_id']);
    $status = "Pending"; // Default booking status

    // Insert booking into the database
    $sql = "INSERT INTO bookings (name, phone, location, service_id, status) VALUES ('$name', '$phone', '$location', '$service_id', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking successful! Our technician will contact you shortly.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='index.php';</script>";
    }
}

$conn->close();
?>
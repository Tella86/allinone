<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "repair_services");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if technician is logged in
if (!isset($_SESSION['technician_id'])) {
    header("Location: login.php");
    exit;
}

$technician_id = $_SESSION['technician_id'];

// Validate action and task_id parameters
if (isset($_GET['action']) && isset($_GET['task_id'])) {
    $action = $_GET['action'];
    $task_id = intval($_GET['task_id']);

    // Fetch the task to ensure it exists and is assigned to the technician
    $sql = "SELECT * FROM bookings WHERE id = ? AND status IN ('Pending', 'In Progress')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();

        // Update task status based on action
        if ($action === 'start' && $task['status'] === 'Pending') {
            $new_status = 'In Progress';
        } elseif ($action === 'complete' && $task['status'] === 'In Progress') {
            $new_status = 'Completed';
        } else {
            echo "<script>alert('Invalid action or task status.'); window.location.href='technician_portal.php';</script>";
            exit;
        }

        // Update the task status in the database
        $update_sql = "UPDATE bookings SET status = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_status, $task_id);

        if ($update_stmt->execute()) {
            echo "<script>alert('Task status updated successfully!'); window.location.href='technician_portal.php';</script>";
        } else {
            echo "<script>alert('Error updating task status. Please try again.'); window.location.href='technician_portal.php';</script>";
        }
    } else {
        echo "<script>alert('Task not found or already processed.'); window.location.href='technician_portal.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='technician_portal.php';</script>";
}

$conn->close();
?>
<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "Elon2508/*-", "repair_services");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if technician is logged in
if (!isset($_SESSION['technician_id'])) {
    header("Location: login.php");
    exit;
}

$technician_id = $_SESSION['technician_id'];

// Fetch technician details
$sql = "SELECT * FROM users WHERE id = ? AND role = 'technician'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $technician_id);
$stmt->execute();
$result = $stmt->get_result();
$technician = $result->fetch_assoc();

// Fetch assigned tasks
$sql = "SELECT b.id AS booking_id, b.name AS client_name, b.phone AS client_phone, b.location, s.service_name, b.status 
        FROM bookings b 
        JOIN services s ON b.service_id = s.id 
        WHERE b.status IN ('Pending', 'In Progress') 
        ORDER BY b.created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Technician Portal</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($technician['name']); ?>!</h1>

        <h2>Assigned Tasks</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['client_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['client_phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] === 'Pending') { ?>
                            <a href="update_task.php?action=start&task_id=<?php echo $row['booking_id']; ?>" class="btn btn-primary btn-sm">Start Task</a>
                        <?php } elseif ($row['status'] === 'In Progress') { ?>
                            <a href="update_task.php?action=complete&task_id=<?php echo $row['booking_id']; ?>" class="btn btn-success btn-sm">Mark as Complete</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

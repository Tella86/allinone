<?php
$service = $_GET['service'] ?? '';
$serviceDetails = [
    'electrical_repair' => [
        'title' => 'Electrical Repair',
        'description' => 'Professional electrical repair services to resolve all issues efficiently.',
    ],
    'plumbing_repair' => [
        'title' => 'Plumbing Repair',
        'description' => 'Expert plumbing services to fix leaks and ensure smooth water flow.',
    ],
    'cleaning' => [
        'title' => 'Cleaning Services',
        'description' => 'Comprehensive cleaning for houses, offices, and clothes.',
    ],
];

if ($service && !array_key_exists($service, $serviceDetails)) {
    die('Invalid service selected.');
}

$details = $service ? $serviceDetails[$service] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 90%;
            max-width: 500px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Available Services</h2>
        <div class="row">
            <?php foreach ($serviceDetails as $key => $service): ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $service['title']; ?></h5>
                            <p class="card-text"><?php echo $service['description']; ?></p>
                            <button class="btn btn-primary" onclick="openModal('<?php echo $service['title']; ?>')">Book This Service</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2 id="modalServiceTitle"></h2>
            <form id="bookingForm" method="POST" action="process_booking.php">
                <div class="form-group">
                    <label for="serviceType">Service Type:</label>
                    <input type="text" class="form-control" id="serviceType" name="service_type" readonly>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
                </div>
                <div class="form-group">
                    <label for="comments">Additional Comments:</label>
                    <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Book Now</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(serviceTitle) {
            document.getElementById('modalServiceTitle').innerText = serviceTitle;
            document.getElementById('serviceType').value = serviceTitle;
            document.getElementById('bookingModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('bookingModal').style.display = 'none';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

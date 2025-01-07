<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-in-One Repair Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .hero {
            background: url('hero-image.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .features {
            margin: 50px 0;
        }
    </style>
    <script>
        // JavaScript for Geolocation API
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById('location').value = position.coords.latitude + ", " + position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Repair Services</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#technicians">Technicians</a></li>
                    <li class="nav-item"><a class="nav-link" href="#admin">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to All-in-One Repair Services</h1>
        <p>Your one-stop solution for all repair and maintenance needs.</p>
        <a href="#services" class="btn btn-primary">Explore Services</a>
    </div>

    <!-- Features Section -->
    <div class="container features">
        <div class="row text-center">
            <div class="col-md-4">
                <h3>Client Dashboard</h3>
                <p>Book and manage services with ease.</p>
            </div>
            <div class="col-md-4">
                <h3>Technician Portal</h3>
                <p>Manage tasks and track earnings.</p>
            </div>
            <div class="col-md-4">
                <h3>Admin Dashboard</h3>
                <p>Monitor and manage platform activity.</p>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="container my-5">
        <h2 class="text-center">Our Services</h2>
        <div class="row">
            <?php
            $conn = new mysqli("localhost", "root", "Elon2508/*-", "repair_services");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM services";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["service_name"] . '</h5>';
                    echo '<p class="card-text">' . $row["description"] . '</p>';
                    echo '<button class="btn btn-primary book-now-btn" data-bs-toggle="modal" data-bs-target="#bookingModal" data-service-id="' . $row["id"] . '">Book Now</button>';
                    echo '</div></div></div>';
                }
            } else {
                echo '<p class="text-center">No services available at the moment.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="process_booking.php" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" readonly required>
                            <button type="button" class="btn btn-secondary mt-2" onclick="getLocation()">Get Location</button>
                        </div>
                        <input type="hidden" id="service_id" name="service_id" value="">
                        <button type="submit" class="btn btn-primary">Book Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 All-in-One Repair Services. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set the service ID dynamically when "Book Now" is clicked
        document.addEventListener('DOMContentLoaded', function () {
            const bookingModal = document.getElementById('bookingModal');
            const serviceIdInput = bookingModal.querySelector('#service_id');

            document.querySelectorAll('.book-now-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const serviceId = this.getAttribute('data-service-id');
                    serviceIdInput.value = serviceId;
                });
            });
        });
    </script>
</body>
</html>

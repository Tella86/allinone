<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Repair Services</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Book a Service</h2>
        <p>Choose a service and provide your location to book a technician.</p>
        <form id="bookingForm" method="POST" action="process_booking.php">
            <div class="form-group">
                <label for="serviceType">Service Type:</label>
                <select class="form-control" id="serviceType" name="service_type" required>
                    <option value="">-- Select Service --</option>
                    <option value="electrical_repair">Electrical Repair</option>
                    <option value="electrical_installation">Electrical Installation</option>
                    <option value="plumbing_repair">Plumbing Repair</option>
                    <option value="cleaning">Cleaning</option>
                    <option value="gardening">Gardening</option>
                    <option value="baby_care">Baby Care</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location manually or use GPS" required>
                <button type="button" class="btn btn-secondary mt-2" onclick="getLocation()">Use My Location</button>
            </div>
            <div class="form-group">
                <label for="comments">Additional Comments:</label>
                <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Provide any additional details..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Book Now</button>
        </form>
    </div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        document.getElementById('location').value = `Lat: ${position.coords.latitude}, Lng: ${position.coords.longitude}`;
                    },
                    (error) => {
                        alert('Unable to fetch your location. Please enter manually.');
                    }
                );
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        }
    </script>
</body>
</html>

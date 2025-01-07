<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Book a Service</h2>
        <form id="bookingForm" method="POST" action="process_booking.php">
            <div class="form-group">
                <label for="serviceType">Service Type:</label>
                <select class="form-control" id="serviceType" name="service_type">
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
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="getLocation()">Use My Location</button>
            <button type="submit" class="btn btn-success mt-3">Book Now</button>
        </form>
    </div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    document.getElementById('location').value = `Lat: ${position.coords.latitude}, Lng: ${position.coords.longitude}`;
                }, (error) => {
                    alert('Error retrieving geolocation.');
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        }
    </script>
</body>
</html>
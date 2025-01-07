<?php
$conn = new mysqli($host, $user, $password, $dbname);
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$result = $conn->query($sql);
?>
<div class="container mt-5">
    <h2>Service Dashboard</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Service Type</th>
                <th>Location</th>
                <th>Comments</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['service_type'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['comments'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No bookings available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

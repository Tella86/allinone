<?php
$service = $_GET['service'];
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

if (!array_key_exists($service, $serviceDetails)) {
    die('Invalid service selected.');
}

$details = $serviceDetails[$service];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $details['title']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><?php echo $details['title']; ?></h2>
        <p><?php echo $details['description']; ?></p>
        <a href="index.php?service=<?php echo $service; ?>" class="btn btn-primary">Book This Service</a>
    </div>
</body>
</html>
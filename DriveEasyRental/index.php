<?php
require_once 'connection.php';
$conn = getDatabaseConnection();

$sql = "SELECT * FROM cars ORDER BY id DESC LIMIT 3";
$result = $conn->query($sql);
$cars = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="logo">DriveEasyRentals</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="rental.php">Rental</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="slider">
            <img src="images/tesla_model_s.jpg" alt="Luxury Car">
            <img src="images/chevrolet_camaro.jpg" alt="SUV">
            <img src="images/nissan_altima.jpg" alt="Convertible">
        </div>
    </section>

    <section class="popular-cars">
        <h2>Most Popular Rentals</h2>
        <div class="card-container">
            <?php foreach ($cars as $car): ?>
            <div class="card">
                <img src="images/<?php echo $car['carImage']; ?>" alt="<?php echo htmlspecialchars($car['type']); ?>">
                <h3><?php echo htmlspecialchars($car['type']); ?></h3>
                <p>Starting at $<?php echo htmlspecialchars($car['price_per_day']); ?>/day</p>
                <button class="book-now"><a href="booking.php?id=<?php echo $row['id']; ?>">Book Now</a></button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
    </footer>

    <script src="js/scripts.js"></script>
</body>
</html>

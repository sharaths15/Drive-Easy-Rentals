<?php
require_once 'connection.php';
$conn = getDatabaseConnection();

// Fetch car data from database
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Cars</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">DriveEasyRentals</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="rental.php">Rental</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <img src="images/chevrolet_camaro.jpg" alt="Hero Image">
        <div class="hero-text">Find Your Perfect Ride</div>
    </section>

    <!-- Rental Cars Section -->
    <section class="rental-cars">
        <h2>Our Rental Fleet</h2>
        <div class="cards-container">
            <?php
            // Check if any cars are available
            if ($result->num_rows > 0) {
                // Output data of each car
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <img src="images/<?php echo $row['carImage']; ?>" alt="<?php echo $row['model']; ?>">
                        <h3><?php echo $row['model']; ?></h3>
                        <p class="price">$<?php echo number_format($row['price_per_day'], 2); ?>/day</p>
                        <p><?php echo $row['type']; ?></p>
                        
                        <button class="book-now"><a href="booking.php?id=<?php echo $row['id']; ?>">Book Now</a></button>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No cars available.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
    </footer>
</body>
</html>

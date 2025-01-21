<?php
session_start();
require_once 'connection.php';
$conn = getDatabaseConnection();
// Check if the form is submitted

$name = $_SESSION['user_name'];
$userid = $_SESSION['user_id'];
$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the form data
    $carid = mysqli_real_escape_string($conn, $_POST['carid']);
    $pickup = mysqli_real_escape_string($conn, $_POST['pickup-date']);
    $dropoff = mysqli_real_escape_string($conn, $_POST['dropoff-date']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Prepare SQL query to insert booking details into the database
    $sql = "INSERT INTO `rentals`(`user_id`, `car_id`, `pickup_date`, `dropoff_date`, `total_price`, `rentalStatus`) VALUES ('$userid','$carid','$pickup','$dropoff','$price','Pending');";

    if ($conn->query($sql) === TRUE) {
        // Booking successful
        echo "<script>alert('Your booking has been confirmed!'); window.location.href='rental.php';</script>";
    } else {
        // Error during insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Booking</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <!-- Header Section -->
        <header>
            <div class="logo">DriveEasyRentals</div>
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="rental.html">Rental</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <img src="images/nissan_altima.jpg" alt="Booking Page Hero Image">
            <div class="hero-text">Book Your Car</div>
        </section>

        <!-- Booking Section -->
        <section class="booking">
            <div class="container">
                <h2>Car Booking Form</h2>
                <p>Fill out the form below to book your car rental.</p>
                <form action="#" method="POST">
                    <input type="hidden" value="<?php echo $id; ?>" name="carid"/>
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full-name" value="<?php echo $name; ?>" placeholder="Your Full Name" disabled="">
                    </div>

                    <div class="form-group">
                        <?php
                        
                        $quer = "select * from cars where id='$id'";
                        if ($conn->query($quer) === TRUE) {
                            $type = $row['type'];
                            ?>
                            <label for="phone">Car Type</label>
                            <input type="text" id="phone" name="type" value="<?php echo $type; ?>" disabled="">
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="pickup-date">Pick-Up Date</label>
                        <input type="date" id="pickup-date" name="pickup-date" required>
                    </div>
                    <div class="form-group">
                        <label for="dropoff-date">Drop-Off Date</label>
                        <input type="date" id="dropoff-date" name="dropoff-date" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Total Price</label>
                        <input type="text" id="phone" name="price" placeholder="Your Total Price" >
                    </div>
                    <button type="submit" class="submit-btn">Confirm Booking</button>
                </form>
            </div>
        </section>
        <?php
// Close the connection
        $conn->close();
        ?>

        <!-- Footer Section -->
        <footer>
            <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
        </footer>
    </body>
</html>

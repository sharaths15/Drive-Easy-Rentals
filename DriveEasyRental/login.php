<?php
session_start();

// Database connection
require_once 'connection.php';

$conn = getDatabaseConnection();
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' and password= '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        // Redirect based on role
        if ($row['role'] == 'Admin') {
            header("Location: admin_index.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "No user found with this email and password.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Login to DriveEasyRentals to manage your car rentals and bookings easily.">
        <meta name="keywords" content="car rentals, car booking, DriveEasyRentals login">
        <meta name="author" content="DriveEasyRentals">
        <title>Login - DriveEasyRentals</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <div class="logo">DriveEasyRentals</div>
        </header>

        <section class="booking">
            <div class="container">
                <h2>Login</h2>
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" required>
                    </div>
                    <button type="submit" class="submit-btn">Login</button>
                </form>
                <p>Doesn't have an account? <a href="register.php" style="color: black;">Register here</a></p>
            </div>
        </section>

        <footer>
            <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
        </footer>
    </body>
</html>

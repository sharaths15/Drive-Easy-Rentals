<?php
require_once 'connection.php';
$conn = getDatabaseConnection();

$sql = "SELECT * FROM cars";
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
                    <li><a href="admin_index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="popular-cars">
            <h2>Most Popular Rentals</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Car Type</th>
                        <th>Model</th>
                        <th>Price per Day</th>
                        <th>Availability</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td>
                                <img src="images/<?php echo htmlspecialchars($car['carImage']); ?>" 
                                     alt="<?php echo htmlspecialchars($car['type']); ?>" 
                                     width="100">
                            </td>
                            <td><?php echo htmlspecialchars($car['type']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td>$<?php echo htmlspecialchars($car['price_per_day']); ?>/day</td>
                            <td><?php echo htmlspecialchars($car['availability']); ?></td>
                            <td><button class="book-now"><a href="update.php?id=<?php echo $car['id'];?>">Update</a></button></td>
                            <td><button class="book-now"><a href="delete.php?id=<?php echo $car['id'];?>">Delete</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <footer>
            <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
        </footer>

        <script src="js/scripts.js"></script>
    </body>
</html>

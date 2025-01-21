<?php
require_once 'connection.php';
$conn = getDatabaseConnection();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cid = intval($_POST['id']); // Ensure ID is an integer
    $type = htmlspecialchars($_POST['type']);
    $model = htmlspecialchars($_POST['model']);
    $price_per_day = floatval($_POST['price_per_day']);
    $availability = htmlspecialchars($_POST['availability']);

    // SQL to update car details
    $sql = "UPDATE cars SET type='$type', model='$model', price_per_day='$price_per_day', availability='$availability' WHERE id='$cid'";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        echo "<script>alert('Car updated successfully!'); window.location.href='admin_index.php';</script>";
    } else {
        echo "<script>alert('Car not updated successfully!'); window.location.href='admin_index.php';</script>";
    }
    $stmt->close();
}
if (isset($_GET['id'])) {
// Fetch all cars
    $id = $_GET['id'];

    $sql = "SELECT * FROM cars where id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>


        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Update Cars</title>
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
                    <h2>Update Car Details</h2>

                    <?php if (isset($message)) : ?>
                        <p style="color: green;"><?php echo $message; ?></p>
                    <?php endif; ?>

                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Car Type</th>
                                <th>Model</th>
                                <th>Price per Day</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                        <form method="POST" action="update.php">
                            <!-- Hidden ID field -->
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($car['id']); ?>">

                            <!-- Image Display -->
                            <td>
                                <img src="images/<?php echo htmlspecialchars($row['carImage']); ?>" 
                                     alt="<?php echo htmlspecialchars($row['type']); ?>" width="100">
                            </td>

                            <!-- Editable Fields -->
                            <td>
                                <input type="text" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" required>
                            </td>
                            <td>
                                <input type="text" name="model" value="<?php echo htmlspecialchars($row['model']); ?>" required>
                            </td>
                            <td>
                                <input type="number" name="price_per_day" step="0.01" value="<?php echo htmlspecialchars($row['price_per_day']); ?>" required>
                            </td>
                            <td>
                                <select name="availability">
                                    <option value="1" <?php echo $row['availability'] === 'Available' ? 'selected' : ''; ?>>Available</option>
                                    <option value="0" <?php echo $row['availability'] === 'Rented Out' ? 'selected' : ''; ?>>Rented Out</option>
                                </select>
                            </td>

                            <!-- Submit Button -->
                            <td>
                                <button type="submit" class="book-now">Update</button>
                            </td>
                        </form>
                        </tr>

                        </tbody>
                    </table>
                </section>

                <footer>
                    <p>© 2025 DriveEasyRentals. All Rights Reserved.</p>
                </footer>
            </body>
        </html>
        <?php
    }
}
$conn->close();
?>

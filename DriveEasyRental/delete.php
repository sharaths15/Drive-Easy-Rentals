<?php
require_once 'connection.php';
$conn = getDatabaseConnection();

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer

    // Start transaction for atomic operations
    $conn->begin_transaction();

    try {
        // 1. Delete related rentals for this car
        $sql1 = "DELETE FROM rentals WHERE car_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();

        // 2. Delete the car from the cars table
        $sql2 = "DELETE FROM cars WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();

        // Commit the transaction if both queries succeed
        $conn->commit();
        $message = "Car and related rental records deleted successfully!";
    } catch (Exception $e) {
        // Rollback transaction in case of an error
        $conn->rollback();
        $message = "Error deleting car: " . $e->getMessage();
    }
} else {
    $message = "Car ID not provided!";
}

$conn->close();

// Redirect back to the car list page
header("Location: admin_index.php?message=" . urlencode($message));
exit;
?>

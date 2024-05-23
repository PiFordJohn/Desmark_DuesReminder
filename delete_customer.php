<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$customer_id = $_POST['customer_id'];

// Delete customer from the database
$sql = "DELETE FROM customers WHERE customer_id='$customer_id'";
if (mysqli_query($conn, $sql)) {
    echo "Customer deleted successfully";
    header("Location: customers.php");
exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

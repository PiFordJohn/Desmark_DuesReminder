<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$customer_id = $_POST['customer_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$contact_number = $_POST['contact_number'];
$due_date = $_POST['due_date'];

// Update customer information in the database
$sql = "UPDATE customers SET name='$name', address='$address', contact_number='$contact_number', due_date='$due_date' WHERE customer_id='$customer_id'";
if (mysqli_query($conn, $sql)) {
    echo "Customer information updated successfully";
    header("Location: customers.php");
exit;

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

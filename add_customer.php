<?php
// add_customer.php

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$contact_number = $_POST['contact_number'];
$due_date = $_POST['due_date'];

// Prepare SQL statement to insert data into customers table
$sql = "INSERT INTO customers (name, address, contact_number, due_date) VALUES ('$name', '$address', '$contact_number', '$due_date')";

// Execute SQL statement
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    header("Location: customers.php");
exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

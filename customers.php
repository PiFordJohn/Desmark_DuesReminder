<?php
// customers.php

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the customers table
$sql = "SELECT customer_id, name, address, contact_number, due_date FROM customers";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dues Reminder</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h1>Customers</h1>
        <br>
        <div class="container">
    <h3>Add New Customer</h3>
    <form method="post" action="add_customer.php">
        <div class="form-group">
                    <label for="customer_id_update">Customer ID:</label>
                    <input type="text" class="form-control" id="customer_id_update" name="customer_id">
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number">
        </div>
        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="text" class="form-control" id="due_date" name="due_date">
        </div>
        <button type="submit" class="btn btn-success">Add Customer</button>
    </form>
</div>

        <!-- Update Customer Form -->
        <div class="container">
            <h3>Update Customer Information</h3>
            <form method="post" action="update_customer.php">
                <div class="form-group">
                    <label for="customer_id_update">Customer ID:</label>
                    <input type="text" class="form-control" id="customer_id_update" name="customer_id">
                </div>
                <div class="form-group">
                    <label for="name_update">Name:</label>
                    <input type="text" class="form-control" id="name_update" name="name">
                </div>
                <div class="form-group">
                    <label for="address_update">Address:</label>
                    <input type="text" class="form-control" id="address_update" name="address">
                </div>
                <div class="form-group">
                    <label for="contact_number_update">Contact Number:</label>
                    <input type="text" class="form-control" id="contact_number_update" name="contact_number">
                </div>
                <div class="form-group">
                    <label for="due_date_update">Due Date:</label>
                    <input type="text" class="form-control" id="due_date_update" name="due_date">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <!-- Delete Customer Form -->
        <div class="container">
            <h3>Delete Customer</h3>
            <form method="post" action="delete_customer.php">
                <div class="form-group">
                    <label for="customer_id_delete">Customer ID:</label>
                    <input type="text" class="form-control" id="customer_id_delete" name="customer_id">
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

        <!-- Display Customer Information -->
        <div class="container table-container">
            <h3>Customer Information</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

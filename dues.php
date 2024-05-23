<?php
// dues.php

// Establish database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the dues table
$sql = "SELECT due_date, due_amount, customer_id FROM dues";
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
        <h1>Dues Management</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Due Date</th>
                    <th>Due Amount</th>
                    <th>Customer ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['due_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['due_amount']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No dues found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

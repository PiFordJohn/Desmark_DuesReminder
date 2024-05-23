<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Redirect to dashboard if not an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$username = $_SESSION['username'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "desmark_dues_reminder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch reports data
$sql = "SELECT customer_id, balance, due_dates FROM reports";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="dashboard.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <style>
        .admin-container {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
        }
        .admin-actions {
            margin-top: 20px;
        }
        .main-content {
            padding: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="main-content">
        <div class="container admin-container">
            <h2>Admin Dashboard</h2>
            <p>Welcome, <?php echo htmlspecialchars($username); ?>. You have admin privileges.</p>

            <div class="admin-actions">
                <h3>Customer Management</h3>
                <a href="customers.php" class="btn btn-primary">Customer Management</a>
                <br>

                <h3>Reports</h3>
                <a href="reports.php" class="btn btn-primary">View Reports</a>

                <h3>System Settings</h3>
                <a href="settings.php" class="btn btn-primary">System Settings</a>
            </div>
            
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
        <div class="container table-container">
            <h3>Reports</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Balance</th>
                        <th>Due Dates</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['customer_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['balance']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['due_dates']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records found</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

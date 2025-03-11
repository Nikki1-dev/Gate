<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "service_report";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
} else {
    echo "<p style='color:green;'>Database connected successfully!</p>";
}

// Fetch only 'Cancelled' status reports
$sql = "SELECT Location, work_order, Area, date_time, month_name, email, report_status, remarks FROM reports_1 WHERE report_status = 'Cancelled'";
$result = $conn->query($sql);

if (!$result) {
    die("<p style='color:red;'>Query failed: " . $conn->error . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Table</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h2>Cancelled Reports</h2>
    <table>
        <tr>
            <th>Location</th>
            <th>Work Order No</th>
            <th>Area</th>
            <th>Date & Time</th>
            <th>Month Name</th>
            <th>Email</th>
            <th>Report Status</th>
            <th>Remarks</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['Location']) . "</td>
                        <td>" . htmlspecialchars($row['work_order']) . "</td>
                        <td>" . htmlspecialchars($row['Area']) . "</td>
                        <td>" . htmlspecialchars($row['date_time']) . "</td>
                        <td>" . htmlspecialchars($row['month_name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['report_status']) . "</td>
                        <td>" . htmlspecialchars($row['remarks']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8' style='text-align:center; color:red;'>No records found for 'Cancelled'</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
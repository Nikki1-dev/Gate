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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "service_report";

        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch only 'In Progress' status reports
        $sql = "SELECT Location, work_order, Area, date_time, month_name, email, report_status, remarks FROM reports_1 WHERE report_status = 'In Progress'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Location']}</td>
                        <td>{$row['work_order']}</td>
                        <td>{$row['Area']}</td>
                        <td>{$row['date_time']}</td>
                        <td>{$row['month_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['report_status']}</td>
                        <td>{$row['remarks']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found for 'In Progress'</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>

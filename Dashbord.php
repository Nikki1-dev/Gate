<?php
// ✅ Database connection file ko include karein
include('db_connect.php'); 

// ✅ Ensure database connection is valid
if (!isset($conn) || !$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// ✅ Fetch counts for each report_status
$statuses = ['Completed', 'Pending', 'Canceled', 'In Progress'];
$counts = [];

foreach ($statuses as $status) {
    $query = $conn->prepare("SELECT COUNT(*) AS total FROM reports_1 WHERE report_status = ?");
    if ($query === false) {
        die("SQL Error: " . $conn->error);
    }
    
    $query->bind_param("s", $status);
    $query->execute();
    $result = $query->get_result();
    $counts[$status] = $result->fetch_assoc()['total'] ?? 0;
    $query->close();
}

// ✅ Table data fetch karein
$sql = "SELECT Location, work_order, Area, date_time, month_name, email, report_status, remarks FROM reports_1 WHERE report_status = 'Pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        .dashboard {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .card {
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 200px;
            color: white;
        }
        .completed { background-color: #28a745; }
        .pending { background-color: #ffc107; color: black; }
        .canceled { background-color: #dc3545; }
        .inprogress { background-color: #17a2b8; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Service Report Dashboard</h1>
    
    <div class="dashboard">
        <div class="card completed">
            <h2>Completed</h2>
            <p><?php echo $counts['Completed']; ?></p>
        </div>
        <div class="card pending">
            <h2>Pending</h2>
            <p><?php echo $counts['Pending']; ?></p>
        </div>
        <div class="card canceled">
            <h2>Canceled</h2>
            <p><?php echo $counts['Canceled']; ?></p>
        </div>
        <div class="card inprogress">
            <h2>In Progress</h2>
            <p><?php echo $counts['In Progress']; ?></p>
        </div>
    </div>

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
            <th>Action</th>
        </tr>
        <?php
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
                        <td><button onclick=\"sendMail('{$row['email']}')\">Send Mail</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No records found for 'Pending'</td></tr>";
        }
        ?>
    </table>

    <script>
        function sendMail(email) {
            alert("Mail sent to " + email);
            // Yahan aap AJAX ya form action use kar sakte hain mail bhejne ke liye
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>

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

// Fetch locations from database
$locations = [];
$sql = "SELECT DISTINCT Location FROM reports_1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row['Location'];
    }
}

// Fetch work orders from database
$work_orders = [];
$sql = "SELECT DISTINCT work_order FROM reports_1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $work_orders[] = $row['work_order'];
    }
}

// Fetch areas from database
$areas = [];
$sql = "SELECT DISTINCT Area FROM reports_1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $areas[] = $row['Area'];
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Location = isset($_POST['Location']) ? $_POST['Location'] : '';
    $work_order = isset($_POST['work_order']) ? $_POST['work_order'] : '';
    $Area = isset($_POST['Area']) ? $_POST['Area'] : '';
    $date_time = isset($_POST['date_time']) ? $_POST['date_time'] : '';
    $report_status = isset($_POST['report_status']) ? $_POST['report_status'] : '';
    $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : '';

    $sql = "INSERT INTO reports_1 (Location, work_order, Area, date_time, report_status, remarks) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $Location, $work_order, $Area, $date_time, $report_status, $remarks);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Report</title>
    <style>
        body { font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f8ff; margin: 0; }
        .form-container { width: 400px; background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); text-align: center; border-top: 5px solid #007bff; }
        h2 { margin-bottom: 20px; color: #007bff; font-weight: 700; }
        .form-group { margin-bottom: 15px; text-align: left; }
        label { font-weight: bold; display: block; margin-bottom: 5px; color: #333; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; background: #f9f9f9; }
        input:focus, textarea:focus { border-color: #007bff; outline: none; background: #fff; }
        button { background: #007bff; color: white; padding: 12px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-size: 16px; font-weight: bold; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Service Report</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="location">Location:</label>
                <input list="locationList" id="location" name="Location" placeholder="Enter location">
                <datalist id="locationList">
                    <?php foreach ($locations as $loc) { echo "<option value='$loc'>"; } ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="work_order">Work Order No.:</label>
                <input list="workOrderList" id="work_order" name="work_order" placeholder="Enter work order">
                <datalist id="workOrderList">
                    <?php foreach ($work_orders as $wo) { echo "<option value='$wo'>"; } ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="area">Area:</label>
                <input list="areaList" id="area" name="Area" placeholder="Enter area">
                <datalist id="areaList">
                    <?php foreach ($areas as $area) { echo "<option value='$area'>"; } ?>
                </datalist>
            </div>
            
            <div class="form-group">
                <label for="date_time">Date & Time:</label>
                <input type="text" id="date_time" name="date_time" readonly>
            </div>
            <div class="form-group">
                <label for="report_status">Report Status:</label>
                <select id="report_status" name="report_status">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancel">Cancel</option>
                </select>
            </div>
            <div class="form-group">
                <label for="remarks">Remarks:</label>
                <textarea id="remarks" rows="3" placeholder="Enter remarks" name="remarks"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
    <script>
        function setDateTime() {
            const dateTimeInput = document.getElementById("date_time");
            const now = new Date();
            const formattedDateTime = now.toISOString().slice(0, 19).replace("T", " ");
            dateTimeInput.value = formattedDateTime;
        }
        setDateTime();
    </script>
</body>
</html>
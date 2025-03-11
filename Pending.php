<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Table</title>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function() {
            emailjs.init("8Nl2bakai17BHVFhW"); // Apni Email.js Public Key yahan dalna
        })();

        function sendMail(button) {
            let row = button.closest("tr"); // Get parent row of clicked button
            let email = row.cells[5].innerText;
            let location = row.cells[0].innerText;
            let workOrder = row.cells[1].innerText;
            let area = row.cells[2].innerText;
            let dateTime = row.cells[3].innerText;
            let monthName = row.cells[4].innerText;
            let remarks = row.cells[7].innerText;

            let templateParams = {
                to_email: email,
                location: location,
                work_order: workOrder,
                area: area,
                date_time: dateTime,
                month_name: monthName,
                remarks: remarks
            };

            emailjs.send("service_kr6kvbv", "template_ey2zpkd", templateParams)
                .then(function(response) {
                    alert("Email Sent Successfully to " + email);
                    row.cells[6].innerText = "Sent"; // Update Report Status to 'Sent'
                    button.disabled = true; // Disable button after sending
                }, function(error) {
                    alert("Failed to Send Email: " + JSON.stringify(error));
                });
        }
    </script>
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
        button {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        button:hover {
            background-color: #218838;
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
            <th>Action</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "service_report";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT Location, work_order, Area, date_time, month_name, email, report_status, remarks FROM reports_1 WHERE report_status = 'Pending'";
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
                        <td>
                            <button onclick=\"sendMail(this)\">Send Mail</button>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No records found for 'Pending'</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>

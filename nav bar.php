<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .status-bar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            background-color: #343a40;
            padding: 15px;
            border-radius: 8px;
        }
        .status-bar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .status-bar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="status-bar">
        <a href="complete.php">Complete</a>
        <a href="In progress.php">In Progress</a>
        <a href="pending.php">Pending</a>
        <a href="cancel.php">Cancel</a>
    </div>
</body>
</html>
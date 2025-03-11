<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4>Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link text-white">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Reports</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Settings</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="container-fluid p-4">
            <h2>Admin Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Total Users</h5>
                        <p>1,250</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Revenue</h5>
                        <p>$5,750</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5>Orders</h5>
                        <p>320</p>
                    </div>
                </div>
            </div>
            
            <!-- Chart -->
            <canvas id="myChart" class="mt-4"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Sales',
                    data: [12, 19, 3, 5, 2],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>

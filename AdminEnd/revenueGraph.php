<?php
include('connect.php'); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Styling the container of the chart */
        .artistchart-container {
            width: 70%; 
            margin: 0 auto;
            margin-top: 50px;
            border: 2px solid #1B8673; 
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 10px; 
            background-color: #f9f9f9; 
        }

        /* Styling the chart  */
        canvas {
            width: 100%; 
            height: 400px; 
        }
    </style>
</head>

<body>

<?php
if (isset($_SESSION['adminname'])) {
    // Query to fetch revenue data and month names
    $select_revenue_data = "SELECT SUM(st.price) AS Revenue, YEAR(sr.StartDate) AS Month
                            FROM subscription_types st 
                            JOIN subscription_records sr ON st.PackageCode = sr.SubscriptionType
                            GROUP BY YEAR(sr.StartDate)";                   

    $result_revenue_data = mysqli_query($conn, $select_revenue_data);

    $data = array();

    // Fetch the results and store them in the array
    while ($row = mysqli_fetch_assoc($result_revenue_data)) {
        $data[] = $row;
    }

    // Convert PHP array to JSON for use in JavaScript
    $json_data = json_encode($data);
    echo '<script>';
    echo 'var artistData = ' . $json_data . ';'; 
    echo '</script>';
?>

<!-- Container for the chart -->
<div class="artistchart-container">
    <canvas id="artistChart"></canvas>
</div>

<script>
const data = artistData; // Use the data passed from PHP

// Extract Revenue and Month from the data
const Revenue = data.map(item => item.Revenue);
const labels = data.map(item => item.Month); // Use Month names as labels

// Get the context of the canvas to draw the chart
const ctx = document.getElementById('artistChart').getContext('2d');

// Create a line chart using Chart.js
const artistChart = new Chart(ctx, {
    type: 'line', // Set the type of chart
    data: {
        labels: labels, // Assign the labels (months)
        datasets: [{
            label: 'Revenue', // Label for the dataset
            data: Revenue, // The data for the chart
            fill: false, // Disable the area fill
            borderColor: 'rgb(75, 192, 192)', // Line color
            tension: 0.1 // Smoothness of the line
        }]
    },
    options: {
        responsive: true, // Make the chart responsive
        scales: {
            y: {
                beginAtZero: true // Start y-axis at zero
            }
        }
    }
});
</script>

<?php
} 
?>

</body>
</html>

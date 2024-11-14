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
        .chart-container {
            width: 70%; 
            margin: 0 auto;
            margin-top: 50px;
            border: 2px solid #1B8673 ; 
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 10px; 
            background-color: #f9f9f9; 
        }

        /* Styling the chart  */
        canvas {
            width: 100% ; 
            height: 400px ; 
        }
    </style>
</head>

<body>

<!-- Navigation bar -->

<?php 
    // include('navbar.php')
?>

<?php
if (isset($_SESSION['adminname'])) {

    $select_artist_followers = "SELECT a.Name, COUNT(UserID) as followers 
                                FROM artist_followers f 
                                INNER JOIN artists a ON a.ArtistID = f.ArtistID 
                                GROUP BY a.ArtistID";                   

    $result_artist_followers = mysqli_query($conn, $select_artist_followers);
    $data = array();
    
    // Fetch the results and store them in the array
    while ($row = mysqli_fetch_assoc($result_artist_followers)) {
        $data[] = $row;
    }

    // Convert PHP array to JSON for use in JavaScript
    $json_data = json_encode($data);
    echo '<script>';
    echo 'var artistData = ' . $json_data . ';'; 
    echo '</script>';
}
?>

<!-- Container for the chart -->
<div class="chart-container">
    <canvas id="artistChart"></canvas>
</div>

<script>
const data = artistData; // Use the data passed from PHP

// Extract artist names and follower count
const ArtistNames = data.map(artist => artist.Name);
const Followers = data.map(artist => artist.followers);

// Get the context of the canvas to draw the chart
const ctx = document.getElementById('artistChart').getContext('2d');

// Create a bar chart using Chart.js
const artistChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ArtistNames,
        datasets: [{
            label: 'Number of Followers',
            data: Followers,
            backgroundColor: 'rgba(124, 210, 183, 0.5)', 
            borderColor: '#1B8673', 
            borderWidth: 1
        }]
    },
    options: {
        responsive: true, 
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>

</html>

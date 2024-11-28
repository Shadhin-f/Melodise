<?php

include('connect.php');

// Check if artist is logged in
if (!isset($_SESSION['artistid'])) {
    echo '<script>
            alert("Please log in to view this page.");
            window.location.href = "artistlogin.php";
          </script>';
    exit;
}

$artistID = $_SESSION['artistid'];

// Query to get the play count for each song of the logged-in artist
$query = "
    SELECT s.Title AS SongTitle, COUNT(mpr.SongID) AS PlayCount
    FROM music_play_record mpr
    JOIN songs s ON mpr.SongID = s.SongID
    WHERE s.ArtistID = ?
    GROUP BY mpr.SongID, s.Title
    ORDER BY PlayCount DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $artistID);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for the chart
$songTitles = [];
$playCounts = [];

while ($row = $result->fetch_assoc()) {
    $songTitles[] = $row['SongTitle'];
    $playCounts[] = $row['PlayCount'];
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Play Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

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
            height: 1000px ; 
        }
    </style>
</head>

<body>
    
    <div class="chart-container">
        <canvas id="musicPlayChart"></canvas>
    </div>

    <script>
        // Data for the chart
        const songTitles = <?php echo json_encode($songTitles); ?>;
        const playCounts = <?php echo json_encode($playCounts); ?>;

        // Generate random colors for each bar
        const barColors = songTitles.map(() => {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            return `rgba(${r}, ${g}, ${b}, 0.7)`;
        });

        // Create the chart
        const ctx = document.getElementById('musicPlayChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: songTitles,
                datasets: [{
                    label: 'Number of Plays',
                    data: playCounts,
                    backgroundColor: barColors,
                    borderColor: barColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
    responsive: true,
    plugins: {
        legend: {
            display: true, // Enable the legend to show the label
            position: 'top', // Optionally, set the position of the legend (e.g., 'top', 'bottom')
        }
    },
    scales: {
        x: {
            title: {
                display: true,
                text: 'Songs'
            }
        },
        y: {
            title: {
                display: true,
                text: 'Play Count'
            },
            beginAtZero: true
        }
    }
}

        });
    </script>
</body>

</html>

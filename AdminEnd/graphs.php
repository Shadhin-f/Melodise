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
    <title>Charts Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 70%;
            margin: 0 auto;
            margin-top: 50px;
            border: 2px solid #1B8673;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            padding: 10px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        canvas {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>
<?php
if (isset($_SESSION['adminname'])) {
    
    // Fetch data for both charts
    $music_played_query = "SELECT s.Title, COUNT(*) as 'Number_of_Plays'
                           FROM music_play_record mpr
                           INNER JOIN songs s ON s.SongID = mpr.SongID
                           GROUP BY mpr.SongID limit 10";

    $music_played_result = mysqli_query($conn, $music_played_query);
    $music_played_data = mysqli_fetch_all($music_played_result, MYSQLI_ASSOC);

    $artist_followers_query = "SELECT a.Name, COUNT(UserID) as followers 
                               FROM artist_followers f 
                               INNER JOIN artists a ON a.ArtistID = f.ArtistID 
                               GROUP BY a.ArtistID limit 10";

    $artist_followers_result = mysqli_query($conn, $artist_followers_query);
    $artist_followers_data = mysqli_fetch_all($artist_followers_result, MYSQLI_ASSOC);

    // Encode data to JSON for use in JavaScript
    echo '<script>';
    echo 'var MusicPlayedData = ' . json_encode($music_played_data) . ';';
    echo 'var ArtistFollowersData = ' . json_encode($artist_followers_data) . ';';
    echo '</script>';

    echo"
<div class='chart-container'>
    <canvas id='MusicCountChart'></canvas>
</div>
<div class='chart-container'>
    <canvas id='ArtistChart'></canvas>
</div>

<script>
function renderChart(canvasId, label, data, labels, backgroundColor, borderColor) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
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
}

// Prepare data for Artist Followers chart
const artistNames = ArtistFollowersData.map(item => item.Name);
const followers = ArtistFollowersData.map(item => item.followers);

// Render Artist Followers chart
renderChart(
    'ArtistChart',
    'Number of Followers',
    followers,
    artistNames,
    'rgba(124, 210, 183, 0.5)',
    '#1B8673'
);


// Prepare data for Music Plays chart
const musicTitles = MusicPlayedData.map(item => item.Title);
const musicPlays = MusicPlayedData.map(item => item.Number_of_Plays);

// Render Music Plays chart
renderChart(
    'MusicCountChart',
    'Number of Plays',
    musicPlays,
    musicTitles,
    'rgba(124, 210, 183, 0.5)',
    '#1B8673'
);

</script>";

}
?>
</body>
</html>
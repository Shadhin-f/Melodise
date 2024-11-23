<?php
// Include database connection
include('connect.php');

// Check if the album name is passed via GET
if (isset($_GET['album']) && !empty($_GET['album'])) {
    // Sanitize the album name from the GET request
    $albumName = mysqli_real_escape_string($conn, $_GET['album']);

    // Query to get the album ID based on the album name
    $albumQuery = "SELECT AlbumID FROM albums WHERE Title = '$albumName' LIMIT 1";
    $albumResult = mysqli_query($conn, $albumQuery);

    // Check if the album exists
    if (mysqli_num_rows($albumResult) > 0) {
        // Fetch the album ID
        $albumRow = mysqli_fetch_assoc($albumResult);
        $albumID = $albumRow['AlbumID'];

        // Query to get album details and its songs
        $sql = "SELECT * 
                FROM albums al
                LEFT JOIN songs s ON s.AlbumID = al.AlbumID
                WHERE al.AlbumID = $albumID";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead>
                    <tr>
                        <th>Album Title</th>
                        <th>Release Date</th>
                        <th>Song Title</th>
                        <th>Duration</th>
                        <th>Genre</th>
                    </tr>
                  </thead><tbody>";

            // Loop through the result set and display each row
            while ($row = mysqli_fetch_assoc($result)) {
                // Display album details only once
                if ($row['SongID'] == null) {
                    echo "<tr><td rowspan='" . (mysqli_num_rows($result)) . "'>" . $row['Title'] . "</td><td rowspan='" . (mysqli_num_rows($result)) . "'>" . $row['ReleaseDate'] . "</td>";
                }

                // Display song details
                if ($row['SongID'] !== null) {
                    echo "<td>" . $row['Title'] . "</td>";
                    echo "<td>" . $row['Duration'] . "</td>";
                    echo "<td>" . $row['GenreID'] . "</td></tr>";
                }
            }

            echo "</tbody></table>";
        } else {
            echo "No songs found for this album.";
        }
    } else {
        echo "Album not found!";
    }
} else {
    // If no album is passed in the GET request, show an access denied message
    echo "Access Denied: No album specified.";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Songs</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Album Songs</h1>
        <div class="card p-4">
            <!-- PHP code to display album details and songs goes here -->
            <p>If the album details and songs are found, they will be displayed in the table above.</p>

            <!-- Button to go back to the album list or dashboard (you can adjust this link) -->
            <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js for any interactive elements -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

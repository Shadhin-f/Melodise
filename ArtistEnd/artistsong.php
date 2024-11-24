<?php
// Include database connection
include('connect.php');


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

// Close the database connection
mysqli_close($conn);
?>

<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Music - Billie Eilish</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation bar -->
    <?php include('artistNavbar.php'); ?>

    <!-- Main Section -->
    <section id="section-header" class="px-5 my-5">
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0 ml-5" name="back-to-artistHome-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="ml-5 d-inline-block">All Music</h1>
    </section>

    <section class="all-music-container px-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Song</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Genre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to find Billie Eilish's ArtistID
                $artistID= $_SESSION['artistid'];
                $artist_name = $_SESSION['artistname'];

                $artist_name_query = "SELECT ArtistID FROM `artists` WHERE ArtistID='$artistID'";
                $artist_name_result = mysqli_query($conn, $artist_name_query);

                if ($artist_name_result && mysqli_num_rows($artist_name_result) > 0) {
                    $artist_row = mysqli_fetch_assoc($artist_name_result);
                    $artist_id = $artist_row['ArtistID'];

                    // Query to fetch all songs by Billie Eilish
                    $select_songs = "SELECT * FROM `songs` WHERE `ArtistID` = $artist_id ORDER BY Title";
                    $result_songs = mysqli_query($conn, $select_songs);

                    if ($result_songs && mysqli_num_rows($result_songs) > 0) {
                        while ($row_data = mysqli_fetch_assoc($result_songs)) {
                            $song_name = $row_data['Title'];
                            $genre_id = $row_data['GenreID'];
                            $color_code = $row_data['ColorCode'];
                            $audio = $row_data['Audio'];

                            // Fetch genre information
                            $select_genre = "SELECT Title FROM `genres` WHERE GenreID = $genre_id";
                            $result_genre = mysqli_query($conn, $select_genre);
                            $genre_data = mysqli_fetch_assoc($result_genre);
                            $genre_title = $genre_data['Title'] ?? "Unknown Genre";

                            // Display each song row
                            echo "
                            <tr>
                                <td>$song_name</td>
                                <td>$artist_name</td>
                                <td>$genre_title</td>
                                <td><a href='../Resources/Songs/$audio.mp3' target='_blank'><i class='fa-solid fa-play' style='color: $color_code;'></i></a></td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No songs found for Billie Eilish.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Artist Billie Eilish not found in the database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>

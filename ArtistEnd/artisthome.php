<?php
include('connect.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Home</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->

    <style>
        .themed-btn {
            color: #1B8673;
        }
    </style>

</head>

<body>
    <!-- Tanveer -->

    <!-- Navigation bar -->

    <?php
    include('artistNavbar.php')
    ?>

    <!-- Artist Releases Section -->

    <section id="artist-releases" class="p-3">
        <!-- Title -->

        <div id="artist-releases-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Your Releases</h1>

            <!-- <a href="#" class="text-decoration-none themed-btn">View All</a> -->
            <form action="artistActions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name="view-all-btn">View All</button>
            </form>
        </div>





        <!-- Artist Releases Cards -->

        <div id="card-container" class="d-flex flex-wrap gap-3">

            <!-- Fetching Music data from MySQL server -->

            <?php
            // Assuming $artist_name is the name of the artist that you want to fetch the songs for
            $artist_name = $_SESSION['artistname'];  // Replace with dynamic value (for example, fetched from session or user input)

            // Query to get the ArtistID for the artist (Billie Eilish in this case)
            $select_artist = "SELECT * FROM `artists` WHERE `Name` = '$artist_name'";
            $result_artist = mysqli_query($conn, $select_artist);
            $artist_data = mysqli_fetch_assoc($result_artist);

            if ($artist_data) {
                $artist_id = $artist_data['ArtistID'];  // Get the ArtistID

                // Query to get only 5 songs by this artist (using the ArtistID and LIMIT 5)
                $select_songs = "SELECT * FROM `songs` WHERE `ArtistID` = $artist_id LIMIT 5";
                $result_songs = mysqli_query($conn, $select_songs);

                // Loop to fetch and display all songs
                while ($row_data = mysqli_fetch_assoc($result_songs)) {
                    $song_name = $row_data['Title'];   // Song title
                    $audio = $row_data['Audio'];   // Audio file name

                    // Display each song in a card
                    echo "<div class='card' style='width: 17rem;'> 
    <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' style='width: 100%; height: 12rem; object-fit: cover;' alt='Card image cap'>
    <div class='card-body'>
        <h5 class='card-title'>$song_name</h5>
        <p class='card-text'>$artist_name</p>
        
        <a href='../Resources/Songs/$audio.mp3' class='play-btn-back position-absolute bottom-0 end-0 rounded-circle bg-dark text-white play-btn' target='_blank'>
    <i class='fa-solid fa-play p-3'></i>
</a>

    </div>
</div>";
                }
            } else {
                echo "Artist not found!";
            }
            ?>





    </section>





























    <!-- Badhon -->

    <!-- Your Albums Section -->

    <section id='master-control' class='p-3'>


        <!-- Title -->

        <div id='master-control-title-container' class='d-flex flex-row justify-content-between align-items-center '>
            <h1>Your Albums</h1>

            <!-- <a href="#" class="text-decoration-none themed-btn">Add New Album</a> -->
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>Add New Album</button>
            </form>
        </div>


        <!-- Your Releases Cards -->

        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>


            <!-- Update Music Card -->

            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://upload.wikimedia.org/wikipedia/en/f/ff/Tum_Hi_Ho_cover.jpeg' style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'> <a href='#' class='btn btn-primary'>Tum Hi Ho</a> </h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>

            <!-- Update Music Card -->

            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'><a href='#' class='btn btn-primary'>Channa Mereya</a></h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>

            <!-- Update Music Card -->

            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://upload.wikimedia.org/wikipedia/en/8/89/Gerua_cover.jpg' style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'><a href='#' class='btn btn-primary'>Gerua</a></h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
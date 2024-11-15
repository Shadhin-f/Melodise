<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Music</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #card-container {
            max-width: 1600px; /* Restrict the container's width */
            margin: 0 auto;    /* Center the container horizontally */
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('artistNavbar.php'); ?>

    <!-- All music headline -->
    <section id="section-header" class="px-5 my-5">
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0 ml-5" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="ml-5 d-inline-block">All Music</h1>
    </section>

    <!-- Artist Releases Cards Section -->
    <div id="card-container" class="d-flex flex-wrap gap-3 mt-4 px-3 mx-auto justify-content-center">
        <?php
        // Fetch the artist's name from the session
        $artist_name = $_SESSION['artistname'];

        // Query to fetch the artist's ID
        $select_artist = "SELECT * FROM `artists` WHERE `Name` = '$artist_name'";
        $result_artist = mysqli_query($conn, $select_artist);
        $artist_data = mysqli_fetch_assoc($result_artist);

        if ($artist_data) {
            $artist_id = $artist_data['ArtistID']; // Extract the ArtistID

            // Query to fetch all songs by the artist
            $select_songs = "SELECT * FROM `songs` WHERE `ArtistID` = $artist_id";
            $result_songs = mysqli_query($conn, $select_songs);

            // Loop through the results and display cards
            while ($row_data = mysqli_fetch_assoc($result_songs)) {
                $song_name = $row_data['Title'];   // Song title
                $audio = $row_data['Audio'];       // Audio file name

                // Output the song card
                echo "
                <div class='card' style='width: 17rem;'>
                    <img 
                        class='card-img-top' 
                        src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' 
                        alt='Album Art' 
                        style='width: 100%; height: 12rem; object-fit: cover;'
                    >
                    <div class='card-body position-relative'>
                        <h5 class='card-title'>$song_name</h5>
                        <p class='card-text'>$artist_name</p>
                        <a 
                            href='../Resources/Songs/$audio.mp3' 
                            class='play-btn-back position-absolute bottom-0 end-0 rounded-circle bg-dark text-white play-btn' 
                            target='_blank'
                        >
                            <i class='fa-solid fa-play p-3'></i>
                        </a>
                    </div>
                </div>";
            }
        } else {
            echo "<p class='text-danger'>Artist not found!</p>";
        }
        ?>
    </div>

</body>

<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>

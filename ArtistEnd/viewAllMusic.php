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


        .delete-btn {
            background-color: #ff4d4d; /* Red background for delete */
            border: none;
            border-radius: 50%; /* Make the button circular */
            width: 50px;  /* Adjust the size */
            height: 50px; /* Adjust the size */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #ff1a1a; /* Darker red on hover */
        }

        .card {
            position: relative;
            width: 17rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05); /* Slight zoom effect on hover */
        }

        .card-img-top {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }

        .card-body {
            text-align: left; /* Align text to the left for better readability */
            position: relative;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem; /* Increase font size */
            white-space: normal; /* Allow wrapping of text */
            word-wrap: break-word; /* Break words if necessary */
        }

        .card-text {
            font-size: 0.9rem;
            color: gray;
        }

        .delete-btn-container {
            position: absolute;
            top: 10px;
            right: 10px; /* Move to the right */
            z-index: 1;
        }


    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('artistNavbar.php'); ?>

    <!-- All music headline -->
    <section id="section-header" class="px-5 my-5 d-flex justify-content-between align-items-center">
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="d-inline-block">All Music</h1>
        <a href="addMusic.php" class="btn btn-primary">Add Music</a>
    </section>

    <!-- Artist Releases Cards Section -->
    <section>
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
                    $song_id = $row_data['SongID'];   // Song ID for deletion
                    $song_name = $row_data['Title'];  // Song title
                    $audio = $row_data['Audio'];      // Audio file name

                    // Output the song card
                    echo "
                    <div class='card'>
                        <img 
                            class='card-img-top' 
                            src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' 
                            alt='Album Art'
                        >
                        <div class='card-body'>
                            <h5 class='card-title'>$song_name</h5> <!-- Title accommodates more text -->
                            <p class='card-text'>$artist_name</p>
                            <div class='delete-btn-container'>
                                <form method='post' action='artistActions.php'>
                                    <input type='hidden' name='song_id' value='$song_id'>
                                    <button 
                                        type='submit' 
                                        name='delete-music-btn' 
                                        class='delete-btn'>
                                        <i class='fa-solid fa-trash'></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<p class='text-danger'>Artist not found!</p>";
            }
            ?>
        </div>
    </section>
</body>

<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>

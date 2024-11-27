<?php
session_start();
if (!isset($_SESSION['artistname'])) {
    header("Location: artistlogin.php");
    exit;
}

include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Songs</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #card-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .card {
            position: relative;
            width: 17rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }

        .card-body {
            text-align: left;
            position: relative;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
            white-space: normal;
            word-wrap: break-word;
        }

        .card-text {
            font-size: 0.9rem;
            color: gray;
        }

        

    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('artistNavbar.php'); ?>

    <!-- Page Header -->
    <section id="section-header" class="px-5 my-5 d-flex justify-content-between align-items-center">
    <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="d-inline-block text-center mx-auto">Album Songs</h1>
    </section>

    <!-- Songs Section -->
    <section>
        <div id="card-container" class="d-flex flex-wrap gap-3 mt-4 px-3 mx-auto justify-content-center">
            <?php

            // Fetch the artist's name from the session
            $artist_name = $_SESSION['artistname'];

            // Check if the album name is passed via GET
            if (isset($_GET['album']) && !empty($_GET['album'])) {
                $albumName = mysqli_real_escape_string($conn, $_GET['album']);

                // Query to get the album ID
                $albumQuery = "SELECT AlbumID FROM albums WHERE Title = '$albumName' LIMIT 1";
                $albumResult = mysqli_query($conn, $albumQuery);

                if (mysqli_num_rows($albumResult) > 0) {
                    $albumRow = mysqli_fetch_assoc($albumResult);
                    $albumID = $albumRow['AlbumID'];

                    // Fetch songs from the album
                    $songsQuery = "SELECT SongID, Title, Audio 
                                   FROM songs 
                                   WHERE AlbumID = $albumID";
                    $songsResult = mysqli_query($conn, $songsQuery);

                    if (mysqli_num_rows($songsResult) > 0) {
                        while ($song = mysqli_fetch_assoc($songsResult)) {
                            $song_id = $song['SongID'];
                            $song_title = $song['Title'];
                            $audio_file = $song['Audio'];

                            echo "
                            <div class='card'>
                                <img 
                                    class='card-img-top' 
                                    src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' 
                                    alt='Album Art'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$song_title</h5>
                                    <p class='card-text'>$artist_name</p>
                                </div>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-center text-danger'>No songs found in this album.</p>";
                    }
                } else {
                    echo "<p class='text-center text-danger'>Album not found.</p>";
                }
            } else {
                echo "<p class='text-center text-danger'>Access Denied: No album specified.</p>";
            }
            ?>
        </div>
    </section>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>

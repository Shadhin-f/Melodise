<?php
// session_start();
include('connect.php')
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">

    <style>
        /* Music plyer customise */

        .custom-player-card {
            background-color: #e9ecef;
            /* Slightly darker gray for better contrast */
            border-top: 2px solid #198754;
            /* Accent color border */
            border-radius: 12px 12px 0 0;
            /* Rounded top corners */
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-player-card h6 {
            color: #343a40;
            /* Darker text for visibility */
            font-weight: bold;
        }

        .custom-player-card p {
            color: #6c757d;
            /* Secondary dark color */
        }

        .custom-progress {
            height: 6px;
            border-radius: 3px;
            background-color: #ced4da;
            /* Light gray for empty progress */
            margin: 0 10px;
        }

        .custom-progress-bar {
            background-color: #198754;
            /* Accent color for the progress bar */
        }

        .btn-icon {
            background: none;
            border: none;
            color: #198754;
            /* Accent color for icons */
            font-size: 1.2rem;
            padding: 0.5rem;
        }

        .btn-icon:hover {
            color: #145c3a;
            /* Darker shade on hover */
        }

        .btn-icon:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->

    <?php
    include('navbar.php')
    ?>

    <!-- My Music Section -->


    <section id="my-music" class="p-3">
        <!-- Title -->
        <div id="your-music-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Top picks</h1>
            <!-- <a href="#" class="text-decoration-none themed-btn">All Music</a> -->
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>All Music</button>
            </form>
        </div>


        <!-- Music Cards section -->


        <div id="card-container">


            <!-- Fetching Music data from mysql server -->


            <?php
            $select_songs = "SELECT * FROM `songs` ORDER BY RAND() LIMIT 10";                   // query for selecting all songs
            $result_songs = mysqli_query($conn, $select_songs);

            // loop to fetch all songs
            while ($row_data = mysqli_fetch_assoc($result_songs)) {
                $song_name = $row_data['Title'];                                               // Getting the Song name
                $color_code = $row_data['ColorCode'];                                          // Getting the color code
                $artist_id = $row_data['ArtistID'];                                            // Getting artist id

                // echo ($artist_id);                                                          // for testting purpose
                $select_artist_name = "SELECT * FROM `artists` WHERE ArtistID = $artist_id";   // query for selecting artist name
                $result_artist_name = mysqli_query($conn, $select_artist_name);
                $artist_data = mysqli_fetch_assoc($result_artist_name);
                $artist_name = $artist_data['Name'];

                echo "<div class='card mx-3 mt-3 d-inline-block shadow' style='width: 18rem; background-color: $color_code'>
                                <div class='card-body position-relative p-3'>
                                    <h5 class='card-title mt-4 font-weight-bold'>$song_name</h5>
                                    <p class='card-text font-weight-light'>$artist_name</p>
                                    <p class='play-btn-back position-absolute bottom-0 end-0 rounded-circle bg-dark text-white play-btn'><i class='fa-solid fa-play p-3'></i></p>
                                </div>
                            </div>";
            }


            ?>
        </div>
    </section>


    <!-- Artist Section -->


    <section id="top-artist" class="p-3">
        <div id="top-artist-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Top Artists</h1>
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-artist-btn'>All Artist</button>
            </form>
        </div>


        <!-- Artist Cards container div-->

        <div id="artist-card-container">

            <?php

            //  Fetching artists data from database


            $select_artists = "SELECT * FROM `artists` ORDER BY RAND() LIMIT 10";                   // query for selecting all songs
            $result_artists = mysqli_query($conn, $select_artists);

            while ($row_data = mysqli_fetch_assoc($result_artists)) {
                $artist_name = $row_data['Name'];
                $artist_img = $row_data['Image'];

                // Artists cards

                echo "
                    <div class='artist-card mx-3 mt-3 d-inline-block' style='width: 12rem;'>
                        <div class='artist-img-circle mx-auto rounded-circle mt-2' style='width: 10rem; height: 10rem; background-image: url(\"../Resources/ArtistImges/$artist_img\"); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;'></div>
                        <p class='d-block text-center artist-name mx-auto mt-2 w-auto'>$artist_name</p>
                    </div>
                ";
            }


            ?>
        </div>

    </section>


    <!-- Music PLayer -->


    <div class="card fixed-bottom text-center p-3 custom-player-card">
        <div class="row align-items-center">
            <div class="col-2 text-center">
                <img src="path_to_album_art" alt="Album Art" class="img-fluid rounded-circle shadow-sm" width="50">
            </div>
            <div class="col-8">
                <h6 id="songTitle" class="mb-1 text-dark">Hello</h6>
                <p id="songArtist" class="small text-secondary">Shadhin</p>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="playPauseBtn" class="btn btn-icon me-2"><i class="fas fa-play"></i></button>
                    <div class="progress custom-progress flex-grow-1">
                        <div id="songProgress" class="progress-bar custom-progress-bar" role="progressbar"></div>
                    </div>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <button id="volumeBtn" class="btn btn-icon"><i class="fas fa-volume-up"></i></button>
            </div>
        </div>
    </div>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
<script>
    let audio = new Audio('path_to_song_file');
    let isPlaying = false;

    document.getElementById('playPauseBtn').addEventListener('click', () => {
        const playPauseIcon = document.getElementById('playPauseBtn').querySelector('i');
        if (isPlaying) {
            audio.pause();
            playPauseIcon.classList.remove('fa-pause');
            playPauseIcon.classList.add('fa-play');
        } else {
            audio.play();
            playPauseIcon.classList.remove('fa-play');
            playPauseIcon.classList.add('fa-pause');
        }
        isPlaying = !isPlaying;
    });

    audio.ontimeupdate = () => {
        const progress = (audio.currentTime / audio.duration) * 100;
        document.getElementById('songProgress').style.width = progress + '%';
    };
</script>

</html>
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
            background-color: #198754;
            color: white;
            padding: 10px 15px;
            height: 60px;
        }

        .album-art {
            width: 50px;
            height: 50px;
            background-size: cover;
            background-position: center;
            border-radius: 4px;
        }

        .song-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 10px;
        }

        .song-title {
            font-size: 0.9rem;
            margin: 0;
        }

        .song-artist {
            font-size: 0.75rem;
            margin: 0;
            color: #d4d4d4;
        }

        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-container {
            width: 100%;
            height: 5px;
            background-color: #d4d4d4;
            border-radius: 3px;
            overflow: hidden;
        }

        .custom-progress-bar {
            height: 100%;
            background-color: #fff;
        }

        .volume-control {
            display: flex;
            justify-content: center;
            align-items: center;
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


    <div class="card fixed-bottom custom-player-card d-flex align-items-center">
        <div class="d-flex align-items-center w-100">
            <!-- Album art with background image -->
            <div class="album-art" style="background-image: url('https://images.unsplash.com/photo-1730688213382-b62363b93824?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyMHx8fGVufDB8fHx8fA%3D%3D');"></div>

            <!-- Song information -->
            <div class="song-info">
                <p class="song-title mb-0" id="songTitle">Hello</p>
                <p class="song-artist mb-0" id="songArtist">Mona Lisa</p>
            </div>

            <!-- Controls: play/pause button and progress bar -->
            <div class="d-flex flex-grow-1 align-items-center justify-content-center">
                <button id="playPauseBtn" class="btn btn-sm text-black me-2"><i class="fas fa-play"></i></button>
                <div class="progress-container">
                    <div id="songProgress" class="progress-bar custom-progress-bar"></div>
                </div>
            </div>

            <!-- Volume control -->
            <div class="volume-control ms-2">
                <button id="volumeBtn" class="btn btn-sm text-black"><i class="fas fa-volume-up"></i></button>
            </div>
        </div>
    </div>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
<script>
    const audio = new Audio('Downloads/Forever_Young.mp3');
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
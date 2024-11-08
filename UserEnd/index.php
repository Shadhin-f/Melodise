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
            $select_songs = "SELECT * FROM `songs` LIMIT 10";                   // query for selecting all songs
            $result_songs = mysqli_query($conn, $select_songs);

            // loop to fetch all songs
            while ($row_data = mysqli_fetch_assoc($result_songs)) {
                $song_name = $row_data['Title'];                                               // Getting the Song name
                $color_code = $row_data['ColorCode'];                                          // Getting the color code
                $artist_id = $row_data['ArtistID'];                                            // Getting artist id
                $audio = $row_data['Audio'];                                                    // Getting audio file name

                // echo ($artist_id);                                                          // for testting purpose
                $select_artist_name = "SELECT * FROM `artists` WHERE ArtistID = $artist_id";   // query for selecting artist name
                $result_artist_name = mysqli_query($conn, $select_artist_name);
                $artist_data = mysqli_fetch_assoc($result_artist_name);
                $artist_name = $artist_data['Name'];

                echo "<div class='card mx-3 mt-3 px-2 d-inline-block shadow play-card' style='width: 18rem; background-color: $color_code'
                        data-song-name='$song_name' 
                        data-artist-name='$artist_name' 
                        data-song-url='../Resources/Songs/$audio.mp3' 
                        data-album-art='../Resources/DesignElements/ProfileBack.jpg'>
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



    <!-- User Play lists section -->
    <!-- Premium users can access -->
    <?php
    if (isset($_SESSION['userid'])) {

        $userID = $_SESSION['userid'];
        $userType = $_SESSION['usertype'];


        if ($userType != 1) {



            echo "


            <section id='user-playlist' class='p-3 mb-5'>
               <!-- Title for playlist -->
               <!-- Title include button to add new playlist -->
               <!-- Title include button to view all playlist -->

               <div id='user-playlists-title-container' class='d-flex flex-row justify-content-between align-items-center'>
                   <div class='d-flex align-items-center'>
                       <h1 class='me-3'>Your playlists</h1>
                       <!-- Create Playlist Button -->
                       <!-- Existing 'Create Playlist' Button -->
                        <button class='btn themed-btn d-flex align-items-center' data-bs-toggle='modal' data-bs-target='#createPlaylistModal'>
                            <i class='fas fa-plus me-2'></i> <!-- Font Awesome plus icon -->
                            Create Playlist
                        </button>

                   </div>

                   <form action='user-actions.php' method='get'>
                       <button type='submit' class='themed-btn bg-transparent border-0' name='all-playlist-btn'>All Playlists</button>
                   </form>
               </div>

               <!-- Section to display playlists created by user -->

               <!-- Playlist Cards Section -->
               <div id='card-container' class='mb-5'>";


            $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' GROUP BY playlists.PlaylistID LIMIT 6";
            $result_user_playlists = mysqli_query($conn, $select_user_playlists);

            // while ($row_data = mysqli_fetch_assoc($result_artists)) {
            //     $artist_name = $row_data['Name'];
            //     $artist_img = $row_data['Image'];

            while ($row_data = mysqli_fetch_assoc($result_user_playlists)) {
                $playlistName = $row_data['Name'];
                $playlistID = $row_data['PlaylistID'];
                $numOfSongs = $row_data['NumOFSongs'];

                echo "


                    <!-- Playlist Card -->


                <form action='user-actions.php' method='post' class='d-inline'>
                    <input type='hidden' name='playlistID' value='$playlistID'>
                    <input type='hidden' name='playlistName' value='$playlistName'>
                    <div class='card mx-3 mt-3 p-2 d-inline-block shadow' style='width: 18rem; background-color: #f7f7f7;'>
                        <div class='card-body position-relative p-3'>
                            <h5 class='card-title mt-4 font-weight-bold'>$playlistName</h5>
                            <p class='card-text font-weight-light'>$numOfSongs Songs</p>
                            <button type='submit' class='position-absolute bottom-0 end-0 rounded-circle bg-dark text-white play-btn border-0' name='view-playlist-btn'>
                                <i class='fa-solid fa-bars p-3'></i>
                            </button>
                        </div>
                    </div>
                </form>
                ";
            }
        }
    }

    ?>

    <!-- Modal for playlist creation -->

    <div class="modal fade" id="createPlaylistModal" tabindex="-1" aria-labelledby="createPlaylistModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPlaylistModalLabel">Create Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="user-actions.php" method="post">
                        <div class="mb-3">
                            <label for="playlistName" class="form-label">Playlist Name</label>
                            <input type="text" class="form-control" id="playlistName" name="playlistName" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name='create-playlist-confirm-btn'>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <!-- Music PLayer (Not functional)-->


    <?php
    include('music-player.php')
    ?>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

<!-- Bootstrap to handle modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Select all play-card elements
    document.querySelectorAll('.play-card').forEach(card => {
        card.addEventListener('click', () => {
            // Get song details from the data attributes
            const songName = card.getAttribute('data-song-name');
            const artistName = card.getAttribute('data-artist-name');
            const songUrl = card.getAttribute('data-song-url');
            const albumArt = card.getAttribute('data-album-art');

            // Update the music player card
            document.getElementById('songTitle').textContent = songName;
            document.getElementById('songArtist').textContent = artistName;
            document.querySelector('.album-art').style.backgroundImage = `url(${albumArt})`;

            // Load the new song
            audio.src = songUrl;
            audio.play();

            // Update play/pause button icon
            const playPauseIcon = document.getElementById('playPauseBtn').querySelector('i');
            playPauseIcon.classList.remove('fa-play');
            playPauseIcon.classList.add('fa-pause');
        });
    });
</script>




</html>
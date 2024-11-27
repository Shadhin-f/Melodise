<?php
// session_start();
include('connect.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    unset($_SESSION['playlistid']);
    unset($_SESSION['playlistname']);
}

if (isset($_GET['unset_session']) && $_GET['unset_session'] === 'true') {
    unset($_SESSION['searchKey']);
    header("Location: index.php");
    exit;
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">
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
            <h1><?php
                if (isset($_SESSION['searchKey'])) {
                    $searchKey = $_SESSION['searchKey'];
                    if ($searchKey != '') {
                        // search key session with search key
                        echo "Music";
                    } else {
                        // Search key session active but no input
                        echo "Trending";
                    }
                } else {
                    // Search key not set case
                    echo "Trending";
                }
                ?>

            </h1>
            <!-- <a href="#" class="text-decoration-none themed-btn">All Music</a> -->
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>All Music</button>
            </form>
        </div>


        <!-- Music Cards section -->


        <div id="card-container">


            <!-- Fetching Music data from mysql server -->


            <?php

            // Session check for search key
            // If search key is set music qith the search key will be fetched
            // or Top played songs will be displayed

            if (isset($_SESSION['searchKey'])) {
                $searchKey = $_SESSION['searchKey'];
                if ($searchKey != '') {
                    // search key session with search key
                    $select_songs = "SELECT * FROM `songs` WHERE Title LIKE '%" . $searchKey . "%' LIMIT 10";
                } else {
                    // Search key session active but no input
                    $select_songs = "SELECT * FROM `songs` LIMIT 10";
                }
            } else {
                // Search key not set case
                //$select_songs = "SELECT * FROM `songs` LIMIT 10";                                  // query for selecting all songs
                //  Updated query to display most played songs first (Trending songs)
                $select_songs = "SELECT s.SongID, s.Title, s.ColorCode, s.ArtistID,s.Audio, (COUNT(s.SongID)-1) AS TimesPlayed 
                                 FROM `songs` s 
                                 LEFT JOIN music_play_record m ON m.SongID = s.SongID 
                                 GROUP BY s.SongID ORDER BY `TimesPlayed` DESC LIMIT 10;";
            }

            $result_songs = mysqli_query($conn, $select_songs);

            // loop to fetch all songs
            while ($row_data = mysqli_fetch_assoc($result_songs)) {
                $song_code = $row_data['SongID'];                                              // Getting the Song name
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
                        data-song-id='$song_code'
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
            <h1>
                <?php
                if (isset($_SESSION['searchKey'])) {
                    $searchKey = $_SESSION['searchKey'];
                    echo $searchKey !== '' ? "Artists" : "Top Artists";
                } else {
                    echo "Top Artists";
                }
                ?>
            </h1>
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-artist-btn'>All Artist</button>
            </form>
        </div>

        <!-- Artist Cards container div -->
        <div id="artist-card-container">
            <?php
            // Fetching artists data from the database
            $select_artists = "SELECT a.ArtistID, a.Name, a.Image, COUNT(af.ArtistID) AS FollowerCount
                                FROM `artists` a
                                LEFT JOIN `artist_followers` af ON af.ArtistID = a.ArtistID
                                WHERE a.Name LIKE '%" . (isset($_SESSION['searchKey']) && $_SESSION['searchKey'] !== '' ? $_SESSION['searchKey'] : '') . "%'
                                GROUP BY a.ArtistID, a.Name
                                ORDER BY FollowerCount DESC
                                LIMIT 10;
                            ;";
            $result_artists = mysqli_query($conn, $select_artists);

            while ($row_data = mysqli_fetch_assoc($result_artists)) {
                $artist_id = $row_data['ArtistID'];
                $artist_name = $row_data['Name'];
                $artist_img = $row_data['Image'];

                // Artist cards with a form for each artist
                echo "
                <form action='user-actions.php' method='get' class='d-inline-block'>
                    <input type='hidden' name='artist_id' value='$artist_id'>
                    <button type='submit' class='artist-card-btn bg-transparent border-0 p-0' name='view-artist-profile-btn'>
                        <div class='artist-card mx-3 mt-3' style='width: 12rem;'>
                            <div class='artist-img-circle mx-auto rounded-circle mt-2' style='width: 10rem; height: 10rem; background-image: url(\"../Resources/ArtistImges/$artist_img\"); background-color: antiquewhite; background-repeat: no-repeat; background-size: cover;'></div>
                            <p class='d-block text-center artist-name mx-auto mt-2 w-auto'>$artist_name</p>
                        </div>
                    </button>
                </form>
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


            <section id='user-playlist' class='p-3'>
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
               <div id='playlist-card-container' class='mb-2'>";




            if (isset($_SESSION['searchKey'])) {
                $searchKey = $_SESSION['searchKey'];
                if ($searchKey != '') {
                    // search key session with search key

                    $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' AND playlists.Name LIKE '%" . $searchKey . "%' GROUP BY playlists.PlaylistID LIMIT 6";
                } else {
                    // Search key session active but no input
                    $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' GROUP BY playlists.PlaylistID LIMIT 6";
                }
            } else {
                // Search key not set case
                $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' GROUP BY playlists.PlaylistID LIMIT 6";
            }

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
    </section>
    <!-- // End of playlist section -->

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



    <!-- Followed Artists section -->
    <?php
    if (isset($_SESSION['userid'])):
    ?>


        <section id="fav-artist" class="p-3 mb-5">
            <div id="fav-artist-title-container" class="d-flex flex-row justify-content-between align-items-center">
                <h1>
                    <?php

                    echo "Artists you follow";
                    ?>
                </h1>
                <form action="user-actions.php" method="get">
                    <button type="submit" class="themed-btn bg-transparent border-0" name='all-artist-btn'>All Artist</button>
                </form>
            </div>

            <!-- Artist Cards container div -->
            <div id="fav-artist-card-container" class="mb-5">
                <?php
                // Fetching artists data from the database
                $select_artists = "SELECT * 
                                FROM `artist_followers`
                                LEFT JOIN artists ON artist_followers.ArtistID = artists.ArtistID
                                WHERE artist_followers.UserID = '$userID'
                                AND artists.Name LIKE '%" . (isset($_SESSION['searchKey']) && $_SESSION['searchKey'] !== '' ? $_SESSION['searchKey'] : '') . "%' 
                                LIMIT 10";
                $result_artists = mysqli_query($conn, $select_artists);

                while ($row_data = mysqli_fetch_assoc($result_artists)) {
                    $artist_id = $row_data['ArtistID'];
                    $artist_name = $row_data['Name'];
                    $artist_img = $row_data['Image'];

                    // Artist cards with a form for each artist
                    echo "
                <form action='user-actions.php' method='get' class='d-inline-block'>
                    <input type='hidden' name='artist_id' value='$artist_id'>
                    <button type='submit' class='artist-card-btn bg-transparent border-0 p-0' name='view-artist-profile-btn'>
                        <div class='artist-card mx-3 mt-3' style='width: 12rem;'>
                            <div class='artist-img-circle mx-auto rounded-circle mt-2' style='width: 10rem; height: 10rem; background-image: url(\"../Resources/ArtistImges/$artist_img\"); background-color: antiquewhite; background-repeat: no-repeat; background-size: cover;'></div>
                            <p class='d-block text-center artist-name mx-auto mt-2 w-auto'>$artist_name</p>
                        </div>
                    </button>
                </form>
            ";
                }
                ?>
            </div>
        </section>

    <?php
    endif;
    ?>






    <!-- ------------------ Footer sections-------------------------------- -->
    <?php
    // include('footer.php');
    ?>

    <!-- Music PLayer-->


    <?php
    include('music-player.php')
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>


    <script>
        // Select all play-card elements ------------- v1 -----------------------

        document.querySelectorAll('.play-card').forEach(card => {
            card.addEventListener('click', () => {
                // Get song details from the data attributes
                const songID = card.getAttribute('data-song-id');




                const songName = card.getAttribute('data-song-name');
                const artistName = card.getAttribute('data-artist-name');
                const songUrl = card.getAttribute('data-song-url');
                const albumArt = card.getAttribute('data-album-art');

                // Update the music player card
                document.getElementById('songID').value = songID;
                document.getElementById('favSongID').value = songID;
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

                // --- Update play count function call --- Working
                updatePlayCount(songID);


            });
        });

        //  --- Update playcount function --- Working
        function updatePlayCount(songId) {
            // Make a simple asynchronous request
            fetch(`user-actions.php?song_id=${songId}`)
                .then(response => {
                    if (response.ok) {
                        console.log('Play count updated successfully!');
                    } else {
                        console.error('Failed to update play count.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }



        // Function to enable mouse scroll for horizontal scrolling
        function enableHorizontalScroll(container) {
            container.addEventListener('wheel', (event) => {
                if (event.deltaY === 0) return; // No vertical scrolling
                container.scrollLeft += event.deltaY; // Scroll horizontally based on the wheel movement
                event.preventDefault(); // Prevent default scrolling behavior
            });
        }

        // Apply to both card containers (Music, Artist, Playlist)
        const cardContainer = document.getElementById('card-container');
        const artistCardContainer = document.getElementById('artist-card-container');
        const playlistCardContainer = document.getElementById('playlist-card-container');
        const favArtistCardContainer = document.getElementById('fav-artist-card-container');

        // Enable horizontal scroll for all relevant containers
        enableHorizontalScroll(cardContainer);
        enableHorizontalScroll(artistCardContainer);
        enableHorizontalScroll(playlistCardContainer);
        enableHorizontalScroll(favArtistCardContainer);
    </script>

</body>


</html>
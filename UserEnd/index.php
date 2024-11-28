<?php
// session_start();
include('connect.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    unset($_SESSION['playlistid']);
    unset($_SESSION['playlistname']);
    unset($_SESSION['artistid']);
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


    <style>
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #1B8673 !important;
            color: white !important;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .btn-play,
        .follow-btn,
        .unfollow-btn,
        .event-details-btn {
            border: none;
            padding: 5px 12px;
            font-size: 0.9rem;
            border-radius: 20px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .unfollow-btn {
            background-color: #1B8673;
            color: white;
        }

        .btn-play:hover {
            background-color: #1B8673;
        }

        .event-details-btn:hover {
            background-color: #13664c;
            color: white;

        }

        .follow-btn:hover {
            background-color: #13664c;
            color: white;
        }

        .unfollow-btn:hover {
            background-color: #000;
        }

        .modal-header {
            background-color: #1B8673;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .event-modal-professional .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }

        .event-modal-professional #eventImage {
            border: 1px solid #ddd;
        }


        @media (min-width: 1030px) {
            .tables-container {
                display: flex;
                gap: 20px;
            }

            .table-wrapper {
                flex: 1;
            }
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

                   <!--

                   <form action='user-actions.php' method='get'>
                       <button type='submit' class='themed-btn bg-transparent border-0' name='all-playlist-btn'>All Playlists</button>
                   </form>

                   -->
               </div>

               <!-- Section to display playlists created by user -->

               <!-- Playlist Cards Section -->
               <div id='playlist-card-container' class='mb-2'>";




            if (isset($_SESSION['searchKey'])) {
                $searchKey = $_SESSION['searchKey'];
                if ($searchKey != '') {
                    // search key session with search key

                    $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' AND playlists.Name LIKE '%" . $searchKey . "%' GROUP BY playlists.PlaylistID";
                } else {
                    // Search key session active but no input
                    $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' GROUP BY playlists.PlaylistID ";
                }
            } else {
                // Search key not set case
                $select_user_playlists = "SELECT playlists.Name, playlists.PlaylistID, COUNT(playlist_songs.SongID) as NumOFSongs FROM `playlists` LEFT JOIN `playlist_songs` ON playlists.PlaylistID = playlist_songs.PlaylistID WHERE playlists.UserID = '$userID' GROUP BY playlists.PlaylistID ";
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


        <section id="fav-artist" class="p-3">
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
            <div id="fav-artist-card-container" class="">
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


    <?php
    // Php Block to prevent the bottom sections to display while searching
    if (!isset($_SESSION['searchKey']) && isset($_SESSION['userid'])):
    ?>




        <!-- Recent Played & Event section -->
        <div class="container-fluid mb-5">
            <!-- Tables Container -->
            <div class="tables-container">
                <!-- Recent Played Music Table -->
                <div class="table-wrapper mb-5">
                    <h3>Most played by you</h3>
                    <table class="table">
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
                            // Your database connection should already be included
                            // Query to fetch data



                            $query = "SELECT mr.SongID, s.Audio , s.Title AS SongTitle, a.Name AS ArtistName, g.Title AS Genre, 
                                    al.Title AS AlbumTitle, al.AlbumCover, COUNT(mr.SongID) AS TimesPlayed  
                                    FROM `music_play_record` mr
                                    LEFT JOIN songs s ON s.SongID = mr.SongID
                                    LEFT JOIN genres g ON g.GenreID = s.SongID
                                    LEFT JOIN artists a ON a.ArtistID = s.ArtistID
                                    LEFT JOIN albums al ON al.AlbumID = s.AlbumID
                                    WHERE mr.UserID = '$userID'
                                    GROUP BY mr.SongID
                                    ORDER BY TimesPlayed DESC
                                    LIMIT 5;";

                            $result = mysqli_query($conn, $query);

                            // Check if query execution was successful
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Loop through the results and generate table rows
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $songID = $row['SongID'];
                                    $songTitle = htmlspecialchars($row['SongTitle']);
                                    $artistName = htmlspecialchars($row['ArtistName']);
                                    $genre = htmlspecialchars($row['Genre']);
                                    $albumCover = htmlspecialchars($row['AlbumCover']);
                                    $timesPlayed = $row['TimesPlayed'];
                                    $audio = $row['Audio'];

                                    echo "
                                            <tr>
                                                <td>$songTitle</td>
                                                <td>$artistName</td>
                                                <td>$genre</td>
                                                <td>
                                                    <button class='btn-play' 


                                                            data-song-id='$songID'
                                                            data-song-name='$songTitle' 
                                                            data-artist-name='$artistName' 
                                                            data-song-url='../Resources/Songs/$audio.mp3' 
                                                            data-album-art='../Resources/DesignElements/ProfileBack.jpg'>
                                                        <i class='fas fa-play'></i> Play
                                                    </button>
                                                </td>
                                            </tr>
                                    ";
                                }
                            } else {
                                echo "
                                    <tr>
                                        <td colspan='4' class='text-center'>No recent songs found.</td>
                                    </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Followed Events Table -->
                <div class="table-wrapper mb-5">
                    <h3>Upcoming events</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Event</th>
                                <th scope="col">Date</th>
                                <th scope="col">Location</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query to fetch upcoming events, ordered by event date in descending order
                            $query = "SELECT EventID, EventTitle, EventDescription, EventDate, EventLocation, EventTime, EventImage, artists.Name
                                      FROM upcoming_events
                                      LEFT JOIN artists ON artists.ArtistID = upcoming_events.ArtistID
                                      WHERE EventDate >= CURDATE()
                                      ORDER BY EventDate ASC
                                      LIMIT 5;";

                            $result = mysqli_query($conn, $query);

                            // Check if query execution was successful and if events are found
                            if ($result && mysqli_num_rows($result) > 0) {
                                // Loop through the results and generate table rows
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $eventID = $row['EventID'];
                                    $eventTitle = htmlspecialchars($row['EventTitle']);
                                    $eventDescription = htmlspecialchars($row['EventDescription']);
                                    $eventDate = htmlspecialchars($row['EventDate']);
                                    $eventLocation = htmlspecialchars($row['EventLocation']);
                                    $eventImage = htmlspecialchars($row['EventImage']);
                                    $eventTime = htmlspecialchars($row['EventTime']);
                                    $artistName = htmlspecialchars($row['Name']);

                                    // Check if the user is following the event
                                    if (isset($_SESSION['userid'])) {
                                        $userID = $_SESSION['userid'];
                                        $follow_check_query = "SELECT * FROM event_followers WHERE UserID = '$userID' AND EventID = '$eventID'";
                                        $follow_result = mysqli_query($conn, $follow_check_query);

                                        if ($follow_result && mysqli_num_rows($follow_result) > 0) {
                                            // User is following the event
                                            $followButton = "<form action='user-actions.php' method='post' class='d-inline'>
                                                                <button class='unfollow-btn' name='unfollow-event' value='$eventID'>Following</button>
                                                              </form>";
                                        } else {
                                            // User is not following the event
                                            $followButton = "<form action='user-actions.php' method='post' class='d-inline'>
                                                                <button class='follow-btn' name='follow-event' value='$eventID'>Follow</button>
                                                              </form>";
                                        }
                                    } else {
                                        // User is not logged in
                                        $followButton = "<p><i>Login to follow the event</i></p>";
                                    }

                                    echo "
                                        <tr>
                                            <td>$eventTitle</td>
                                            <td>$eventDate</td>
                                            <td>$eventLocation</td>
                                            <td>
                                                <button class='event-details-btn' data-bs-toggle='modal' data-bs-target='#eventModal'
                                                    onclick=\"showEventDetails('$eventTitle', '$eventDescription', '$eventImage', '$artistName', '$eventDate', '$eventLocation')\">View Details</button>
                                                $followButton
                                            </td>
                                        </tr>
                                    ";
                                }
                            } else {
                                echo "
                                    <tr>
                                        <td colspan='4' class='text-center'>No upcoming events</td>
                                    </tr>
                                ";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    <?php
    endif;
    ?>

    <!-- Event Details Modal -->
    <div class="modal fade event-modal-professional" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <!-- Modal Header -->
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title fw-bold" id="eventModalLabel">Event Title</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <img src="" id="eventImage" alt="Event Cover Photo" class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;">
                    </div>
                    <p class="mb-3">
                        <strong class="text-primary">Description:</strong> <span id="eventDescription"></span>
                    </p>
                    <p class="mb-3">
                        <strong class="text-primary">Artist:</strong> <span id="eventArtist"></span>
                    </p>
                    <p class="mb-3">
                        <strong class="text-primary">Date:</strong> <span id="eventDate"></span>
                    </p>
                    <p class="mb-3">
                        <strong class="text-primary">Venue:</strong> <span id="eventVenue"></span>
                    </p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-end">
                    <button class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-2"></i>Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>




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

        document.querySelectorAll('.play-card, .btn-play').forEach(card => {
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

        // Event details modal
        function showEventDetails(title, description, image, artist, date, venue) {
            document.getElementById("eventModalLabel").textContent = title;
            document.getElementById("eventDescription").textContent = description;
            if(image == 'unknown.jpg'){
                document.getElementById("eventImage").src = "../Resources/DesignElements/ProfileBack.jpg";
            }else{
                document.getElementById("eventImage").src = "../Resources/EventImages/" + image;
            }
            document.getElementById("eventArtist").textContent = artist;
            document.getElementById("eventDate").textContent = date;
            document.getElementById("eventVenue").textContent = venue;
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
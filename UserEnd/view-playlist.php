<?php
include('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Playlist - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Page container styling */
        .page-container {
            padding: 1.5rem 3rem;
        }

        /* Header button and section styling */
        .header-btn {
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            color: #1B8673;
            transition: color 0.3s ease;
        }

        .header-btn:hover {
            color: #0f5a42;
        }

        .song-row {
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .song-row:hover {
            background-color: #f8f9fa;
        }

        .play-btn,
        .remove-btn {
            background-color: transparent;
            border: none;
            color: #1B8673;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .play-btn:hover {
            color: #0f5a42;
        }

        .remove-btn:hover {
            color: tomato;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #1B8673 !important;
            color: white !important;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <?php include('navbar.php'); ?>

    <!-- Check for User Session -->
    <?php
    if (!isset($_SESSION['userid'])) {
        echo '<script>
                alert("You must log in to access this page!");
                window.location.href = "login.php";
              </script>';
    }
    $userID = $_SESSION['userid'];
    if (isset($_GET['playlistname'])) {
        $_SESSION['playlistname'] = $_GET['playlistname'];

        // Sql query to get playlist id of favourite playlist of the user
        $select_fav_playlist_id = "SELECT * 
                                    FROM playlists
                                    WHERE playlists.UserID = '$userID' AND playlists.Name = 'Favourite';";
        $result_fav_playlist_id = mysqli_query($conn, $select_fav_playlist_id);
        if ($result_fav_playlist_id) {
            $playlist_data = mysqli_fetch_assoc($result_fav_playlist_id);
            if (isset($playlist_data) && isset($playlist_data['PlaylistID'])) {
                $_SESSION['playlistid'] = $playlist_data['PlaylistID'];
            } else {
                echo '<script>
                        alert("You don\'t have any liked song!");
                        window.location.href = "index.php";
                      </script>';
            }
        }
    }
    ?>

    <!-- Page Container -->
    <div class="page-container">
        <!-- Header Section -->
        <section id="section-header" class="d-flex align-items-center justify-content-between mb-4">
            <!-- Back Button and Playlist Name -->
            <div class="d-flex align-items-center">
                <!-- Back Button -->
                <form action="user-actions.php" method="get" class="d-inline-block">
                    <button type="submit" class="header-btn" name="back-to-home-btn">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </form>
                <!-- Playlist Name -->
                <h1 class="ms-3 mb-0"><?php
                                        echo htmlspecialchars($_SESSION['playlistname']);
                                        ?></h1>
            </div>

            <!-- Delete Playlist Button -->
            <form action="user-actions.php" method="post" class="d-inline-block">
                <input type="hidden" name="playlistID" value="<?php echo $_SESSION['playlistid']; ?>">
                <button type="submit" class="header-btn text-danger" name="delete-playlist-btn" onclick="return confirmDelete()">
                    Delete Playlist
                </button>
            </form>
        </section>

        <!-- Songs Table -->
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Song</th>
                        <th scope="col">Artist</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch and Display Songs in Playlist -->
                    <?php

                    // For favourite playlist nav link action
                    if (isset($_SESSION['playlistname']) && !isset($_SESSION['playlistid'])) {
                        $select_playlist_songs = "SELECT songs.SongID, songs.Title, artists.Name, songs.Audio
                                              FROM playlist_songs
                                              LEFT JOIN songs ON playlist_songs.SongID = songs.SongID
                                              LEFT JOIN artists ON songs.ArtistID = artists.ArtistID
                                              LEFT JOIN playlists ON playlist_songs.PlaylistID = playlists.PlaylistID
                                              WHERE playlists.Name = 'Favourite' AND playlists.UserID = '$userID';";
                    } else {
                        if (isset($_SESSION['playlistid'])) {
                            $playlistID = $_SESSION['playlistid'];
                        }
                        $select_playlist_songs = "SELECT songs.SongID, songs.Title, artists.Name, songs.Audio
                                              FROM playlist_songs
                                              LEFT JOIN songs ON playlist_songs.SongID = songs.SongID
                                              LEFT JOIN artists ON songs.ArtistID = artists.ArtistID
                                              WHERE PlaylistID = '$playlistID';";
                    }
                    $result_playlist_songs = mysqli_query($conn, $select_playlist_songs);
                    $serialNumber = 1;

                    while ($row_data = mysqli_fetch_assoc($result_playlist_songs)) {
                        $songID = $row_data['SongID'];
                        $songName = htmlspecialchars($row_data['Title']);
                        $artistName = htmlspecialchars($row_data['Name']);
                        $audio = $row_data['Audio'];
                        echo "
                            <tr class='song-row'>
                                <td>$serialNumber</td>
                                <td>
                                    <button class='play-btn me-2' data-song-id='$songID' data-song-name='$songName' data-artist-name='$artistName' data-song-url='../Resources/Songs/$audio.mp3'>
                                        <i class='fa-solid fa-play'></i>
                                    </button> $songName
                                </td>
                                <td>$artistName</td>
                                <td>
                                    <form action='user-actions.php' method='post'>
                                        <input type='hidden' name='songID' value='$songID'>
                                        <button type='submit' class='remove-btn' name='remove-song-btn'>
                                            <i class='fa-solid fa-minus'></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ";
                        $serialNumber++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>




    

    <!-- Music Player -->
    <?php include('music-player.php'); ?>

    <!-- Confirm Delete Script -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this playlist?");
        }
    </script>

    <!-- JavaScript to Handle Song Playback -->
    <script>
        // Select all play buttons
        document.querySelectorAll('.play-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Get song details from data attributes
                const songID = button.getAttribute('data-song-id');
                const songName = button.getAttribute('data-song-name');
                const artistName = button.getAttribute('data-artist-name');
                const songUrl = button.getAttribute('data-song-url');

                // Update the music player
                document.getElementById('songID').value = songID;
                document.getElementById('songTitle').textContent = songName;
                document.getElementById('songArtist').textContent = artistName;
                document.querySelector('.album-art').style.backgroundImage = `url('../Resources/DesignElements/ProfileBack.jpg')`;

                // Load the new song and play it
                audio.src = songUrl;
                audio.play();

                // Update the play/pause button icon
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
    </script>

    <!-- Bootstrap and FontAwesome Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</body>

</html>
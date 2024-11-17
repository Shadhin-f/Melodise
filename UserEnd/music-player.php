<?php
include('connect.php');
// session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Music plyer customise */

        .custom-player-card {
            background-color: #bdbcbb;
            color: white;
            padding: 10px 15px !important;
            height: 70px;
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
            color: #e3e2e1;
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

        .active-heart {
            color: #1B8673;
        }
    </style>
</head>

<body>
    <!-- Music Player (Somehow functional functional :)  ) -->
    <div class="card fixed-bottom custom-player-card d-flex align-items-center">
        <div class="d-flex align-items-center w-100">
            <!-- Album art with background image -->
            <div class="album-art" style="background-image: url('https://images.unsplash.com/photo-1730688213382-b62363b93824?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyMHx8fGVufDB8fHx8fA%3D%3D');"></div>

            <!-- Song information -->
            <div class="song-info">
                <input type="hidden" id="songID"> <!-- Passing song ID using js -->
                <p class="song-title mb-0" id="songTitle">No track</p>
                <p class="song-artist mb-0" id="songArtist">Unknown</p>
            </div>

            <!-- play/pause button and progress bar -->
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

            <!-- Add to Favorite button -->
            <div class="ms-2">
                <!-- Toggle Favorite button -->
                <form action='user-actions.php' method="post">
                    <input type="hidden" name="songID" id="favSongID">
                    <button type="submit" name="toggle-favorite" id="addToFavoriteBtn" class="btn btn-sm text-black">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>

            </div>

            <!-- Add to Playlist button in the music player -->
            <button id="addToPlaylistBtn" class="btn btn-sm text-black" data-bs-toggle="modal" data-bs-target="#addToPlaylistModal">
                <i class="fas fa-list-ul"></i>
            </button>

        </div>
    </div>



    <!-- Modal to add playlist -->


    <div class="modal fade" id="addToPlaylistModal" tabindex="-1" aria-labelledby="addToPlaylistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Add modal-dialog-centered class -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToPlaylistModalLabel">Add to Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="user-actions.php" method="post">
                        <!-- Hidden input to store the song info -->
                        <input type="hidden" id="songid" name="songID">
                        <input type="hidden" id="songName" name="songName">
                        <input type="hidden" id="artistName" name="artistName">
                        <!-- Dropdown for selecting the playlist -->
                        <div class="mb-3">
                            <label for="playlistSelect" class="form-label">Choose Playlist</label>
                            <select class="form-select" id="playlistSelect" name="playlistID">
                                <!-- Playlist options will be dynamically populated -->
                                <?php
                                $userID = $_SESSION['userid'];
                                $query = "SELECT * FROM playlists WHERE UserID = '$userID'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['PlaylistID'] . "'>" . $row['Name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="add-to-playlist-btn">Add to Playlist</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
    const audio = new Audio('');
    let isPlaying = false;
    let isMuted = false;

    // Play/Pause functionality
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

    // Volume toggle functionality
    document.getElementById('volumeBtn').addEventListener('click', () => {
        const volumeIcon = document.getElementById('volumeBtn').querySelector('i');
        if (isMuted) {
            audio.volume = 1.0; // Full volume
            volumeIcon.classList.remove('fa-volume-mute');
            volumeIcon.classList.add('fa-volume-up');
        } else {
            audio.volume = 0.0; // Mute
            volumeIcon.classList.remove('fa-volume-up');
            volumeIcon.classList.add('fa-volume-mute');
        }
        isMuted = !isMuted;
    });

    // Heart button color toggle
    document.getElementById('addToFavoriteBtn').addEventListener('click', () => {
        const heartIcon = document.getElementById('addToFavoriteBtn').querySelector('i');
        heartIcon.classList.toggle('active-heart');
    });

    // Update song progress
    audio.ontimeupdate = () => {
        const progress = (audio.currentTime / audio.duration) * 100;
        document.getElementById('songProgress').style.width = progress + '%';
    };

    // script to pass the song info

    document.getElementById('addToPlaylistBtn').addEventListener('click', () => {
        // Get the current song details from your player
        const songName = document.getElementById('songTitle').textContent;
        const artistName = document.getElementById('songArtist').textContent;
        const songID = document.getElementById('songID').getAttribute('value');

        // Set the values in the modal's hidden inputs
        document.getElementById('songName').value = songName;
        document.getElementById('artistName').value = artistName;
        document.getElementById('songid').value = songID;
    });
</script>

</html>
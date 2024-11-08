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
                <p class="song-title mb-0" id="songTitle">No track</p>
                <p class="song-artist mb-0" id="songArtist">Unknown</p>
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

            <!-- Add to Favorite button -->
            <div class="ms-2">
                <button id="addToFavoriteBtn" class="btn btn-sm text-black"><i class="fas fa-heart"></i></button>
            </div>

            <!-- Add to Playlist button -->
            <div class="ms-2">
                <button id="addToPlaylistBtn" class="btn btn-sm text-black"><i class="fas fa-list-ul"></i></button>
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
</script>

</html>
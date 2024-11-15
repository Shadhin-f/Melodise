<?php
include('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Page - MELODISE</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            /* padding: 40px; */
        }

        /* Top section */
        .artist-section {
            display: flex;
            gap: 40px;
            padding: 40px;
            align-items: flex-start;
            background: rgb(108, 224, 192);
            background: linear-gradient(126deg, rgba(108, 224, 192, 1) 0%, rgba(21, 48, 57, 1) 100%);
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .artist-image {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            /* background-image: url('../Resources/DesignElements/ProfileEditBack.jpg'); */
            background-size: cover;
            background-position: center;
        }

        .artist-info {
            flex: 1;
        }

        .artist-name {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .artist-bio {
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #fff;
        }

        .follow-button {
            border: 1px solid white;
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            padding: 4px 10px;
            background-color: transparent;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .follow-button:hover {
            background-color: #1B8673;
            color: white;
        }

        .info-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .info-button {
            font-size: 0.9rem;
            border: 1px solid #fff;
            padding: 6px 12px;
            border-radius: 20px;
            background-color: #fff;
            cursor: pointer;
        }

        /* Songs table */
        .songs-table-container {
            margin-top: 10px;
        }

        .songs-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .songs-table th,
        .songs-table td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .songs-table th {
            background-color: #1B8673;
            color: white;
        }

        .songs-table tr {
            transition: background-color 0.3s;
        }

        .songs-table tr:hover {
            background-color: #f1f1f1;
        }

        .add-to-playlist {
            color: #1B8673;
            cursor: pointer;
            transition: color 0.3s;
        }

        .add-to-playlist:hover {
            color: #0f5a42;
        }

        /* Albums section */
        .albums-section {
            margin-top: 10px;
        }

        .album-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: start;
        }

        .album-card {
            width: 180px;
            height: 180px;
            border-radius: 8px;
            overflow: hidden;
            background-image: url('../Resources/DesignElements/ProfileEditBack.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .album-card:hover {
            /* color: #1B8673; */
            background-color: rgba(0, 0, 0, 1);
        }

        .album-name {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            transition: all .3s;
        }

        .album-name:hover {
            color: #1B8673;
        }
    </style>
</head>

<body>

    <!-- Navbar -->


    <?php
    include('navbar.php')
    ?>

    <!-- Session Check -->

    <?php

    if (!isset($_SESSION['artistid'])) {
        echo '<script>
                    alert("Something went wrong!!!");
                    window.history.back();
            </script>';
    }
    // Query to get artist informtion from the database
    else {
        $artistID = $_SESSION['artistid'];
        if (isset($_SESSION['userid'])) {
            $userID = $_SESSION['userid'];
        }

        // Query to select artist information

        $select_artist_info = "SELECT * FROM `artists` WHERE ArtistID = '$artistID'";
        $result_artist_info = mysqli_query($conn, $select_artist_info);
        $artist_data = mysqli_fetch_assoc($result_artist_info);
        $artistName = $artist_data['Name'];
        $artistBio = $artist_data['Bio'];
        $artistCountry = $artist_data['Country'];
        $artistImage = $artist_data['Image'];


        // Query to Get follower count
        $select_follower_Count = "SELECT COUNT(ArtistID) AS TotalFollowers FROM artist_followers WHERE ArtistID = $artistID";
        $result_follower_Count = mysqli_query($conn, $select_follower_Count);
        $followerCount = mysqli_fetch_assoc($result_follower_Count);
        $totalFollowers = $followerCount['TotalFollowers'];



        // Query to Get album count
        $select_album_Count = "SELECT COUNT(AlbumID) as NumOFAlbum FROM albums WHERE ArtistID = '$artistID';";
        $result_album_Count = mysqli_query($conn, $select_album_Count);
        $albumCount = mysqli_fetch_assoc($result_album_Count);
        $totalAlbum = $albumCount['NumOFAlbum'];
    }

    ?>

    <!-- Artist Section -->
    <div class="artist-section p-5 mx-5">
        <div class="artist-image" style="background-image: url('../Resources/ArtistImges/<?php echo $artistImage; ?>');"> </div>
        <div class="artist-info">
            <div class="artist-name"><?php echo $artistName; ?></div>
            <p class="artist-bio"><?php echo $artistBio; ?></p>
            <!-- Follow button logic -->
            <?php
            if (!isset($_SESSION['userid'])) {
                // echo "<button class='follow-button' disabled>Follow</button>";
                echo "<P><i> Login to follow the artist </i></P>";
            } else {
                $follow_status_by_user = "SELECT * FROM `artist_followers` WHERE UserID = '$userID' AND ArtistID = '$artistID'";
                $result_follow_status_by_user = mysqli_query($conn, $follow_status_by_user);
                if ($result_follow_status_by_user) {
                    $followStatus = mysqli_num_rows($result_follow_status_by_user);
                    if ($followStatus > 0) {
                        echo "
                        <form action='user-actions.php' method='post'>
                        <button class='follow-button' name='unfollow-artist-btn'>Following</button>
                        </form>";
                    } else {
                        echo "
                        <form action='user-actions.php' method='post'>
                        <button class='follow-button' name='follow-artist-btn'>Follow</button>
                        </form>";
                    }
                }
            }
            ?>
            <div class="info-buttons">
                <div class="info-button"><?php echo $totalFollowers; ?> Followers</div>
                <div class="info-button"><?php echo $totalAlbum; ?> Album released</div>
                <div class="info-button"><?php echo $artistCountry; ?></div>
            </div>
        </div>
    </div>

    <!-- Songs Table -->
    <!-- Songs Table with Add to Playlist Button -->
    <div class="songs-table-container p-5">
        <h3 class="mb-2">Latest Releases</h3>
        <table class="songs-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Album</th>
                    <th>Add</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to get the latest songs of the artist
                $select_music_info = "SELECT songs.SongID AS SongID, songs.Title as SongTitle, albums.Title AS AlbumTitle, genres.Title AS GentraTitle 
                                      FROM `songs`
                                      LEFT JOIN albums ON songs.AlbumID = albums.AlbumID
                                      LEFT JOIN genres ON songs.GenreID = genres.GenreID
                                      WHERE songs.ArtistID = '$artistID' LIMIT 10;";
                $result_music_info = mysqli_query($conn, $select_music_info);
                $counter = 1;
                while ($music_data = mysqli_fetch_assoc($result_music_info)) {
                    $songID = $music_data['SongID'];
                    $songTitle = $music_data['SongTitle'];
                    $genre = $music_data['GentraTitle'];
                    $album = $music_data['AlbumTitle'];
                    echo "
                        <tr>
                            <td>$counter</td>
                            <td>$songTitle</td>
                            <td>$genre</td>
                            <td>$album</td>
                            <td>
                                <i class='fas fa-plus add-to-playlist' data-bs-toggle='modal' data-bs-target='#addToPlaylistModal' 
                                   data-song-id='$songID' data-song-title='$songTitle' data-artist-name='$artistName'></i>
                            </td>
                        </tr>
                    ";
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Albums Section -->
    <div class="albums-section p-5">
        <h3 class="mb-4">Albums</h3>
        <div class="album-cards">
            <!-- to display album cover -->
            <?php
            $select_artist_albums = "SELECT * 
                                            FROM `albums` 
                                            WHERE ArtistID = $artistID;";
            $result_artist_albums = mysqli_query($conn, $select_artist_albums);
            while ($albumData = mysqli_fetch_assoc($result_artist_albums)) {
                $albumName = $albumData['Title'];
                echo "
                    <div class='album-card'>
                        <div class='album-name'>$albumName</div>
                    </div>
                    ";
            }
            ?>
        </div>
    </div>



    <!-- ------------------ Footer sections-------------------------------- -->
    <?php
    // include('footer.php');
    ?>

    <!-- Add to Playlist Modal -->
    <div class="modal fade" id="addToPlaylistModal" tabindex="-1" aria-labelledby="addToPlaylistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToPlaylistModalLabel">Add to Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="user-actions.php" method="post">
                        <input type="hidden" id="songID" name="songID">
                        <input type="hidden" id="songName" name="songName">
                        <input type="hidden" id="artistName" name="artistName">
                        <div class="mb-3">
                            <label for="playlistSelect" class="form-label">Choose Playlist</label>
                            <select class="form-select" id="playlistSelect" name="playlistID">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript to handle modal and populate song details
        document.querySelectorAll('.add-to-playlist').forEach(button => {
            button.addEventListener('click', event => {
                const songID = event.currentTarget.getAttribute('data-song-id');
                const songTitle = event.currentTarget.getAttribute('data-song-title');
                const artistName = event.currentTarget.getAttribute('data-artist-name');

                document.getElementById('songID').value = songID;
                document.getElementById('songName').value = songTitle;
                document.getElementById('artistName').value = artistName;
            });
        });
    </script>
</body>

</html>
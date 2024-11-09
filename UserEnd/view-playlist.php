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
    <title>View Playlist</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom CSS */
        .header-btn {
            transition: color 0.3s ease;
        }

        .header-btn:hover {
            color: #0056b3;
            /* Subtle blue color */
        }

        .song-row {
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .song-row:hover {
            background-color: #f8f9fa;
            /* Light gray background on hover */
        }

        .play-btn,
        .remove-btn {
            background-color: transparent;
            border: none;
            color: black;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .play-btn:hover {
            color: #0056b3;
            /* Darker blue on hover */
        }

        .remove-btn:hover {
            color: tomato;
        }



        .page-container {
            padding: 1rem 3rem;
            /* p-3 around the page */
        }

        .table {
            width: 100%;
            /* Full width table */
        }

        .table th,
        .table td {
            border-top: none;
            /* Remove table borders for a minimal look */
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navigation bar -->

    <?php
    include('navbar.php')
    ?>

    <?php
    if (!isset($_SESSION['userid'])) {
        echo '<script>
                        alert("can not access this page without login!!!");
                        window.location.href = "login.php";
                    </script>';
    }
    ?>



    <!-- Page Container -->
    <div class="page-container">
        <!-- Header Section -->
        <section id="section-header" class="d-flex align-items-center justify-content-between mb-4">
            <!-- Left Section: Back Button and Playlist Name -->
            <div class="d-flex align-items-center">
                <!-- Back Button -->
                <form action="user-actions.php" method="get" class="d-inline-block">
                    <button type="submit" class="header-btn bg-transparent border-0 me-3" name="back-to-home-btn">
                        <i class="fa-solid fa-arrow-left h1"></i>
                    </button>
                </form>
                <!-- Playlist Name -->
                <h1 class="d-inline-block mb-0"><?php echo $_SESSION['playlistname'] ?></h1>
            </div>

            <!-- Right Section: Delete Playlist Button -->
            <form action="user-actions.php" method="post" class="d-inline-block">
                <input type="hidden" name="playlistID" value="<!-- Your playlist ID here -->">
                <button type="submit" class="header-btn bg-transparent border-0 text-danger" name='delete-playlist-btn' onclick="return confirmDelete()">
                    Delete Playlist
                </button>
            </form>
        </section>

        <!-- Songs Table -->
        <div class="container-fluid">
            <table class="table bg-white shadow-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Song</th>
                        <th scope="col">Artist</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows -->
                    <?php
                    $playlistID = $_SESSION['playlistid'];
                    // $playlistID = $_SESSION['playlistID'];
                    $select_playlist_songs = "SELECT songs.SongID, songs.Title, artists.Name
                                                  FROM playlist_songs
                                                  LEFT JOIN songs ON playlist_songs.SongID = songs.SongID
                                                  LEFT JOIN artists ON songs.ArtistID = artists.ArtistID
                                                  WHERE PlaylistID = '$playlistID';";
                    $result_playlist_songs = mysqli_query($conn, $select_playlist_songs);
                    $serialNumber = 1;
                    while ($row_data = mysqli_fetch_assoc($result_playlist_songs)) {
                        $songID = $row_data['SongID'];
                        $songName = $row_data['Title'];
                        $artistName = $row_data['Name'];
                        echo "
                                <tr class='song-row'>
                                    <td>$serialNumber</td>
                                    <td>
                                        <button class='play-btn me-2'>
                                            <i class='fa-solid fa-play'></i>
                                        </button> $songName
                                    </td>
                                    <td>$artistName</td>
                                    <td>
                                    <form action='user-actions.php' method='POST'>
                                        <input type='hidden' name='songID' value='$songID'>
                                        <button type='submit' class='remove-btn me-2' name='remove-song-btn'>
                                            <i class='fa-solid fa-minus'></i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            ";
                        $serialNumber++;
                    }
                    ?>
                    <!-- Add more song rows dynamically with PHP -->
                </tbody>
            </table>
        </div>
    </div>
    <?php
    include('music-player.php')
    ?>



    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this playlist?");
        }
    </script>

    <script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</body>

</html>
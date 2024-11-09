<?php
// Include the database connection file
include('connect.php');

// Assuming you have the artist's ID or name to fetch the profile
$artist_name = 'Billie Eilish';  // Replace with dynamic value if needed

// Query to get artist details from the database
$select_artist = "SELECT * FROM `artists` WHERE `Name` = '$artist_name'";
$result_artist = mysqli_query($conn, $select_artist);
$artist_data = mysqli_fetch_assoc($result_artist);

if ($artist_data) {
    $artist_id = $artist_data['ArtistID'];
    $artist_image = $artist_data['Image'];  // Assuming you have an image field in the database
    $artist_bio = $artist_data['Bio'];  // Assuming you have a Bio field in the database
    $artist_name = $artist_data['Name'];
} else {
    echo "Artist not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $artist_name; ?> - Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
        }

        .bio-text {
            font-size: 1.2rem;
            color: #555;
        }

        .songs-list {
            margin-top: 20px;
        }

        .song-card {
            width: 15rem;
        }

        .song-card img {
            object-fit: cover;
            height: 12rem;
        }

        .song-card-body {
            text-align: center;
        }

        .song-btn {
            background-color: #1B8673;
            color: white;
            border: none;
        }

        .song-btn:hover {
            background-color: #155d47;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <?php include('tanveer-testNavbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Artist Info Section -->
            <div class="col-md-4 text-center">
                <!-- Check if the image exists in the directory -->
                <img src="uploads/<?php echo $artist_image ? $artist_image : 'default.jpg'; ?>" alt="Artist Image" class="profile-img">
                <h2><?php echo $artist_name; ?></h2>
                <p class="bio-text"><?php echo nl2br($artist_bio); ?></p>
            </div>

            <!-- Artist Songs Section -->
            <div class="col-md-8">
                <h3>Top Songs</h3>
                <div class="row songs-list">
                    <?php
                    // Query to get the artist's top 5 songs
                    $select_songs = "SELECT * FROM `songs` WHERE `ArtistID` = $artist_id LIMIT 5";
                    $result_songs = mysqli_query($conn, $select_songs);

                    // Loop through and display each song
                    while ($row_data = mysqli_fetch_assoc($result_songs)) {
                        $song_name = $row_data['Title'];
                        $audio = $row_data['Audio'];
                    ?>
                        <div class="col-md-4">
                            <div class="card song-card">
                                <img class="card-img-top" src="https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg" alt="Song image">
                                <div class="card-body song-card-body">
                                    <h5 class="card-title"><?php echo $song_name; ?></h5>
                                    <a href="resources/songs/<?php echo $audio; ?>" class="btn song-btn" target="_blank">Play</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p>&copy; 2024 Music Platform. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

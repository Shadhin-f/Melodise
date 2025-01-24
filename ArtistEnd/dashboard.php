<?php
session_start();
include('connect.php');

// Check if artist is logged in
if (!isset($_SESSION['artistid'])) {
    echo '<script>
                alert("Something went wrong!!!");
                window.history.back();
        </script>';
} else {
    $artistID = $_SESSION['artistid'];

    // Query to get artist information
    $select_artist_info = "SELECT * FROM `artists` WHERE ArtistID = '$artistID'";
    $result_artist_info = mysqli_query($conn, $select_artist_info);
    $artist_data = mysqli_fetch_assoc($result_artist_info);
    $artistName = $artist_data['Name'];
    $artistBio = $artist_data['Bio'];
    $artistCountry = $artist_data['Country'];
    $artistImage = $artist_data['Image'];

    // Query to get follower count
    $select_follower_Count = "SELECT COUNT(ArtistID) AS TotalFollowers FROM artist_followers WHERE ArtistID = $artistID";
    $result_follower_Count = mysqli_query($conn, $select_follower_Count);
    $followerCount = mysqli_fetch_assoc($result_follower_Count);
    $totalFollowers = $followerCount['TotalFollowers'];

    // Query to get album count
    $select_album_Count = "SELECT COUNT(AlbumID) as NumOFAlbum FROM albums WHERE ArtistID = '$artistID';";
    $result_album_Count = mysqli_query($conn, $select_album_Count);
    $albumCount = mysqli_fetch_assoc($result_album_Count);
    $totalAlbum = $albumCount['NumOFAlbum'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Dashboard</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (for Play Icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Artist Section Styling */
        .artist-section {
            display: flex;
            gap: 40px;
            padding: 40px;
            align-items: flex-start;
            background: linear-gradient(126deg, rgba(108, 192, 224, 1) 0%, rgba(21, 48, 57, 1) 100%);
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

        .edit-button {
            border: 1px solid #ff4d4d;
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            padding: 4px 10px;
            background-color: transparent;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .edit-button:hover {
            background-color: #ff4d4d;
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

        /* Logout button styling */
        .logout-btn {
            position: absolute;
            right: 110px;
            top: 60px;
            color: #ff4d4d;
            font-weight: bold;
            text-decoration: none;
        }

        .logout-btn:hover {
            color: #ff3333;
        }

        /* Dashboard Grid */
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* Three columns */
            gap: 20px;
            align-items: end;
            /* Align items to the bottom */
        }

        /* Section Card Styling */
        .section-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            /* Adds smooth transition */
        }

        .section-card:hover {
            transform: translateY(-5px);
            /* Moves the card up by 5px when hovered */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            /* Increases shadow on hover */
        }

        /* Your Song and Your Album span more columns */
        .song-card {
            grid-column: span 1.5;
            /* Spans 1.5 columns */
        }

        .album-card {
            grid-column: span 1.5;
            /* Spans 1.5 columns */
        }

        .upcoming-events-card {
            grid-column: span 1;
            /* Spans 1 column */
        }

        /* Section Title Styling */
        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Card Body Styling */
        .card-body {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Button Styling */
        .view-all-btn {
            background-color: #1B8673;
            color: white;
            padding: 6px 20px;
            border-radius: 30px;
            text-align: center;
            align-self: flex-end;
            text-decoration: none;
        }

        .view-all-btn:hover {
            background-color: #145a50;
        }

        .plus-btn {
            font-size: 2rem;
            font-weight: bold;
            color: #1B8673;
            cursor: pointer;
            align-self: flex-start;
        }

        /* tanveer Section Your song Card Styling */

        /* Your Song Section Styling */
        .section-card {
            background-color: #f8f9fa;
            /* Subtle background for the card */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Soft shadow for depth */
            padding: 20px;
            margin: 20px 0;
        }

        .card-body {
            padding: 10px 0;
        }

        .song-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .song-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .song-item:last-child {
            border-bottom: none;
        }

        .song-item:hover {
            background-color: #f1f1f1;
        }

        .song-title {
            font-size: 1.1em;
            color: #333;
            font-weight: 500;
        }

        .album-title {
            font-size: 1.1em;
            color: #333;
            font-weight: 500;
        }


    </style>

    </styl>
</head>

<body>

    <!-- Artist Section -->
    <div class="artist-section p-5 mx-5">
        <div class="artist-image" style="background-image: url('../Resources/ArtistImges/<?php echo $artistImage; ?>');"></div>
        <div class="artist-info">
            <div class="artist-name"><?php echo $artistName; ?></div>
            <p class="artist-bio"><?php echo $artistBio; ?></p>
            <form action='artistActions.php' method='post'>
                <input type='hidden' name='artist_id' value="<?php echo htmlspecialchars($artistID); ?>">
                <button type='submit' class='edit-button' name='edit-artist-btn'>Edit Profile</button>
            </form>

            <div class="info-buttons">
                <div class="info-button"><?php echo $totalFollowers; ?> Followers</div>
                <div class="info-button"><?php echo $totalAlbum; ?> Album released</div>
                <div class="info-button"><?php echo $artistCountry; ?></div>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <a href="artistlogin.php" class="logout-btn">LOGOUT</a>

    <!-- Dashboard Grid -->
    <div class="dashboard-container mx-5">


        <!-- Your Songs Section -->
        <div class="section-card song-card">
            <div class="section-title">Your Songs</div>
            <div class="card-body">
                <div class="song-list">
                    <?php
                    // Fetch the artist ID from the session
                    $artistID = $_SESSION['artistid'];

                    // Fetch up to 4 songs by the artist
                    $select_songs = "SELECT Title, Audio FROM `songs` WHERE `ArtistID` = '$artistID' ORDER BY Title LIMIT 4";
                    $result_songs = mysqli_query($conn, $select_songs);

                    if ($result_songs && mysqli_num_rows($result_songs) > 0) {
                        while ($row_data = mysqli_fetch_assoc($result_songs)) {
                            $song_name = htmlspecialchars($row_data['Title']); // Sanitize output
                            $audio = htmlspecialchars($row_data['Audio']); // Sanitize the audio file path

                            echo "
                        <div class='song-item'>
                            <span class='song-title'>$song_name</span>
                        </div>
                    ";
                        }
                    } else {
                        echo "<div class='song-item'>No songs found.</div>";
                    }
                    ?>
                </div>
                <!-- <a href="#" class="text-decoration-none themed-btn">View All</a> -->
                <form action="artistActions.php" method="get">
                    <button type="submit" class="btn btn-primary btn-lg shadow-lg px-4 py-1" name="view-all-music-btn">View All</button>
                </form>

            </div>
        </div>






        <!-- Your Album Section -->


        <div class="section-card album-card">
            <div class="section-title">Your Albums</div>
            <div class="card-body">
                <div class="album-list">
                    <?php
                    // Fetch the artist ID from the session
                    $artistID = $_SESSION['artistid'];

                    // Fetch up to 4 albums by the artist
                    $select_albums = "SELECT Title FROM `albums` WHERE `ArtistID` = '$artistID' ORDER BY Title LIMIT 4";
                    $result_albums = mysqli_query($conn, $select_albums);

                    if ($result_albums && mysqli_num_rows($result_albums) > 0) {
                        while ($row_data = mysqli_fetch_assoc($result_albums)) {
                            $album_name = htmlspecialchars($row_data['Title']); // Sanitize output

                            echo "
                        <div class='album-item'>
                            <span class='album-title'>$album_name</span>
                        </div>
                    ";
                        }
                    } else {
                        echo "<div class='album-item'>No albums found.</div>";
                    }
                    ?>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <form action="artistActions.php" method="get" class="d-inline-block">
                        <button type="submit" class="btn btn-primary btn-lg shadow-lg px-2 py-1" name="view-all-album-btn">View All</button>
                    </form>

<!--
                    <form action="addAlbum.php" method="get" class="d-inline-block">
                        <button type="submit" class="btn btn-success btn-lg shadow-lg px-4 py-1" name="add-album-btn">Add Album</button>
                    </form>

                    <form action="deleteAlbum.php" method="get" class="d-inline-block">
                        <button type="submit" class="btn btn-danger btn-lg shadow-lg px-4 py-1" name="delete-album-btn">Delete Album</button>
                    </form>
-->

                </div>
            </div>
        </div>

       

       <!-- Upcoming Events Section -->
<div class="section-card upcoming-events-card">
    <div class="section-title">Upcoming Events</div>
    <div class="card-body">
        <div class="event-list">
            <?php
            // Fetch upcoming events for the artist
            $select_events = "SELECT EventTitle, EventDate, EventLocation FROM `upcoming_events` WHERE `ArtistID` = '$artistID' ORDER BY EventDate LIMIT 3";
            $result_events = mysqli_query($conn, $select_events);

            if ($result_events && mysqli_num_rows($result_events) > 0) {
                while ($row_event = mysqli_fetch_assoc($result_events)) {
                    $eventTitle = htmlspecialchars($row_event['EventTitle']);
                    $eventDate = htmlspecialchars($row_event['EventDate']);
                    $eventLocation = htmlspecialchars($row_event['EventLocation']);

                    echo "
                    <div class='event-item'>
                        <div class='event-title'>$eventTitle</div>
                        <div class='event-date'>$eventDate</div>
                        <div class='event-location'>$eventLocation</div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='event-item'>No upcoming events found.</div>";
            }
            ?>
        </div>
        <div class="button-group">
            <a href="addEvent.php" class="btn btn-primary btn-lg shadow-lg px-4 py-1">Add Event</a>
            <a href="viewEvents.php" class="btn btn-secondary btn-lg shadow-lg px-4 py-1">View All</a>
        </div>
    </div>
</div>





        </div>


        <!-- Music Play graph -->


<?php 

include('musicPlay.php')

?>
</body>

</html>
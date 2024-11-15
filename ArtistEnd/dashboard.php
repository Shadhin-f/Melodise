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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            right: 80px;
            top: 20px;
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
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 20px;
            align-items: end; /* Align items to the bottom */
        }

        /* Section Card Styling */
        .section-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Your Song and Your Album span more columns */
        .song-card {
            grid-column: span 1.5; /* Spans 1.5 columns */
        }

        .album-card {
            grid-column: span 1.5; /* Spans 1.5 columns */
        }

        .insights-card {
            grid-column: span 1; /* Spans 1 column */
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

        /* Centered Upcoming Events Card */
        .dashboard-container2 {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Three columns */
            gap: 20px;
        }

        /* Section Card Styling */
        .section-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .empty1-card {
            grid-column: span 1; /* Spans 1 column */
        }

        .upcoming-events-card {
            grid-column: span 3; /* Spans 2 columns */
        }

        .empty2-card {
            grid-column: span 1; /* Spans 1 column */
        }

    </style>
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
    <!-- Your Song Section -->
    <div class="section-card song-card">
        <div class="section-title">Your Song</div>
        <div class="card-body">
            <div class="plus-btn">+</div>
            <p>Your latest tracks and music releases go here.</p>
            <a href="#" class="view-all-btn">View All</a>
        </div>
    </div>

    <!-- Your Album Section -->
    <div class="section-card album-card">
        <div class="section-title">Your Album</div>
        <div class="card-body">
            <div class="plus-btn">+</div>
            <p>Your album details and releases go here.</p>
            <a href="#" class="view-all-btn">View All</a>
        </div>
    </div>

    <!-- Performance Insights Section -->
    <div class="section-card insights-card">
        <div class="section-title">Performance Insights</div>
        <div class="card-body">
            <p>Track your performance and analytics here.</p>
        </div>
    </div>

    <!-- Empty -->
    <div class="section-card .empty1-card">
    </div>

    <!-- Upcoming Events -->
    <div class="section-card .upcoming-events-card">
        <div class="section-title">Upcoming Events</div>
        <div class="card-body">
            <div class="plus-btn">+</div>
            <a href="#" class="view-all-btn">View All</a>
        </div>
    </div>
</div>

</body>
</html>

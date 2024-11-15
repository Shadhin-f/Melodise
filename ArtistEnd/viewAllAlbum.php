<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Albums</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #card-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .card {
            width: 17rem;
        }

        .card img {
            width: 100%;
            height: 8rem;
            object-fit: cover;
        }

        .play-btn-back {
            bottom: 0.5rem;
            right: 0.5rem;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

<!-- Navigation Bar -->
<?php include('artistNavbar.php'); ?>
    <!-- Header Section -->
    <section id="section-header" class="px-5 my-5">
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0 ml-5" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="ml-5 d-inline-block">All Albums</h1>
    </section>

    <!-- Album Cards Section -->
    <section>
        <div id="card-container" class="d-flex flex-wrap gap-4 mt-4 px-3 mx-auto justify-content-center">
            <?php
            // Fetch the artist ID from the session
            $artistID = $_SESSION['artistid'];

            // Query to fetch albums
            $select_albums = "SELECT Title, AlbumCover FROM `albums` WHERE `ArtistID` = '$artistID' ORDER BY Title";
            $result_albums = mysqli_query($conn, $select_albums);

            if ($result_albums && mysqli_num_rows($result_albums) > 0) {
                while ($row_data = mysqli_fetch_assoc($result_albums)) {
                    $album_name = htmlspecialchars($row_data['Title']); // Sanitize output
                    $album_cover = $row_data['AlbumCover'] ?: 'default-album-cover.jpg'; // Default image if not provided
                    $album_cover_path = "../Resources/AlbumCovers/$album_cover";

                    echo "
                    <div class='card' style='width: 17rem;'>
                    <img 
                        class='card-img-top' 
                        src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996' 
                        alt='Album Art' 
                        style='width: 100%; height: 12rem; object-fit: cover;'
                    >
                        <div class='card-body position-relative'>
                            <h5 class='card-title'>$album_name</h5>
                            
                            <a 
            href='songsPage.php?album=$album_name' 
            class='btn btn-primary position-absolute bottom-0 end-0 m-3' 
            style='z-index: 1;'
        >
            Songs
        </a>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='text-center'><h5>No albums found.</h5></div>";
            }
            ?>
        </div>
    </section>

</body>

<!-- FontAwesome Icons -->
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
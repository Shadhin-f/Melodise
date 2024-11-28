<?php
include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Albums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #card-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        .card {
            position: relative;
            width: 17rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }

        .card-body {
            text-align: left;
            position: relative;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.2rem;
            word-wrap: break-word;
            margin-bottom: 1rem;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <?php include('artistNavbar.php'); ?>

    <section id="section-header" class="px-5 my-5 d-flex justify-content-between align-items-center">
        <form action="artistActions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0" name="back-to-dashboard-btn">
                <i class="fa-solid fa-arrow-left h1"></i>
            </button>
        </form>
        <h1 class="d-inline-block">All Albums</h1>
        <a href="addAlbum.php" class="btn btn-primary">Add Album</a>
    </section>

    <section>
        <div id="card-container" class="d-flex flex-wrap gap-4 mt-4 px-3 mx-auto justify-content-center">
            <?php
            $artistID = $_SESSION['artistid'];
            $select_albums = "SELECT AlbumID, Title, AlbumCover FROM `albums` WHERE `ArtistID` = '$artistID' ORDER BY Title";
            $result_albums = mysqli_query($conn, $select_albums);

            if ($result_albums && mysqli_num_rows($result_albums) > 0) {
                while ($row_data = mysqli_fetch_assoc($result_albums)) {
                    $album_id = $row_data['AlbumID'];
                    $album_name = htmlspecialchars($row_data['Title']);
                    $album_cover = $row_data['AlbumCover'] ?: 'default-album-cover.jpg';
                    $album_cover_path = "../Resources/AlbumCovers/$album_cover";

                    echo "
                    <div class='card'>
                        <img class='card-img-top' src='$album_cover_path' alt='Album Art'>
                        <div class='card-body'>
                            <h5 class='card-title'>$album_name</h5>
                            <div class='btn-container'>
                                <a href='albumSongs.php?album=$album_id' class='btn btn-primary'>
                                    Songs
                                </a>
                                <a href='editAlbum.php?albumID=$album_id' class='btn btn-edit'>
                                    Edit
                                </a>
                            </div>
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
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>
</html>

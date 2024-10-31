<?php
include('connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Music</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Navigation bar -->

    <?php
    include('navbar.php')
    ?>

    <!-- Main Section -->


    <section id="section-header" class="px-5 my-5">
        <form action="user-actions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0 ml-5" name='back-to-home-btn'><i class="fa-solid fa-arrow-left h1"></i></button>
        </form>
        <h1 class='ml-5 d-inline-block'>All music</h1>
    </section>
    <section class="all-music-container px-5">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Song</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Genre</th>
                    <th scope="col"></th>
                </tr>
                <thead>
                <tbody>


                    <?php
                    $select_songs = "SELECT * FROM `songs` ORDER BY Title";                                            // query for selecting all songs
                    $result_songs = mysqli_query($conn, $select_songs);


                    while ($row_data = mysqli_fetch_assoc($result_songs)) {                              // loop to fetch all songs
                        $song_name = $row_data['Title'];
                        $genre_id = $row_data['GenreID'];                                              // Getting the Song name
                        $color_code = $row_data['ColorCode'];                                          // Getting the color code
                        $artist_id = $row_data['ArtistID'];                                            // Getting artist id
                        /* Artist information */
                        $select_artist_name = "SELECT * FROM `artists` WHERE ArtistID = $artist_id";   // query for selecting artist name
                        $result_artist_name = mysqli_query($conn, $select_artist_name);
                        $artist_data = mysqli_fetch_assoc($result_artist_name);
                        $artist_name = $artist_data['Name'];
                        /* genre information */
                        $select_genre = "SELECT * FROM `genres` WHERE GenreID = $genre_id";            // Query For Genre Data
                        $result_genre = mysqli_query($conn, $select_genre);
                        $genre_data = mysqli_fetch_assoc($result_genre);
                        $genre_title = $genre_data['Title'];
                        echo "
                <tr>
                    <td>$song_name</td>
                    <td>$artist_name</td>
                    <td>$genre_title</td>
                    <td><i class='fa-solid fa-play .play-btn' style='color: $color_code;'></i></td>
                </tr>
                ";
                        // <div class='music-container d-flex justify-content-evenly align-items-center p-2'> 
                        //         <p class='d-inline-block font-weight-bold music-element'>$song_name</p>
                        //         <p class='d-inline-block music-element'>$artist_name</p>
                        //         <p class='d-inline-block music-element'>$genre</p>
                        //         <i class='fa-solid fa-play'></i>
                        // </div>
                    }
                    ?>
                </tbody>
        </table>
    </section>
</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
<?php 
// session_start();
include('connect.php')
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
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

    <!-- My Music Section -->


    <section id="my-music" class="p-3">
        <!-- Title -->
        <div id="your-music-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Top picks</h1>  
            <!-- <a href="#" class="text-decoration-none themed-btn">All Music</a> -->
             <form action="user-actions.php" method="get">
                 <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>All Music</button>
             </form>
        </div>
        <!-- Music Cards -->
        <div id="card-container">
            <!-- Fetching Music data from mysql server -->
            <?php 
                $select_songs = "SELECT * FROM `songs` ORDER BY RAND() LIMIT 10";                   // query for selecting all songs
                $result_songs = mysqli_query($conn, $select_songs);
                
                // loop to fetch all songs
                while($row_data = mysqli_fetch_assoc($result_songs)){
                    $song_name = $row_data['Title'];                                               // Getting the Song name
                    $color_code = $row_data['ColorCode'];                                          // Getting the Song name
                    $artist_id = $row_data['ArtistID'];                                            // Getting artist id
                    // echo ($artist_id);                                                          // for testting purpose
                    $select_artist_name = "SELECT * FROM `artists` WHERE ArtistID = $artist_id";   // query for selecting artist name
                    $result_artist_name = mysqli_query($conn, $select_artist_name);
                    $artist_data = mysqli_fetch_assoc($result_artist_name);
                    $artist_name = $artist_data['Name'];

                    echo "<div class='card mx-3 mt-3 d-inline-block shadow' style='width: 18rem; background-color: $color_code'>
                                <div class='card-body position-relative p-3'>
                                    <h5 class='card-title mt-4 font-weight-bold'>$song_name</h5>
                                    <p class='card-text font-weight-light'>$artist_name</p>
                                    <p class='play-btn-back position-absolute bottom-0 end-0 rounded-circle bg-dark text-white play-btn'><i class='fa-solid fa-play p-3'></i></p>
                                </div>
                            </div>";
                }
                
                
            ?>
        </div>
    </section>


    <!-- Artist Section -->


    <section id="top-artist" class="p-3">
        <div id="top-artist-title-container" class="d-flex flex-row justify-content-between align-items-center">
            <h1>Top Artists</h1>  
             <form action="user-actions.php" method="get">
                 <button type="submit" class="themed-btn bg-transparent border-0" name='all-artist-btn'>All Artist</button>
             </form>
        </div>
        <!-- Artist Cards -->
        <div id="artist-card-container">
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
            <div class="artist-card mx-3 mt-3 d-inline-block" style='width: 12rem;'>
                <div class="artist-img-circle mx-auto rounded-circle mt-2" style="width: 10rem; height: 10rem; background-image: url('../Resources/ArtistImges/Arijit_Singh.jpg'); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;"></div>
                <p class="d-block text-center artist-name mx-auto mt-2 w-auto">Arijit Singh</p>
            </div>
        </div>

    </section>
</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
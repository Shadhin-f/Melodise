<?php
include('connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Artists</title>
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

    <!-- Main body -->

    <!-- Page Title / header -->
    <section id="section-header" class="px-5 my-5">
        <form action="user-actions.php" method="get" class="d-inline-block">
            <button type="submit" class="themed-btn bg-transparent border-0 ml-5" name='back-to-home-btn'><i class="fa-solid fa-arrow-left h1"></i></button>
        </form>
        <h1 class='ml-5 d-inline-block'>All Artists</h1>
    </section>


    <!-- All artists cards section -->

    <section class="all-artist-container px-5">


        <?php

        //  Fetching artists data from database


        $select_artists = "SELECT * FROM `artists`";                   // query for selecting all songs
        $result_artists = mysqli_query($conn, $select_artists);

        while ($row_data = mysqli_fetch_assoc($result_artists)) {
            $artist_name = $row_data['Name'];
            $artist_img = $row_data['Image'];

            // Artists cards

            echo "
                <div class='artist-card mx-3 mt-3 d-inline-block' style='width: 12rem;'>
                    <div class='artist-img-circle mx-auto rounded-circle mt-2' style='width: 10rem; height: 10rem; background-image: url(\"../Resources/ArtistImges/$artist_img\"); background-color:antiquewhite; background-repeat: no-repeat; background-size: cover;'></div>
                    <p class='d-block text-center artist-name mx-auto mt-2 w-auto'>$artist_name</p>
                </div>
            ";
        }


        ?>

        <!--  

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
        -->
    </section>
</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
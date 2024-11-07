<?php
include('connect.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Home</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
</head>

<body>
    <!-- Tanveer -->

    <!-- Navigation bar -->

    <?php
    include('navbar.php')
    ?>

    <!-- Your Releases Section -->

    <section id='master-control' class='p-3'>
        <!-- Title -->
        
        <div id='master-control-title-container' class='d-flex flex-row justify-content-between align-items-center '>
            <h1>Your Releases</h1>  

            <!-- <a href="#" class="text-decoration-none themed-btn">View All</a> -->
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>View All</button>
            </form>
        </div>
        
        
        <!-- Your Releases Cards -->

        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>


            <!-- Update Music Card -->
            
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Tum Hi Ho</h5>
                    <p class='card-text'>Arijit Singh</p>
                    <a href='#' class='btn btn-primary'>Play</a>
                </div>
            </div>

            <!-- Update Music Card -->
            
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Channa Mereya</h5>
                    <p class='card-text'>Arijit Singh</p>
                    <a href='#' class='btn btn-primary'>Play</a>
                </div>
            </div>

            <!-- Update Music Card -->
            
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Phir Bhi Tumko Chaahunga</h5>
                    <p class='card-text'>Arijit Singh</p>
                    <a href='#' class='btn btn-primary'>Play</a>
                </div>
            </div>

            <!-- Update Music Card -->
            
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Gerua</h5>
                    <p class='card-text'>Arijit Singh</p>
                    <a href='#' class='btn btn-primary'>Play</a>
                </div>
            </div>

            <!-- Update Music Card -->
            
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Tera Yaar Hoon Main</h5>
                    <p class='card-text'>Arijit Singh</p>
                    <a href='#' class='btn btn-primary'>Play</a>
                </div>
            </div>

        </div>
        
    </section>
    




    <!-- Badhon -->


        <!-- Your Albums Section -->


        <section id='master-control' class='p-3'>


        <!-- Title -->


        <div id='master-control-title-container' class='d-flex flex-row justify-content-between align-items-center '>
            <h1>Your Albums</h1>

            <!-- <a href="#" class="text-decoration-none themed-btn">Add New Album</a> -->
            <form action="user-actions.php" method="get">
                <button type="submit" class="themed-btn bg-transparent border-0" name='all-music-btn'>Add New Album</button>
            </form>
        </div>


        <!-- Your Releases Cards -->


                <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>


            <!-- Update Music Card -->


            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://upload.wikimedia.org/wikipedia/en/f/ff/Tum_Hi_Ho_cover.jpeg'  style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'> <a href='#' class='btn btn-primary'>Tum Hi Ho</a> </h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>

            <!-- Update Music Card -->


            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'><a href='#' class='btn btn-primary'>Channa Mereya</a></h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>

            <!-- Update Music Card -->


            <div class='card' style='width: 15rem; '>
                <img class='card-img-top' src='https://upload.wikimedia.org/wikipedia/en/8/89/Gerua_cover.jpg'  style='width: 15rem; height: 15rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'><a href='#' class='btn btn-primary'>Gerua</a></h5>
                    <p class='card-text'>Arijit Singh</p>
                </div>
            </div>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
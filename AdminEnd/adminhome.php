<?php 
// session_start();
include('connect.php')
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">

    <style>
        .access {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.85);
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            max-width: 300px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .container h1{
            color: red;
        }
        .text-primary-custom {
            color: #1B8673;
        }
        .btn-custom {
            background-color: #1B8673;
            color: white;
            border-radius: 50px;
        }
        .btn-custom:hover {
            background-color: #145a50;
        }

        /* Table container styling */
        .table-container {
            background: rgba(255, 255, 255, 0.85);
            border: 2px solid #1B8673;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }
                /* Table header styling */
        .table-custom thead th {
            background-color: #1B8673 ;
            color: white;
        }

        /* Alternate row colors */
        .table-custom tbody tr:nth-child(odd) {
            background-color: rgba(27, 134, 115, 0.1) !important;
        }
        .table-custom tbody tr:nth-child(even) {
            background-color: rgba(27, 134, 115, 0.2) !important;
        }

                
        /* Header and Title Styling */
        .text-primary-custom {
            color: #1B8673;
        }

    </style>

</head>




<body>
    <!-- Navigation bar -->

    <?php 
        include('navbar.php')
    ?>


<!-- Admin Session Check-->
<?php 
    if(isset($_SESSION['adminname'])) {

        // query for counting total users 
        $select_users_count = "SELECT count(*) as user_count FROM `users`";                   
        $result_users_count = mysqli_query($conn, $select_users_count);
        $user_count = mysqli_fetch_assoc($result_users_count);

        
        // query for counting premium users
        
        $select_premium_user_count = "SELECT count(*) as premium_count FROM `subscription_records` where CURDATE()<= EndDate";                   // query for selecting all songs
        $result_premiumusers_count = mysqli_query($conn, $select_premium_user_count);
        $premium_count = mysqli_fetch_assoc($result_premiumusers_count);
        
        // query for counting free users
        $count_free_users = $user_count['user_count'] - $premium_count['premium_count'];

        // query for finding revenue
        // query for counting total music released
        $select_song_count = "SELECT count(*) as songs_count FROM `songs`";                   
        $result_song_count = mysqli_query($conn, $select_song_count);
        $song_count = mysqli_fetch_assoc($result_song_count);

        // query for counting total artists
        $select_artist_count = "SELECT count(*) as artist_count FROM `artists`";                   
        $result_artist_count = mysqli_query($conn, $select_artist_count);
        $artist_count = mysqli_fetch_assoc($result_artist_count);

        // query for counting total playlists created
        $select_playlist_count = "SELECT count(*) as playlist_count FROM `playlists`";                   
        $result_playlist_count = mysqli_query($conn, $select_playlist_count);
        $playlist_count = mysqli_fetch_assoc($result_playlist_count);

        // query for counting total albums released
        $select_albums_count = "SELECT count(*) as albums_count FROM `albums`";                   
        $result_albums_count = mysqli_query($conn, $select_albums_count);
        $albums_count = mysqli_fetch_assoc($result_albums_count);


        echo "
        <!-- tableeeeeeeeeeeeeeeee -->


<section>
<div class='container my-5 table-container'>
    <h2 class='text-center mb-4 text-primary-custom'>Subscription Details</h2>
    <table class='table table-bordered table-hover table-custom'>
        <thead>
            <tr>
                <th scope='col'>Username</th>
                <th scope='col'>Transaction ID</th>
                <th scope='col'>Package Name</th>
                <th scope='col'>Subscription Ends</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>john_doe</td>
                <td>TX12345</td>
                <td>Premium</td>
                <td>2024-11-05</td>
            </tr>
            <tr>
                <td>jane_smith</td>
                <td>TX12346</td>
                <td>Basic</td>
                <td>2024-10-30</td>
            </tr>
            <tr>
                <td>alex_jones</td>
                <td>TX12347</td>
                <td>Standard</td>
                <td>2024-12-15</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>
</section>

        <section>

        <!-- Analysis Cards -->
        <div class='container mt-5'>
            <div class='row'>
                <!-- Card 1 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Total Users</h5>
                            <p class='card-text'>{$user_count['user_count']}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Free Users</h5>
                            <p class='card-text'>$count_free_users</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Premium Users</h5>
                            <p class='card-text'>{$premium_count['premium_count']}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Revenue</h5>
                            <p class='card-text'>900</p>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Music Released</h5>
                            <p class='card-text'>{$song_count['songs_count']}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Total Artists</h5>
                            <p class='card-text'>{$artist_count['artist_count']}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Playlists Created</h5>
                            <p class='card-text'>{$playlist_count['playlist_count']}</p>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class='col-md-3 col-sm-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>Albums</h5>
                            <p class='card-text'>{$albums_count['albums_count']}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    <!-- Master Control Section -->

    <section id='master-control' class='p-3'>
        <!-- Title -->
        <div id='master-control-title-container' class='d-flex flex-row justify-content-between align-items-center '>
            <h1>Master Controls</h1>  
        </div>
        
        
        <!-- Master Control Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update Album Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1542208998-f6dbbb27a72f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Album</h5>
                    <p class='card-text'>Modify album details, upload cover images, and manage song lists.</p>
                    <a href='#' class='btn btn-primary'>Update album</a>
                </div>
            </div>

            <!-- Update Music Card -->
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Music</h5>
                    <p class='card-text'>Add, remove, or edit individual tracks and details.</p>
                    <a href='#' class='btn btn-primary'>Update Music</a>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>
            
            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <a href='#' class='btn btn-primary'>Update Genre</a>
                </div>
            </div>
            
            


            
        </div>
        
    </section>


    <!-- Subsription Control Section -->


    <section id='subscription-control' class='p-3'>
        <!-- Title -->
        <div id='subscription-control-title-container' class='d-flex flex-row flex-wrap justify-content-between align-items-center'>
            <h1>Subscription Controls</h1>  
        </div>
        
        
        <!-- Subsription Control Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update Subsription Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://plus.unsplash.com/premium_photo-1661963515041-661b417c0b45?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Subsription</h5>
                    <p class='card-text'>Adjust subscription plans, pricing, and benefits.</p>
                    <a href='#' class='btn btn-primary'>Update Subsription</a>
                </div>
            </div>

            <!-- Subsription Analytics Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://plus.unsplash.com/premium_photo-1664303403877-7f079e34aec9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Subsription Analytics</h5>
                    <p class='card-text'>View detailed insights on subscription metrics and trends.</p>
                    <a href='#' class='btn btn-primary'>Analyze</a>
                </div>
            </div>
            
        </div>
        
    </section>


    <!-- Manage Profiles Section -->


    <section id='profile-control' class='p-3'>
        <!-- Title -->
        <div id='profile-control-title-container' class='d-flex flex-row justify-content-between flex-wrap align-items-center'>
            <h1>Manage Profiles</h1>  
        </div>
        
        
        <!-- Manage Profiles Cards -->
        <div id='control-card-container' class='d-flex flex-row justify-content-start flex-wrap align-items-center gap-5'>
            <!-- Update User Info Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1483032469466-b937c425697b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update User Info</h5>
                    <p class='card-text'>Modify user details, access settings, and preferences.</p>
                    <a href='#' class='btn btn-primary'>Update</a>
                </div>
            </div>

            <!-- Update Artist Info Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/youth-group-with-pop-inspired-background_23-2151494787.jpg?t=st=1730347228~exp=1730350828~hmac=71391efa595cd178e4c77bae9e7c3fd8f49a7a80d200498605ddb229652ffe5a&w=1060' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Artist Info</h5>
                    <p class='card-text'>Edit artist profiles, bios, and featured content.</p>
                    <a href='#' class='btn btn-primary'>Update</a>
                </div>
            </div>
            
        </div>
        
    </section>

    <!-- Session Check Ends here -->
</section>
        ";
    } 
    else {
        echo " 
        <section class='access'>
        <div class='container container-custom'>
        <h1 class='display-4 text-primary-custom'>Access Denied</h1>
        <hr class='bg-white' style='width: 100%;'>
        <h2 class='text-primary-custom'>You don't have permission to view this site.</h2>
        <h3 class='text-primary-custom'>🚫🚫🚫🚫</h3>
        <h4 class='text-primary-custom'>Error code: 403 forbidden</h4>
        </div>
        </section>
        ";
    }
    ?>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>
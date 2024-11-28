<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('connect.php'); 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home Page</title>
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS File Link -->
    <link rel="stylesheet" href="style.css">

    <style>
        
body {
    background: radial-gradient(circle, rgba(232,247,244,1) 0%, rgba(211,231,228,1) 100%);
    font-family: Arial, sans-serif;
    color: #333;
}

.container-custom, .table-container {
    background: rgba(255, 255, 255, 0.95);
    border: 3px solid #1B8673;
    border-radius: 10px;
    padding: 3rem;
    box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.3);
}

.container-custom h1, .container-custom h2, .container-custom h3, .container-custom h4, .text-primary-custom, section h1, section h2 {
    color: #1B8673;
    text-align: center;
}

.text-primary-custom {
    font-weight: bold;
}

.btn-custom, .btn-light-custom {
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-custom {
    background-color: #1B8673;
    color: white;
}

.btn-custom:hover {
    background-color: #145a50;
    transform: scale(1.05);
}

.btn-light-custom {
    background-color: #B6E5D6;
    color: #1B8673;
}

.btn-light-custom:hover {
    background-color: #A2D7C3;
    color: white;
    transform: scale(1.05);
}

.card, .card-body, .table-custom thead th, .table-custom tbody tr td {
    text-align: center;
    vertical-align: middle;
}

.card {
    border: 1px solid #1B8673;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card .card-title {
    color: #1B8673;
    font-weight: bold;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 12px 32px rgba(0, 0, 0, 0.2);
}

.table-custom thead th {
    background-color: #1B8673;
    color: white;
    font-size: 1rem;
    text-transform: uppercase;
}

.table-custom tbody tr:nth-child(odd) {
    background-color: rgba(27, 134, 115, 0.1);
}

.table-custom tbody tr:nth-child(even) {
    background-color: rgba(27, 134, 115, 0.2);
}

nav {
    background-color: #1B8673;
    color: white;
}

nav .nav-link {
    color: white;
    transition: color 0.3s ease;
}

nav .nav-link:hover {
    color: #B6E5D6;
}

.access {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

footer {
    background-color: #1B8673;
    color: white;
    padding: 1rem 0;
    text-align: center;
}

footer a {
    color: #B6E5D6;
    text-decoration: none;
    font-weight: bold;
}

footer a:hover {
    color: #A2D7C3;
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

        // query for calculating revenue
        $select_revenue_data = "SELECT SUM(st.price) AS Revenue
                                FROM subscription_types st 
                                JOIN subscription_records sr ON st.PackageCode=sr.SubscriptionType; ";                   
        $result_revenue_data = mysqli_query($conn, $select_revenue_data);
        $revenue_data = mysqli_fetch_assoc($result_revenue_data);

        echo "

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
                            <p class='card-text'>{$revenue_data['Revenue']}</p>
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
        <section/>  ";
    
    }

   

    // Artist followers chart

    include('graphs.php')

?>

<?php
include('revenueGraph.php')
?>

<?php

    if(isset($_SESSION['adminname'])){

    // latest subscribed users table

    echo'
    <section>
    <div class="container my-5 table-container">
    <h2 class="text-center mb-4 text-primary-custom">Subscription Details</h2>
    <table class="table table-bordered table-hover table-custom">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Subscription ID</th>
                <th scope="col">Package Name</th>
                <th scope="col">Subscription Ends</th>
            </tr>
        </thead>
        <tbody>';

        

        $select_subscriped_users = "SELECT u.Name, u.Image, u.UserID, s.SubscriptionID, s.SubscriptionType, t.PackageName, s.EndDate 
                                    FROM subscription_records s inner join subscription_types t on s.SubscriptionType = t.PackageCode 
                                    inner join users u on u.UserID = s.userID ORDER BY s.StartDate desc limit 10";                                            // query for selecting all songs
        $result_subscriped_users = mysqli_query($conn, $select_subscriped_users);
        while ($row_data = mysqli_fetch_assoc($result_subscriped_users)) {                              // loop to fetch all subscribed users
            $user_name = $row_data['Name'];
            $subscription_id = $row_data['SubscriptionID'];  
            $user_id = $row_data['UserID'];                                            // Getting the user id
            $subscription_type = $row_data['SubscriptionType'];   
            $package_name = $row_data['PackageName'];                                          // Getting the package name
            $end_date = $row_data['EndDate'];                                            // Getting subscription end date

            /* User information */
            $select_user_name = "SELECT * FROM `users` WHERE UserID = $user_id";   // query for selecting user name
            $result_user_name = mysqli_query($conn, $select_user_name);
            $user_data = mysqli_fetch_assoc($result_user_name);
            $User_Name = $user_data['Name'];

            /* subscription information */
            $select_packageCode = "SELECT * FROM `subscription_types` WHERE PackageCode = $subscription_type";            
            $result_packageCode = mysqli_query($conn, $select_packageCode);
            $package_data = mysqli_fetch_assoc($result_packageCode);
            $Package_Name = $package_data['PackageName'];
            echo"
            <tr>
                <td>$User_Name</td>
                <td>$subscription_id</td>
                <td>$Package_Name</td>
                <td>$end_date</td>
            </tr>
            
            ";
        }
        
        echo'
        </tbody>
    </table>
</div>
</section>
';
    }
?>


<?php 
if(isset($_SESSION['adminname'])) {

    echo"
    
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
                    <form action='adminaction.php' method='post'>
                        <button type='submit' class='themed-btn btn btn-light border-0' name='update-userInfo-btn'>Update</button>
                    </form>
                </div>
            </div>

            <!-- Update Artist Info Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/youth-group-with-pop-inspired-background_23-2151494787.jpg?t=st=1730347228~exp=1730350828~hmac=71391efa595cd178e4c77bae9e7c3fd8f49a7a80d200498605ddb229652ffe5a&w=1060' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Artist Info</h5>
                    <p class='card-text'>Edit artist profiles, bios, and featured content.</p>
                    <form action='adminaction.php' method='post'>
                        <button type='submit' class='themed-btn btn btn-light border-0' name='update-artistInfo-btn'>Update</button>
                    </form>
                    
                </div>
            </div>

            
        </div>
        
    </section>

    <!-- Session Check Ends here -->
    </section>



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
                    <form action='adminaction.php' method='post'>
                        <button type='submit' class='themed-btn btn btn-light border-0' name='update-album-btn' >Update album</button>
                    </form>
                </div>
            </div>

            <!-- Update Music Card -->
            <div class='card' style='width: 18rem; '>
                <img class='card-img-top' src='https://img.freepik.com/free-photo/vinyl-record-cassette-tape-design-resource_53876-105921.jpg?t=st=1730348087~exp=1730351687~hmac=6bda3f0924ff3161c42e359fbfe85beed3e78fccd83404824898ad19262ca2e4&w=996'  style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Music</h5>
                    <p class='card-text'>Add, remove, or edit individual tracks and details.</p>
                    <form action='adminaction.php' method='post'>
                        <button type='submit' class='themed-btn btn btn-light border-0' name='update-music-btn' >Update Music</button>
                    </form>
                </div>
            </div>

            <!-- Update Genre Card -->
            <div class='card' style='width: 18rem;'>
                <img class='card-img-top' src='https://images.unsplash.com/photo-1587731556938-38755b4803a6?q=80&w=1778&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' style='width: 18rem; height: 12rem;' alt='Card image cap'>
                <div class='card-body'>
                    <h5 class='card-title'>Update Genre</h5>
                    <p class='card-text'>Manage music genres for better categorization.</p>
                    <form action='adminaction.php' method='post'>
                        <button type='submit' class='themed-btn btn btn-light border-0' name='update-genre-btn'>Update Genre</button>
                    </form>
                </div>
            </div>

            
        </div>
        
    </section>

        ";
    
}else {
        echo " 
        <section class='access'>
        <div class='container container-custom'>
        <h1 class='display-4 text-primary-custom'>Access Denied</h1>
        <hr class='bg-white' style='width: 100%;'>
        <h2 class='text-primary-custom'>You don't have permission to view this site.</h2>
        <h3 class='text-primary-custom'>Login to View this site</h3>
        <h4 class='text-primary-custom'>🚫🚫🚫🚫</h3>
        <h5 class='text-primary-custom'>Error code: 403 forbidden</h4>
        </div>
        </section>
        ";
    }
?>


</body>
<script src="https://kit.fontawesome.com/1621a0cc57.js" crossorigin="anonymous"></script>

</html>